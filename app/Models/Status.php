<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'age',
        'sex' ,
        'game_id' ,
        'playstyle' ,
        'playwith',
        'comment',
        'img_url',
        'set',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function game()
    {
        return$this->belongsTo('App\Models\Game');
    }
    
}
