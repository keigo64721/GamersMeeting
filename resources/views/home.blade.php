<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/home.css') }}" >
    <script src="{{ secure_asset('/js/home.js') }}"></script>
</head>
<body>    
    
    @extends('layouts.app')
    
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                @if($auth->status->set == 0 || $auth->status->set == NULL)
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>
        
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
        
                            <div class="contents">
                                {{ __('ログインしました！') }}
                               
                                    <div class="set_to_mypage">
                                        <p class="message_to_setting">初期設定が済んでいません</p>
                                        <a class="to_mypage" href="{{ url('/mypage') }}">プロフィールを設定する</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                @else
                    @if($user === NULL)
                        <div class="card">
                            <div class="card-header">{{ __('Dashboard') }}</div>
            
                            <div class="card-body">
                                <div class="contents">
                                    {{ __('マッチング相手がいません') }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="profile-card">
                            <div class="upper-side">
                                <img class="img" src="{{ $user->status->img_url }}" width=160px height=160px >
                                <div class="upper-right-side">
                                    <div class="first-row">
                                        <p class="name">ユーザー名 : {{ $user->name }}</p>
                                        <p class="age">年齢 : {{ $auth->status->age }}歳</p>
                                        <div class="sex">
                                            @if($user->status->sex == "男")
                                                <div class="man-circle" ></div>
                                            @elseif($user->status->sex == "女")
                                                <div class="woman-circle" ></div>
                                            @else
                                                <div class="nosex-circle" ></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="second-row">
                                        <p class="game">ゲーム名 : {{ $user->status->game->name }}</p>
                                    </div>
                                    <div class="third-row">
                                        <p class="playstyle">プレイスタイル :{{ $playstyle[(int)$user->status->playstyle] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="lower-side">
                                <div class="playwith">
                                    <p class="cont-playwith">一緒にやりたい人</p>
                                    <p class="text-playwith">{{ $user->status->playwith }}</p>
                                </div>
                                <div class="comment">
                                    <p class="cont-comment">コメント</p>
                                    <p class="text-comment">{{ $user->status->comment }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="buttons" >
                            <form action="{{ route('swipes.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                                <input type="hidden" name="is_like" value="1" >
                                <div class="good">
                                    <button class="good-button" type="submit">
                                        <img id="goodpost" class="good-img"  src="/img/ハート.jpg" width=120px height=120px>
                                    </button>
                                </div>
                            </form>
                            <form action="{{ route('swipes.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                                <input type="hidden" name="is_like" value="0" >
                                <div id="badpost" class="bad" >
                                    <button class="bad-button" type="submit">
                                        <img class="bad-img"  src="/img/バツ.jpeg" width=120px height=120px>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        
    </div>
    @endsection
</body>
