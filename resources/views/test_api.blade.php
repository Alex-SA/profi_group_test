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

    </head>
    <body>
        <div id="app">
            <div class="container">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
                <h2 class="text-primary">Links to forms for the API test</h2>
                <div class="row">
                    <div class="list-group">
                        <a href="/signup" class="list-group-item list-group-item-action">Register User</a>
                        <a href="/signin" class="list-group-item list-group-item-action">User Login</a>
                        <a href="/google" class="list-group-item list-group-item-action">Login using Google</a>
                        <a href="/social" class="list-group-item list-group-item-action">Social Networks</a>
                        <a href="/tournaments" class="list-group-item list-group-item-action">Tournaments</a>
                        <a href="/bets" class="list-group-item list-group-item-action">Bets</a>
                        <a href="/logout" class="list-group-item list-group-item-action list-group-item-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
