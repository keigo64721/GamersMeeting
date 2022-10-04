<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\ChatroomUser;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{chatroomId}', function ($user, $chatroomId) {
    
    $chatroom_user = ChatroomUser::where('chatroom_id', (int) $chatroomId)
    ->where('user_id', $user->id)
    ->first();
    
    if (!is_null($chatroom_user)) {
        return true;
    };
});

// Broadcast::channel('chat.{chatroomId}', function ($user, $chatroomId) {
//     return true;   
// });