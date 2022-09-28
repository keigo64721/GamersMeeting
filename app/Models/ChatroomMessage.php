<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatroomMessage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'chatroom_id',
        'message',
    ];
    
    public function user()
    {
       return $this->belongsTo('App\Models\User');
    }
}