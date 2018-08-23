<?php

namespace App\Http\Controllers;

use App\Models\Bets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BetsController extends Controller
{
    /**
     * Return a listing of bets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Bets::with('bet_types')
            ->with('game_types')
            ->orderBy('game_types_id')
            ->orderBy('amount')
            ->get(), 200);
    }

    /**
     *  Create a new bet.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'required|numeric|exists:users,id',
            'bet_types_id' => 'required|numeric|exists:bet_types,id',
            'amount' => 'required|numeric|min:0',
            'game_types_id' => 'required|numeric|exists:game_types,id',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $bet = Bets::create($data);
        return response()->json($bet, 200);
    }

    /**
     * Return a listing of bets for user
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param Bets $bets
     */
    public function show(User $user)
    {
        $bets = $user->bets;
        if ($bets->count() < 1){
            return response()->json(["message" => "can't find bets for user id: " . $user["id"]], 404);
        }
        return response()->json($bets, 200);
    }

}
