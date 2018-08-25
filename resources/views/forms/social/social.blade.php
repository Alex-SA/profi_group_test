@extends('layouts.app')

@section('content')
    @component('components.test')
        Authorization by Social Networks
    @endcomponent
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

