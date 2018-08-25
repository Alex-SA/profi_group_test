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
@endsection

@section('test_api_js')
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
                    let fbToken = response.authResponse.accessToken;
                    console.log('------- From Facebook ------- ');
                    console.log('FB token: ' + fbToken);
//                    FB.api('/me?fields=id,name,email', function(response) {
//                        console.log('Good to see you, ' + response.name + '.');
//                        console.log('Good to see mail, ' + response.email + '.');
//                    });
                    getAPITokenForSocialClient('/api/auth/facebook', fbToken);
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }},
                {scope: 'email'}
            );
        }
    </script>
    @component('components.test_js')
    @endcomponent

@endsection
