<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatroomMessage;
use App\Models\ChatroomUser;
use App\Models\Chatroom;
use App\Models\Swipe;
use App\Models\Notice;
use App\Events\MessageSent;
use Log;
 
class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(Request $request)
    {
        // ログインユーザー情報を取得
        $auth = Auth::user();
        
        // チャットルームIDを取得
        $chatroomIds = ChatroomUser::where('user_id', $request->chatUser)->pluck('chatroom_id');
        $chatroom = null;    
        foreach($chatroomIds as $id){
            $chatroom = ChatroomUser::where('chatroom_id', $id)->where('user_id', $auth->id)
                                                               ->first();
            if ($chatroom != null){
                $roomId = $chatroom->chatroom_id;
                break;
            }
            
        }
        
        // チャット相手のユーザー情報を取得
        $partner = ChatroomUser::where('chatroom_id', $roomId)->where('user_id', '<>', $auth->id)->first();
        
        // マッチしたユーザー一覧を取得
        $likedUserIds = Swipe::where('to_user_id', \Auth::user()->id)
                        ->where('is_like', true)
                        ->pluck('from_user_id');
        $i = 0;
        $matchedUsers = null;
        foreach($likedUserIds as $likedUserId){
            $matchedUser = Swipe::where('from_user_id', \Auth::user()->id)
                            ->where('to_user_id', $likedUserId)
                            ->where('is_like', true)
                            ->first();
            if($matchedUser !== NULL){
                $matchedUsers[$i] = $matchedUser;
                $i++;
            }
        }
        // $matchedUsersごとの最新メッセージを取得
        $i = 0;
        foreach($matchedUsers as $matchedUser){
            $chatroomIds = ChatroomUser::where('user_id', $matchedUser->toUser->id)->pluck('chatroom_id');
            $chatroom = null;
            $tenporalyRoomId = null;
            foreach($chatroomIds as $id){
                $chatroom = ChatroomUser::where('chatroom_id', $id)->where('user_id', $auth->id)
                                                                   ->first();
                if ($chatroom != null){
                    $tenporalyRoomId = $chatroom->chatroom_id;
                    break;
                }
            }
            if($tenporalyRoomId === null){
                $matchedUserMessages[$i] = null;
                $i++;
            }else{
                $max = ChatroomMessage::where('chatroom_id', $tenporalyRoomId)->max('id');
                $matchedUserMessages[$i] = ChatroomMessage::where('chatroom_id', $tenporalyRoomId)
                                          ->where('id', $max)
                                          ->first();
                $i++;
            }
            
        }
        
        //通知情報を取得
        $notice = Notice::where('user_id', Auth::user()->id)->where('seen', false)->get();
        
        return view('chat', [
            'chatroom_id' => $roomId,
            'auth' => $auth,
            'partner' => $partner,
            'matchedUsers' => $matchedUsers,   
            'matchedUserMessages' => $matchedUserMessages,
            'notices' => $notice,
        ]);
    }
 
    public function fetchMessages(Request $request)
    {
        // チャットルーム内のメッセージを取得
        $chats = ChatroomMessage::with('user')->where('chatroom_id', $request->chatroomId)->get();
        return $chats;
    }
 
    public function sendMessage(Request $request)
    {
        // ログインユーザー情報を取得
        $user = Auth::user();
        // チャットルームIDを取得
        $chatroomId = $request->chatroomId;
        // メッセージを作成
        $message = $user->chatroomMessage()->create([
            'user_id' => $user->id,
            'chatroom_id' => $request->chatroomId,
            'message' => $request->input('message')
        ]);
        // ブロードキャストイベントを実行
        event(new MessageSent($user, $message, $chatroomId));
 
        return ['status' => 'Message Sent!'];
    }
}