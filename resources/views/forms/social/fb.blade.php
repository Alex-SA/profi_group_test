@extends('layouts.app')

@section('content')
    @component('components.test')
        Authorization by FB
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-6 row-block">
                {{--<a href="{{ url('api/auth/fb') }}" class="btn btn-lg btn-primary btn-block">--}}
                <a class="btn btn-lg btn-primary btn-block" onclick="loginFB()">
                    <strong>Login With FB</strong>
                </a>
            </div>
        </div>
    </div>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '{{ env('FACEBOOK_CLIENT_ID') }}',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v3.1'
            });
        };

        (function(d, s, id){
            let js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function loginFB(){
            FB.login(function(response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', function(response) {
                        console.log('Good to see you, ' + response.name + '.');
                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            });
        }
    </script>
@endsection

