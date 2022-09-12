<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/mypage.css') }}" >
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
                <a class="prof-setting" href="{{ url('/mypage/setting') }}">プロフィールを変更する</a>
            </div>
            
            <dev class="right-side">
                <p class="cont-name">ユーザー名 : {{ $auth->name }}</p>
                <p class="cont-age">年齢 : </p>
                <p class="cont-sex">性別: </p>
                <p class="cont-game">ゲーム名 : </p>
                <p class="cont-playstyle">プレイスタイル : </p>
                <div class="playwith">
                    <p class="cont-playwith">一緒にやりたい人</p>
                    <p class="text-playwith">aaaaa</p>
                </div>
                <div class="comment">
                    <p class="cont-comment">コメント</p>
                    <p class="text-comment">iiiii</p>
                </div>
                
            </dev>
        </dev>
    
    @endsection
</body>