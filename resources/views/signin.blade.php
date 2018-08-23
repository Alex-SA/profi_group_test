@extends('layouts.app')

@section('content')
    <h2>Test REST API: login</h2>
    <div class="container">
        <div class="row">
            <form class="form-group" >
                <input type="hidden" id="signin_url" value="{{ url('api/auth/login') }}">
                <label for="signin_email">E-mail</label>
                <input type="email" name="email" id="signin_email" class="form-control">
                <label for="signin_password">Password</label>
                <input type="password" name="password" id="signin_password" class="form-control">
                <div style="margin: 10px 0px;" class="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
                <input type="button" class="btn btn-primary" onclick="postAction('signin', 'true')" value="Login">
            </form>
        </div>
    </div>
@endsection

@section('google_captcha_js')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection

@section('test_api_js')
    @component('js.auth_js')
    @endcomponent
@endsection
