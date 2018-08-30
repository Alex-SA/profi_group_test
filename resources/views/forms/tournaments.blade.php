@extends('layouts.app')

@section('content')
    @component('components.test')
        Tournaments
    @endcomponent
    <div class="container">
        <div class="row">
            <form class="form-group" >
                <div class="form-group">
                    <input type="hidden" id="tc_url" value="{{ url('api/tournament/create') }}">
                    <label for="tc_tournament_types_id">Type</label>
                    <select id="tc_tournament_types_id" class="form-control">
                        @foreach($tournamentTypes as $tournamentType)
                            <option value="{{ $tournamentType->id }}">{{ $tournamentType->name }}</option>
                        @endforeach
                    </select>
                    <label for="tc_price_to_join">Price to join tournament</label>
                    <input id="tc_price_to_join" class="form-control">
                    <label for="tc_time_of_duel">Time of duel</label>
                    <input id="tc_time_of_duel" class="form-control">
                    <label for="tc_game_types_id">Type of game</label>
                    <select id="tc_game_types_id" class="form-control">
                        @foreach($gameTypes as $gameType)
                            <option value="{{ $gameType->id }}">{{ $gameType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="button" class="btn btn-primary"  onclick="postAction('tc', '')" value="Create New Tournament">
                <label style="display: block">You can see results of test in console</label>
            </form>
            <div class="row">
                <div id="post_result"></div>
            </div>
            <hr>
            <div class="row">
                <form class="form-group" >
                    <input type="hidden" id="ts_url" value="{{ url('api/tournaments') }}">
                    <h3>Select All Tournaments</h3>
                    <input type="button" class="btn btn-primary"  onclick="getAction('ts')" value="Go!">
                </form>
            </div>
        </div>
        <div class="row">
            <div id="show_results"></div>
        </div>
    </div>
@endsection

@section('test_api_js')
    @component('components.test_js')
    @endcomponent
@endsection
