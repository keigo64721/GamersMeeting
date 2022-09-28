<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function status()
    {
        return $this->hasOne('App\Models\Status');
    }
    
    public function insertUser($name, $email ,$password)
    {
        return $this->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
    
    public function swipe()
    {
        return $this->hasMany('App\Models\Swipe');
    }
    
    public function notice()
    {
        return $this->hasMany('App\Models\Notice');
    }
    
    public function chatroom_user()
    {
        return $this->hasMany('App\Models\ChatroomUser');
    }
    
    public function chatroom_message()
    {
        return $this->hasMany('App\Models\ChatroomMessage');
    }
}
