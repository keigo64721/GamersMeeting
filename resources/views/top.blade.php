<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/top.css') }}" >
</head>
<body>
    
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                    <p class="contants"> 紹介内容 </p>
                    <a class="register-top" href="{{ route('register') }}">
                        利用を開始する
                    </a>
                </div>
                
            
        </div>
    </div>
</div>
@endsection
</body>