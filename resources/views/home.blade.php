<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/home.css') }}" >
</head>
<body>    
    
    @extends('layouts.app')
    
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                            @if($auth->status->playwith == "変更してください(変更しないと利用できません)" || $auth->status->comment == "変更してください(変更しないと利用できません)" || $auth->status->playwith == NULL || $auth->status->comment == NULL)
                                <div class="set_to_mypage">
                                    <p class="message_to_setting">初期設定が済んでいません</p>
                                    <a class="to_mypage" href="{{ url('/mypage') }}">プロフィールを設定する</a>
                                </div>
                            @else
                                <br>マッチング画面を作る↓
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
