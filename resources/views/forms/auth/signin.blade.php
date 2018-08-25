@extends('layouts.app')

@section('content')
    @component('components.test')
        Login
    @endcomponent
    <div class="container">
        <div class="row">
            <form class="form-group" >
                <input type="hidden" id="signin_url" value="{{ url('api/auth/login') }}">
                <label for="signin_email">E-mail</label>
                <input type="email" name="email" id="signin_email" class="form-control">
                <label for="signin_email">OR Name</label>
                <input type="name" name="name" id="signin_name" class="form-control">
                <label for="signin_password">Password</label>
                <input type="password" name="password" id="signin_password" class="form-control">
                <div style="margin: 10px 0px;" class="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
                <input type="button" class="btn btn-primary" onclick="postAction('signin', 'true')" value="Login">
            </form>
        </div>
    </div>
    {{--<button onclick="getSocial('{{ url('api/auth/social/github') }}')">Git</button>--}}

@endsection

@section('google_captcha_js')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection

@section('test_api_js')
    @component('components.test_js')
    @endcomponent
@endsection
