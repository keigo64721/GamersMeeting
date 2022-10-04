<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Swipe;
use App\Models\User;
use App\Models\ChatroomMessage;
use App\Models\ChatroomUser;
use App\Models\Chatroom;
use App\Models\Notice;

class SwipeController extends Controller
{
    
    public function store(Request $request)
    {
        $auth = Auth::user();
        
        $toUser = Swipe::where('from_user_id', $request->input('to_user_id'))
                    ->where('to_user_id', \Auth::user()->id)
                    ->first();
        
        if($toUser != NULL){
            if($toUser->is_like == true && $request->input('is_like') == true){
                Notice::create([
                    'user_id' =>  \Auth::user()->id,
                    'message' => $toUser->fromUser->name."さんとマッチしました！",
                    'seen' => false,
                ]);
                Notice::create([
                    'user_id' =>  $toUser->fromUser->id,
                    'message' => \Auth::user()->name."さんとマッチしました！",
                    'seen' => false,
                ]);
                $room = Chatroom::create();
                ChatroomUser::create([
                    'user_id' => $request->input('to_user_id'),
                    'chatroom_id' => $room->id,
                ]);
                ChatroomUser::create([
                    'user_id' => $auth->id,
                    'chatroom_id' => $room->id,
                ]);
            }
        }
        
        Swipe::create([
            'from_user_id' => \Auth::user()->id,
            'to_user_id' => $request->input('to_user_id'),
            'is_like' => $request->input('is_like'),
        ]);
        
        return redirect(route('home'));
    }
    
    public function match()
    {
        $auth = Auth::user();
        
        $likedUserIds = Swipe::where('to_user_id', \Auth::user()->id)
                        ->where('is_like', true)
                        ->pluck('from_user_id');
        
        $i = 0;
        $matchedUsers = NULL;
        
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
        
        $notice = Notice::where('user_id', Auth::user()->id)->where('seen', false)->get();
        
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
        
        return view('match', [
            'matchedUsers' => $matchedUsers,  
            'matchedUserMessages' => $matchedUserMessages,
            'notices' => $notice,
        ]);
    }
}