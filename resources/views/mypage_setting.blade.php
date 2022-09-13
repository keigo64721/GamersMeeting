<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/mypage_setting.css') }}" >
</head>
<body>    
    @extends('layouts.app')
    
    @section('content')
    
    <dev class="prof-contents">
        <div class="left-side">
            <dev class="cont-img">
                <!--imgタグでAuth::user()の画像を取得-->
                <img src="{{ secure_asset('/img/バチンキー.png') }}" width=150px height=150px >
            </dev>
                
            <!--画像インプット-->
            <label class="img">
                <input type="file" name="file" class="js-upload-file">
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
            <form action="posts/auth" method="POST">
                <div class="edit">
                    <p class="cont-name">ユーザー名  </p>
                        <input class="text-name" type='text' name='post[name]' value="{{ $auth->name }}">
                </div>
                <div class="edit">
                    <p class="cont-age">年齢</p>
                    <!--foreachを使ってすべてから選択-->
                    <select class ="dropdown-age" name='post[age]'>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                </div>
                <div class="edit">
                    <p class="cont-sex">性別 </p>
                    <select class ="dropdown-sex" name='post[sex]'>
                      <option value="男">男</option>
                      <option value="女">女</option>
                      <option value="未選択">未選択</option>
                    </select>
                </div>
                <div class="edit">
                    <p class="cont-game">ゲーム名  </p>
                    <select class ="dropdown-game" name='post[game]'>
                      <option value="ApexLegends">ApexLegends</option>
                      <option value="Valorant">Valorant</option>
                    </select>
                </div>
                <div class="edit">
                    <p class="cont-playstyle">プレイスタイル</p>
                    <select class ="dropdown-playstyle" name='post[playstyle]'>
                      <option value="1">ワイワイ楽しく</option>
                      <option value="2">真剣に</option>
                      <option value="3">気軽に</option>
                    </select>
                </div>
                <div class="edit">
                    <div class="playwith">
                        <p class="cont-playwith">一緒にやりたい人</p>
                        <textarea class="text-playwith"  name='post[playwith]' ></textarea>
                    </div>
                </div>
                <div class="edit">
                    <div class="comment">
                        <p class="cont-comment">コメント</p>
                        <textarea class="text-comment" type='text' name='post[comment]' ></textarea>
                    </div>
                </div>
                
                <input type="submit" class="btn_confirm"  name="btn_confirm" value="設定する">
                
            </form>
            
        </dev>
    </dev>
    
    @endsection
</body>