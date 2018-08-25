@extends('layouts.app')

@section('content')
    @component('components.test')
        Login
    @endcomponent
    <div class="container">
        <div class="row">
            <form class="form-group" >
                <input type="hidden" id="logout_url" value="{{ url('api/auth/logout') }}">
                <input type="button" class="btn btn-primary" onclick="getAction('logout', '')" value="Logout">
            </form>
        </div>
    </div>
@endsection

@section('test_api_js')
    @component('components.test_js')
    @endcomponent
@endsection
