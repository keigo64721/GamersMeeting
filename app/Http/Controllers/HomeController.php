<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Game;
use App\Models\Status;
use App\Models\User;
use App\Models\Swipe;
use App\Models\Notice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // プレイスタイルの連想配列を定義
    public $playstyle= [
            'ワイワイ楽しく',
            '真剣に',
            '気軽に',
        ];
      
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
        // すでにスワイプした人の取得
        $swipeUserIds = Swipe::where('from_user_id', \Auth::user()->id)->get()->pluck('to_user_id');
        
        // スワイプしていない人を一人取得
        $user = User::where('id', '<>', \Auth::user()->id)->whereNotIn('id', $swipeUserIds)
                                                          ->whereHas('Status', function($q){
                                                                $q->where('game_id', \Auth::user()->status->game_id);  
                                                            })
                                                          ->whereHas('Status', function($q){
                                                                $q->where('set', 1);  
                                                            })
                                                          ->first();
        // 自分への未読通知を取得
        $notice = Notice::where('user_id', Auth::user()->id)->where('seen', false)->get();
        
        return view('home', [
            'auth' => Auth::user(),   
            'user' => $user,
            'playstyle' => $this->playstyle,
            'notices' => $notice,
        ]);
    }
    
    public function mypage()
    {
        // 自分への未読通知を取得
        $notice = Notice::where('user_id', Auth::user()->id)->where('seen', false)->get();
        
        return  view('mypage', [
            'auth' => Auth::user(),
            'playstyle' => $this->playstyle,
            'notices' => $notice,
        ]);
    }
    
    
    public function mypage_setting()
    {
        // 自分への未読通知を取得
        $notice = Notice::where('user_id', Auth::user()->id)->where('seen', false)->get();
        
        return  view('mypage_setting', [
            'auth' => Auth::user(),
            'games' => Game::all(),
            'playstyle' => $this->playstyle,
            'notices' => $notice,
        ]);
    }
    
    public function set_status(Request $request)
    {
        // ステータスのバリデーションを記述
        $validated = $request->validate([
            'name' => 'required|max:10', 
            'playwith' => 'required|max:255',
            'comment' => 'required|max:255'
        ]);
        // リクエスト情報を置き換え
        $input = $request;
        // ログイン者情報を取得
        $user = Auth::user();
        // 画像ファイルをストレージに保存・ファイルパスを保存
        if($input["file"] != NULL)
        {
            $image = $request->file('file');
            $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
            $fullFilePath = Storage::disk('s3')->url($path);
            
        }
        // 各情報の変更
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
        // 初期ステータスを変更したかの判定(コメントを変更したか)
        $defaultText = "変更してください(変更しないと利用できません)";
        if($user->status->playwith == $defaultText || $user->status->comment == $defaultText || $user->status->playwith == NULL || $user->status->comment == NULL)
        {
            $user->status->set = 0;
        }else{
            $user->status->set = 1;
        }
        $user->status->save();
        
        return redirect(route('mypage'));
    }
    
    public function noticed_all(Request $request)
    {
        // 自分への未読通知を取得
        $notices = Notice::where('user_id', Auth::user()->id)->where('seen', false)->get();
        // 各通知を既読に変更
        foreach($notices as $notice){
            $notice->seen = 1;
            $notice->save();
        }
        
        return redirect(route('home'));
    }
    
    public function noticed(Request $request){
        // 指定された通知を既読に変更
        $notice = Notice::where('id', $request->id)->first();
        $notice->seen = 1;
        $notice->save();
        
        return redirect(route('matching'));
    }
    
    public function admin()
    {
        // 自分への未読通知を取得
        $notice = Notice::where('user_id', Auth::user()->id)->where('seen', false)->get();
        
        return  view('admin', [
            'auth' => Auth::user(),
            'playstyle' => $this->playstyle,
            'notices' => $notice,
            'games' => Game::all(),
        ]);
    }
    
    public function add_game(Request $request)
    {
        // 新規ゲームをテーブルに追加
        Game::create([
            'name' =>  $request->gameName,   
        ]);
        return redirect(route('admin'));
    }
    
    public function delete_game(Request $request)
    {
        // 指定のゲームを選び削除
        Game::find($request->gameId)->forceDelete();
        return redirect(route('admin'));
    }
}
