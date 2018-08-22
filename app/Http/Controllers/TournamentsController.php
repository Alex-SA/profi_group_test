<?php

namespace App\Http\Controllers;

use App\Models\Tournaments;
use Illuminate\Http\Request;

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

        $tournament = Tournaments::create($request->all());
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
