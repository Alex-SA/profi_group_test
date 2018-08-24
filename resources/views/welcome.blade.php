<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container">
                <h1>Links on forms for API test</h1>
            <div class="row">
                <div class="list-group">
                    <a href="/signup" class="list-group-item list-group-item-action">Register User</a>
                    <a href="/signin" class="list-group-item list-group-item-action">User Login</a>
                    <a href="/social" class="list-group-item list-group-item-action">Social Networks</a>
                    <a href="/logout" class="list-group-item list-group-item-action">Logout</a>
                    <a href="/tournaments" class="list-group-item list-group-item-action">Tournaments</a>
                    <a href="/bets" class="list-group-item list-group-item-action">Bets</a>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
