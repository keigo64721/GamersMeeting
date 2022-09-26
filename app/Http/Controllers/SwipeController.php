<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Swipe;
use App\Models\User;
use App\Models\Notice;

class SwipeController extends Controller
{
    
    public function store(Request $request)
    {
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
            $matchedUsers[$i] = $matchedUser;
            $i++;
        }
        
        $notice = Notice::where('user_id', Auth::user()->id)->where('seen', false)->get();
        
        
        return view('match', [
            'matchedUsers' => $matchedUsers,   
            'notices' => $notice,
        ]);
    }
}