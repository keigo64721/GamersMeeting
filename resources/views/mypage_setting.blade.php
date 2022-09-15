<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/mypage_setting.css') }}" >
</head>
<body>    
    @extends('layouts.app')
    
    @section('content')
    
    <form action="{{ route('mypage.update') }}" method="POST" enctype="multipart/form-data">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <dev class="prof-contents">
            <div class="left-side">
                <dev class="cont-img">
                    <!--imgタグでAuth::user()の画像を取得-->
                    <img src="{{ $auth->status->img_url }}" width=150px height=150px >
                </dev>
                    
                <!--画像インプット-->
                
                    @csrf
            
                    <label class="img">
                        <input type="file" name="file" class="js-upload-file" >
                        <p　class="js-upload-fileselect">画像を変更する</p>
                    </label>
                    <div class="js-upload-filename">ファイルが未選択です</div>
                    <div class="fileclear js-upload-fileclear">選択ファイルをクリア</div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script>
                    $(function() {
                      $('.js-upload-file').on('change', function () { //ファイルが選択されたら
                        let file = $(this).prop('files')[0]; //ファイルの情報を代入(file.name=ファイル名/file.size=ファイルサイズ/file.type=ファイルタイプ)
                        $('.js-upload-filename').text(file.name); //ファイル名を出力
                        $('.js-upload-fileclear').show(); //クリアボタンを表示
                      });
                      $('.js-upload-fileclear').click(function() { //クリアボタンがクリックされたら
                        $('.js-upload-file').val(''); //inputをリセット
                        $('.js-upload-filename').text('ファイルが未選択です'); //ファイル名をリセット
                        $(this).hide(); //クリアボタンを非表示
                      });
                    });
                    </script>
                
                
            </div>
            
            <dev class="right-side">
                
                    @csrf
                    <div class="edit">
                        <p class="cont-name">ユーザー名  </p>
                        
                            @if($errors->has('name'))
                                <input class="text-name" type='text' name='name' value="{{ old('name') }}" >
                            @else
                                <input class="text-name" type='text' name='name' value="{{ $auth->name }}" >
                            @endif
                        
                    </div>
                    <div class="edit">
                        <p class="cont-age">年齢</p>
                        <!--foreachを使ってすべてから選択-->
                        <select class ="dropdown-age" name='age' value=3>
                            
                            @for($i = 1; $i <= 100; $i++)
                                @if((int)$i == (int)$auth->status->age)
                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    <div class="edit">
                        <p class="cont-sex">性別 </p>
                        <select class ="dropdown-sex" name='sex'>
                            @if($auth->status->sex == "男")
                                <option value="男" selected>男</option>
                                <option value="女">女</option>
                                <option value="未選択" >未選択</option>
                            @endif
                            @if($auth->status->sex == "女")
                                <option value="男" >男</option>
                                <option value="女" selected>女</option>
                                <option value="未選択" >未選択</option>
                            @endif
                            @if($auth->status->sex == "未選択")
                                <option value="男" >男</option>
                                <option value="女" >女</option>
                                <option value="未選択" selected>未選択</option>
                            @endif
                        </select>
                    </div>
                    <div class="edit">
                        <p class="cont-game">ゲーム名  </p>
                        <select class ="dropdown-game" name='game_id'>
                            @foreach($games as $game)
                                @if($game->id == (int)$auth->status->game_id)
                                    <option value={{ $game->id }} selected>{{ $game->name }}</option>
                                @else
                                     <option value={{ $game->id }}>{{ $game->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="edit">
                        <p class="cont-playstyle">プレイスタイル</p>
                        <select class ="dropdown-playstyle" name='playstyle'>
                            @for($i = 0; $i <= 2; $i++)
                                @if($i == (int)$auth->status->playstyle)
                                    <option value="{{ $i }}" selected>{{ $playstyle[$i] }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $playstyle[$i] }}</option>
                                @endif
                            @endfor
                          
                        </select>
                    </div>
                    <div class="edit">
                        <div class="playwith">
                            <p class="cont-playwith">一緒にやりたい人</p>
                            @if($errors->has('playwith'))
                                <textarea class="text-playwith"  name='playwith' >{{ old('playwith') }}</textarea>
                            @else
                                <textarea class="text-playwith"  name='playwith' >{{ $auth->status->playwith }}</textarea>
                            @endif
                            
                        </div>
                    </div>
                    <div class="edit">
                        <div class="comment">
                            <p class="cont-comment">コメント</p>
                            @if($errors->has('comment'))
                                <textarea class="text-comment" type='text' name='comment' >{{ old('comment') }}</textarea>
                            @else
                                <textarea class="text-comment" type='text' name='comment' >{{ $auth->status->comment }}</textarea>
                            @endif
                            
                        </div>
                    </div>
                    
                    <input type="submit" class="btn_confirm"  name="btn_confirm" value="設定する">
            </dev>
        </dev>
    </form>
    
    @endsection
</body>