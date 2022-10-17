<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/layout.css') }}" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    
</head>
<body>
    
        
        
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            
            
            
            <div class="container">
                
                @auth
                    <!--Laravelアイコン ログイン時-->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        GamersMeeting
                    </a>
                @else
                    <!--Laravelアイコン　非ログイン時-->
                    <a class="navbar-brand" href="{{ url('/top') }}">
                        GamersMeeting
                    </a>
                @endauth
                
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- バーの左側 -->
                    <ul class="navbar-nav " id="left-nav">
                        <div　class="menu">
                            @auth
                            <!--マッチング一覧-->
                            <a class="navbar-matching" href="{{ url('/matching') }}" >
                                マッチング一覧・メッセージ
                            </a>
                            <!--通知ポップアップ-->
                            
                            <label class="open" for="pop-up">通知</label>
                            
                            <input type="checkbox" id="pop-up">
                            <div class="overlay" >
                                <div class="window" >
                                    <label class="close" for="pop-up">×</label>
                                    <form action="{{ route('noticed.all') }}" method="POST" >
                                        @csrf
    
                                        <div class="notice-header">
                                            <h4>通知</h4>
                                            <input type="submit" class="btn-confirmall"  name="btn_confirm" value="確認済みにする">
                                        </div>
                                    </form>
                                    @foreach($notices as $notice)
                                        <div class="notice-messages">
                                            <p class="notice-message-body">{{ $notice->message}}</p>
                                            <form action="{{ route('noticed') }}" method="POST" >
                                                @csrf
                                                <input type="hidden" name="id" value={{ $notice->id }}>
                                                <input type="submit" class="btn-confirm"  name="btn_confirm" value="確認する">
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endauth
                        </div>
                    </ul>

                    <!-- バーの右側 -->
                    <ul class="navbar-nav ms-auto" id="right-nav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">ログインする</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">利用を始める</a>
                                </li>
                            @endif
                        @else
                        <!--ユーザー名をクリックした際のドロップダウン-->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!--マイページボタン-->
                                    <a class="dropdown-item" href="{{ url('/mypage') }}" >マイページ</a>
                                    
                                    <!--管理者画面-->
                                    @if($auth->admin == 1)
                                    <a class="dropdown-item" href="{{ url('/admin') }}" >管理者</a>
                                    @endif
                                    
                                    <!--設定ボタン（設定項目を増やしたら追加する予定）-->
                                    <!--<a class="dropdown-item" href="{{ url('/setting') }}" >設定</a>-->
                                    
                                    <!--ログアウトボタン-->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                            
                        @endguest
                    </ul>
                </div>
            </div>
            
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    
</body>
</html>
