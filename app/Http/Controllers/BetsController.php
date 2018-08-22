<?php

namespace App\Http\Controllers;

use App\Models\Bets;
use App\User;
use Illuminate\Http\Request;

class BetsController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Return user`s bets.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param Bets $bets
     */
    public function show(User $user)
    {
//        $user = User::find($userId);
//        if (is_null($user)) {
//            return response()->json(["message" => "can't find  user id: " . $user["id"]], 404);
//        }
        $bets = $user->bets;
        if ($bets->count() < 1){
            return response()->json(["message" => "can't find bets for user id: " . $user["id"]], 404);
        }
        return response()->json($bets, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bets  $bets
     * @return \Illuminate\Http\Response
     */
    public function edit(Bets $bets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bets  $bets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bets $bets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bets  $bets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bets $bets)
    {
        //
    }
}
