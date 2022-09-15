<?php

namespace App\Http\Controllers;

use App\Http\Requests\mypage_settingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;
use App\Models\Status;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->status == NULL)
        {
            $status = new Status();
            $status->user_id = Auth::user()->id;
            $status->age = 1;
            $status->sex = "未選択";
            $status->game_id = 1;
            $status->playstyle = 0;
            $status->playwith = "変更してください(変更しないと利用できません)";
            $status->comment = "変更してください(変更しないと利用できません)";
            $status->img_url = "/storage/images/18448.jpg";
            $status->save();
            // dd($status);
        }
        
        return view('home', [
            'auth' => Auth::user(),    
        ]);
    }
    
    public function mypage()
    {
        // dd(Auth::user()->status);
        
        
        $playstyle = [
            'ワイワイ楽しく',
            '真剣に',
            '気軽に',
        ]; 
        
        return  view('mypage', [
            'auth' => Auth::user(),
            'playstyle' => $playstyle,
        ]);
    }
    
    
    public function mypage_setting()
    {
        $playstyle = [
            'ワイワイ楽しく',
            '真剣に',
            '気軽に',
        ];
        
        
        
        return  view('mypage_setting', [
            'auth' => Auth::user(),
            'games' => Game::all(),
            'playstyle' => $playstyle,
        ]);
    }
    
    public function set_status(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required', 
            'playwith' => 'required|max:255',
            'comment' => 'required|max:255'
        ]);
        $input = $request;
        $user = Auth::user();
        // dd($input["file"]);
        
        if($input["file"] != NULL)
        {
        $fileName = $input["file"]->getClientOriginalName();
        Storage::putFileAs('public/images',  $input->file, $fileName);
        $fullFilePath = '/storage/images/'. $fileName;
        }
        
        $user->name = $validated['name'];
        $user->status->age = $input->age;
        $user->status->sex = $input->sex;
        $user->status->game_id = $input->game_id;
        $user->status->playstyle = $input->playstyle;
        $user->status->playwith = $validated['playwith'];
        $user->status->comment =$validated['comment'];
        if($input["file"] != NULL) $user->status->img_url = $fullFilePath;
        $user->save();
        $user->status->save();
        
        return redirect(route('mypage'));
    }
}
