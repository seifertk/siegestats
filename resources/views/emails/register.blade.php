<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{public_path('css/app.css')}}"/>        

        <title>Complete Your Registration</title>
    </head>
    <body>
        <div class="container">
            <h1>Complete Your Registration</h1>
            <p>    
                Please complete your registration for {{config('app.name')}} by following the link below:
            </p>
            <a href="{{route('register.create', ['token' => $token->token])}}">{{route('register.complete', ['token' => $token->token])}}</a>
        </div>
    </body>
</html>
