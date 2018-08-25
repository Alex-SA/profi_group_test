<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    </head>
    <body>
        <div id="app">
            <div class="container">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
                <h2 class="text-primary">Links to forms for the API test</h2>
                <div class="row">
                    <div class="list-group">
                        <a href="/signup" class="list-group-item list-group-item-action"> <i class="fas fa-user-plus fa-2x" style="color:grey"></i> Register User</a>
                        <a href="/signin" class="list-group-item list-group-item-action"><i class="fas fa-user fa-2x" style="color:green"></i> User Login</a>
                        <a href="/google" class="list-group-item list-group-item-action"> <i class="fab fa-google-plus fa-2x" style="color:red"></i> Login using Google</a>
                        <a href="/facebook" class="list-group-item list-group-item-action"> <i class="fab fa-facebook-square fa-2x" style="color:blue"></i> Login using Facebook</a>
                        <a href="/tournaments" class="list-group-item list-group-item-action"> <i class="fas fa-trophy fa-2x" style="color: yellow"></i> Tournaments</a>
                        <a href="/bets" class="list-group-item list-group-item-action"> <i class="far fa-money-bill-alt fa-2x"></i> Bets</a>
                        <a href="/logout" class="list-group-item list-group-item-action list-group-item-primary"> <i class="fas fa-sign-out-alt fa-2x" style="color: silver"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
