<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lab-Lender') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Kanit|Prompt|Roboto&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #navbar {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 99;
        }

        #fixedbutton {
            position: fixed;
            bottom: 550px;
            right: 550px;
        }

        .footer {
            padding: 7px;
            width: 100%;
            background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
            color: white;
            text-align: center;
        }

        body {
            font-family: 'Kanit';
            background-color: white
        }
    </style>


</head>

<body>

    <div id="app">
        <v-app>
            <!-- <applayout username="{{ Auth::User()->name }}" type="{{ Auth::User()->type }}"></applayout> -->
            <div id="navbar">
                <homelayout username="{{ Auth::User()->name }}" type="{{ Auth::User()->type }}"></homelayout>
            </div>


            <br><br><br><br><br><br><br><br>
            <v-col class="md-9">
                @yield('content')
            </v-col>
        </v-app>
    </div>

    <div class="footer mt-5" >
        <p>&copy; Copyright CPE#25 Chiang Mai University</p>
    </div>

</body>

</html>