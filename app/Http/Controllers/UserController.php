<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Swipe;

class UserController extends Controller
{
    
    public function index()
    {
        //まだスワイプしていないuserを一つ取得
        
        // すでにスワイプした人の取得
        $swipeUserIds = Swipe::where('from_user_id', \Auth::user()->id)->get()->pluck('to_user_id');
        
        // スワイプしていない人を一人取得
        $user = User::where('id', '<>', \Auth::user()->id)->whereNotIn('id', $swipeUserIds)
                                                          ->whereHas('statuses', function($q){
                                                                $q->where('game_id', \Auth::user()->game_id);  
                                                            })->first();
        
        //$user = User::find(3);
        return view('pages.user.index',[
            'user' => $user
        ]);
    }
}