<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kanit|Prompt|Roboto&display=swap" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        html,
        body {
            background-image: url(/img/welcome-bg.png);
            background-repeat: repeat-y;
            color: #636b6f;
            font-family: 'Roboto', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background-size: 100%;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>



<body>
<v-content>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a style="text-decoration : none; color : #FFFFFF; " href="{{ url('/home') }}">Home</a>
            @else
            <a style="text-decoration : none; color : #FFFFFF; " href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a style="text-decoration : none; color : #FFFFFF; " href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
        <div id="app">
            
                <welcome-card />
        </div>
    </div>

            </v-content>
</body>

</html>