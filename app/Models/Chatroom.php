<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chatroom extends Model
{
    use HasFactory;
    
    public function chatroom_user()
    {
        return $this->hasMany('App\Models\ChatroomUser');
    }
    
    public function chatroom_message()
    {
        return $this->hasMany('App\Models\ChatroomMessage');
    }
}