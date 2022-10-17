<head>
    <meta charset="UTF-8">
    <title>admin</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/admin.css') }}" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>    
    
    @extends('layouts.app')
    
    @section('content')
    <div class="main">
        <form action="{{ route('admin.gamedelete') }}" method="POST">
            @csrf
            <strong>ゲーム一覧</strong>
            <div class="games">
                @foreach($games as $game)
                    <div class="game">
                        <div class="game-name">・{{ $game->name }}</div>
                        <button class="btn btn-danger btn-sm "　type="submit" value={{ $game->id }} name="gameId">削除</button>
                    </div>
                @endforeach
            </div>
        </form>
        <form action="{{ route('admin.gameadd') }}" method="POST">
            @csrf
            <div class="input">
                <input name="gameName" class="input-text" v-model="text" />
                <button class="btn btn-primary btn-sm " type="submit">追加</button>
            </div>
        </form>
    </div>
    @endsection
</body>