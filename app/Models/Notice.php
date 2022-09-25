<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'message',
        'seen',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
