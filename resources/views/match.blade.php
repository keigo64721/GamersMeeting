<head>
    <link rel="stylesheet" href="{{ secure_asset('/css/match.css') }}" >
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
                                        <strong class="name-text">{{ $matchedUser->toUser->name }}</strong>
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
            
        </div>
    </div>
            
    @endsection
</body>