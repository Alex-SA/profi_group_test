@extends('layouts.app')

@section('content')
    @component('components.test')
        Bets
    @endcomponent
    <div class="container">
        <div class="row">
            <form class="form-group" >
                <div class="form-group">
                    <h3 class="text-primary">Create New Bet</h3>
                    <input type="hidden" id="bc_url" value="{{ url('api/bet/create') }}">
                    {{--<label for="bc_user_id">User</label>--}}
                    {{--<select id="bc_user_id" class="form-control">--}}
                        {{--@foreach($users as $user)--}}
                            {{--<option value="{{ $user->id }}">{{ $user->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                    <label for="bc_bet_types_id">Type</label>
                    <select id="bc_bet_types_id" class="form-control">
                        @foreach($betTypes as $betType)
                            <option value="{{ $betType->id }}">{{ $betType->name }}</option>
                        @endforeach
                    </select>
                    <label for="bc_amount">Bet amount</label>
                    <input id="bc_amount" class="form-control">
                    <label for="bc_game_types_id">Type of game</label>
                    <select id="bc_game_types_id" class="form-control">
                        @foreach($gameTypes as $gameType)
                            <option value="{{ $gameType->id }}">{{ $gameType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="button" class="btn btn-primary"  onclick="postAction('bc', '')" value="Go!">
            </form>
            <div class="row">
                <div id="post_result"></div>
            </div>
            <hr>
            <div class="row">
                <form class="form-group" >
                    <input type="hidden" id="bs_url" value="{{ url('api/bets') }}">
                    <h3>Select All Bets (order by game type, amount)</h3>
                    <input type="button" class="btn btn-primary"  onclick="getAction('bs')" value="Go!">
                </form>
            </div>

            <hr>
            <div class="row">
                <form class="form-group" >
                    <input type="hidden" id="bus_url" value="{{ url('api/bets/user/') }}">
                    <h3>Select All Bets of User (order by game type, amount)</h3>
                    <label for="bus_user_id">User</label>
                    <select id="bus_user_id" class="form-control">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} @if ($user->nickname != '') ({{$user->nickname}}) @endif </option>
                        @endforeach
                    </select>
                    <input type="button" class="btn btn-primary"  onclick="getAction('bus', 'true')" value="Go!">
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div id="show_results"></div>
        </div>
    </div>
@endsection

@section('test_api_js')
    @component('components.test_js')
    @endcomponent
@endsection
