@extends('layouts.app')

@section('content')
    <h2>Test REST API: Register</h2>
    <div class="container">
        <div class="row">
            <form class="form-group" >
                <input type="hidden" id="signup_url" value="{{ url('api/auth/signup') }}">
                <label for="signup_name">Name</label>
                <input type="text" name="name" id="signup_name" class="form-control">
                <label for="signup_email">E-mail</label>
                <input type="email" name="email" id="signup_email" class="form-control">
                <label for="signup_password">Password</label>
                <input type="password" name="password" id="signup_password" class="form-control">
                <label for="signup_password_confirmation">Password Confirmation</label>
                <input type="password" name="password_confirmation" id="signup_password_confirmation" class="form-control">
                <div style="margin: 10px 0px;" class="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
                <input type="button" class="btn btn-primary"  onclick="postAction('signup', 'true')" value="SignUp">
                <label style="display: block">You can see results of test in console</label>
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
