
<head>
    <meta charset="UTF-8">
    <title>チャット</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/chatroom.css') }}" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
 
<body>
    
    <div id="app">
        <example-component :chatroom-id='@json($chatroom_id)'  :user-id='@json($auth->id)'></example-component>
    </div>
 
    <script src="{{ mix('js/app.js') }}"></script>
</body>
 
</html>