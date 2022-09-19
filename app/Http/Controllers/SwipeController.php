<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Swipe;
use App\Models\User;

class SwipeController extends Controller
{
    
    public function store(Request $request)
    {
        $toUser = Swipe::where('from_user_id', $request->input('to_user_id'))
                    ->where('to_user_id', \Auth::user()->id)
                    ->first();
        // dd($toUser);
        // if($toUser->is_like == true && $request->input('is_like') == true){
        //     noticeテーブルを作って追加する
        // }
        
        Swipe::create([
            'from_user_id' => \Auth::user()->id,
            'to_user_id' => $request->input('to_user_id'),
            'is_like' => $request->input('is_like'),
        ]);
        
        return redirect(route('home'));
    }
    
    public function match()
    {
        $likedUserIds = Swipe::where('to_user_id', \Auth::user()->id)
                        ->where('is_like', true)
                        ->pluck('from_user_id');
                        
        $matchedUsers = Swipe::where('from_user_id', \Auth::user()->id)
                        ->where('to_user_id', $likedUserIds)
                        ->where('is_like', true)
                        ->get();
                        
        //dd($matchedUsers);
        return view('match', [
            'matchedUsers' => $matchedUsers,    
        ]);
    }
}