@extends('layouts.app')

@section('content')
    <h2>Test REST API: Authorization by Social Networks </h2>
    <div class="container">
        <div class="row">
            <div class="col-md-12 row-block">
                <a href="{{ url('api/auth/social/facebook') }}" class="btn btn-lg btn-primary btn-block">
                    <strong>Login With Facebook</strong>
                </a>
                <a href="{{ url('api/auth/social/github') }}" class="btn btn-lg btn-primary btn-block">
                    <strong>Login With Github</strong>
                </a>
                <a href="{{ url('api/auth/social/google') }}" class="btn btn-lg btn-primary btn-block">
                    <strong>Login With Google</strong>
                </a>
            </div>
        </div>
    </div>
@endsection

