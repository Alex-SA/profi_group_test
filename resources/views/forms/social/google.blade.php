@extends('layouts.app')

@section('meta')
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="{{ env('GOOGLE_CLIENT_ID') }}">
@endsection

@section('head_js')
    <script src="https://apis.google.com/js/platform.js" async defer></script>
@endsection

@section('content')
    @component('components.test')
        Authorization by Go
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-md-6 row-block">
                <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
            </div>
        </div>
        {{--<a href="#" onclick="signOut();">Sign out</a>--}}
    </div>

@endsection

@section('test_api_js')
    <script>
        function onSignIn(googleUser) {
            console.log('---------- From Google -----------');
            // Useful data for your client-side scripts:
            let profile = googleUser.getBasicProfile();
            console.log("ID: " + profile.getId()); // Don't send this directly to your server!
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log("Image URL: " + profile.getImageUrl());
            console.log("Email: " + profile.getEmail());

            // The ID token you need to pass to your backend:
            let id_token = googleUser.getAuthResponse().id_token;
            console.log("Google Token: " + id_token);
            getAPITokenForGoogleClient('/api/auth/google', id_token)

        }

        function signOut() {
            let auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                console.log('User signed out.');
            });
        }

        function getAPITokenForGoogleClient(url, token){
            console.log('---------- From backend -----------');
            $.ajaxSetup({
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });
            $.post(
                url,
                JSON.stringify({token: token}),
                function(data) {
                    console.log(data);
                    if (data.hasOwnProperty("token")) {
//            save user token to LocalStorage (token from backend)
                        localStorage.setItem('token', data.token);
                    }
                })
                .fail(function(data, textStatus, xhr) {
                    console.log("error", data.status);
                    console.log("STATUS: "+xhr);
                    console.log(data.responseJSON);
                });
        }

    </script>

@endsection
