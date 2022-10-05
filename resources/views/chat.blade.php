<head>
    <meta charset="UTF-8">
    <title>チャット</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/match.css') }}" >
    <link rel="stylesheet" href="{{ secure_asset('/css/chatroom.css') }}" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>    
    
    @extends('layouts.app')
    
    @section('content')
    <div class="contents">
        <div class="left-side">
            @if($matchedUsers != NULL)
                <?php $i = 0; ?>
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
                                        @if($matchedUserMessages[$i] !== NULL)
                                            <p class="latest-message-text">{{ $matchedUserMessages[$i]->message }}</p>
                                        @else
                                            <p class="latest-message-text">メッセージはありません</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </button>
                    </form>
                <?php $i++; ?>
                @endforeach
            @else
                <div class="user-block">
                <p>マッチングしたユーザーはいません</p>
            </div>
            @endif
        </div>
        <div class="right-side">
            <div class="user-name">{{ $partner->user->name }}</div>
            <div id="app">
                    <example-component :chatroom-id='@json($chatroom_id)'  :user-id='@json($auth->id)' ></example-component>
            </div>
            
            <script src="{{ mix('js/app.js') }}"></script> 
        </div>
        
    </div>
            
    @endsection
</body>