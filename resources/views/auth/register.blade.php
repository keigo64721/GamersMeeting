<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/auth.css') }}" >
</head>
<body>
    @extends('layouts.app')
    
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-Dark">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                            
                            <div class="border-bottom"><br></div>
                            <p style="font-size: 16px;">ソーシャル・ログイン</p>
                            <a class="line" href="{{route('linelogin')}}"><img class="line-img" src="img/btn_login_base.png"></a>
                            <style>
                               .line-img {
                                   width: 200px;
                                   height: 55px;
                                   margin-bottom: 20px;
                               }
                               .line {
                                   margin-left: 202px;
                                   margin-right: 202px;
                               }
                            </style>
                            <p style="font-size: 14px;"><br>本ウェブサービスでは、LINEによる認証ページで許可を得た場合のみメールアドレスを取得します。<br>
                            そして、取得されたメールアドレスにつきましては本サービスのログイン以外の目的には一切使用いたしません。</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>