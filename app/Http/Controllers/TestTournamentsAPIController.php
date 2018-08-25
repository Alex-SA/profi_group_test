<?php

namespace App\Http\Controllers;

use App\Models\Types\GameTypes;
use App\Models\Types\TournamentTypes;
use Illuminate\Http\Request;

class TestTournamentsAPIController extends Controller
{
    public function index()
    {
        $gameTypes = GameTypes::all();
        $tournamentTypes = TournamentTypes::all();
        return view('forms.tournaments', compact('gameTypes', 'tournamentTypes'));
    }
}
