<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\ChatroomMessage;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Log;
 
class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        return view('post', [
            'chatroom_id' => 1,
        ]);
    }
 
    public function fetchMessages(Request $request)
    {
        
        $chats = ChatroomMessage::with('user')->where('chatroom_id', $request->chatroomId)->get();
        return $chats;
        
    }
 
    public function sendMessage(Request $request)
    {
        //Log::debug($request->chatroomId);
        $user = Auth::user();
        $chatroomId = $request->chatroomId;
        $message = $user->chatroom_message()->create([
            'user_id' => $user->id,
            'chatroom_id' => $request->chatroomId,
            'message' => $request->input('message')
        ]);
 
        event(new MessageSent($user, $message, $chatroomId));
 
        return ['status' => 'Message Sent!'];
    }
}