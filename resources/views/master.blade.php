<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Siege Stats | @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="/css/app.css"/>
        <link rel="stylesheet" type="text/css" href="/css/master.css"/>
    </head>
    <body>
        <video width="100%" height="100%" autoplay loop id="bg_vid">
            <source src="{{asset('img/background.mp4')}}" type="video/mp4"/>
        </video>
        @include('navbar')

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
<script src="/js/app.js"></script>
