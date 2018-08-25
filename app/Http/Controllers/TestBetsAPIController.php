<?php

namespace App\Http\Controllers;

use App\Models\Types\BetTypes;
use App\Models\Types\GameTypes;
use App\User;
use Auth;
use Illuminate\Http\Request;

class TestBetsAPIController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        $gameTypes = GameTypes::all();
        $betTypes = BetTypes::all();
        return view('forms.bets', compact('users', 'gameTypes', 'betTypes'));
    }
}
