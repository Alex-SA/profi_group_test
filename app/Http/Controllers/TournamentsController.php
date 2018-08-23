<?php

namespace App\Http\Controllers;

use App\Models\Tournaments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Tournaments::with('tournament_types')
            ->with('game_types')
            ->get(), 200);
    }

    /**
     * Create a new tournament.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'tournament_types_id' => 'required|numeric|exists:tournament_types,id',
            'price_to_join' => 'required|numeric|min:0',
            'time_of_duel' => 'required|numeric|min:0',
            'game_types_id' => 'required|numeric|exists:game_types,id',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $tournament = Tournaments::create($data);
        return response()->json($tournament, 200);
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
     * Display the specified resource.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function show(Tournaments $tournaments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournaments $tournaments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournaments $tournaments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournaments $tournaments)
    {
        //
    }
}
