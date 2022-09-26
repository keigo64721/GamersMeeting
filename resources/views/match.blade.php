<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/match.css') }}" >
</head>
<body>    
    
    @extends('layouts.app')
    
    @section('content')
    <div class="contents">
        <div class="left-side">
            @if($matchedUsers != NULL)
                @foreach($matchedUsers as $matchedUser)
                <form action="{{ route('chat') }}" method="GET">
                    @csrf
                    <input type="hidden" name="chatUser" value="{{ $matchedUser->toUser->id }}">
                    <button class="user-button" type="submit">
                        <div class="user-block">
                            <div class="img">
                                <img src="{{ $matchedUser->toUser->status->img_url }}" width=60px height=60px >
                            </div>
                            <div class="text-side">
                                <div class="name">
                                    <p class="name-text">{{ $matchedUser->toUser->name }}</p>
                                </div>
                                <div class="latest-message">
                                    <!--４０文字を超えるメッセージなら...を加える処理が必要-->
                                    <p class="latest-message-text">最近の会話内容。（４０文字を超えるメッセージなら...を加える処理が必要）</p>
                                </div>
                            </div>
                        </div>
                    </button>
                </form>
                @endforeach
            @else
                <div class="user-block">
                <p>マッチングしたユーザーはいません</p>
            </div>
            @endif
            <!----test---->
            <div class="user-block">
                <p>a</p>
            </div>
            <div class="user-block">
                <p>a</p>
            </div>
            <div class="user-block">
                <p>a</p>
            </div>
            <div class="user-block">
                <p>a</p>
            </div>
            <div class="user-block">
                <p>a</p>
            </div>
            <div class="user-block">
                <p>a</p>
            </div>
            <div class="user-block">
                <p>a</p>
            </div>
            <div class="user-block">
                <p>a</p>
            </div>
            <!----test---->
        </div>
        <div class="right-side">
            
        </div>
    </div>
            
    @endsection
</body>