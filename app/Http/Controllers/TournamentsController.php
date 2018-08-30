<?php

namespace App\Http\Controllers;

use App\Http\Resources\TournamentsResource;
use App\Models\Tournaments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class TournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//  Get Tournaments
        $tournaments = Tournaments::with('tournament_types')->with('game_types')->paginate(100);
// Return collection of Tournaments as a resource
        return TournamentsResource::collection($tournaments);

    }

    /**
     * Create a new tournament.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request)
    {
//        Get user from token
        $user = JWTAuth::parseToken()->toUser();
        $data = $request->all();
//        validate tournament`s data
        $validator = Validator::make($data, [
            'tournament_types_id' => 'required|numeric|exists:tournament_types,id',
            'price_to_join' => 'required|numeric|min:0',
            'time_of_duel' => 'required|numeric|min:0',
            'game_types_id' => 'required|numeric|exists:game_types,id',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
//        Create a new tournament
        $tournament = Tournaments::create($data);
        return response()->json(['tournament' => $tournament, 'user' => $user], 200);
    }

}
