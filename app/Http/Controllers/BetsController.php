<?php

namespace App\Http\Controllers;

use App\Http\Resources\BetsResource;
use App\Models\Bets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class BetsController extends Controller
{
    /**
     * Return a listing of bets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (! $user = JWTAuth::parseToken()->authenticate()){
//            return response()->json(['error' => 'user not found'], 401);
//        }

//      Get all bets
        $bets = Bets::with('bet_types')
            ->with('game_types')
            ->orderBy('game_types_id')
            ->orderBy('amount')
            ->paginate(100);
        return BetsResource::collection($bets);
//        return response()->json( Bets::with('bet_types')
//            ->with('game_types')
//            ->orderBy('game_types_id')
//            ->orderBy('amount')
//            ->get(), 200);
    }

    /**
     *  Create a new bet.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

//        Get user from token
        $user = JWTAuth::parseToken()->toUser();
        $data = $request->all();
//        add user id in a new bet
        $data["user_id"] = $user["id"];
//        validate bet data
        $validator = Validator::make($data, [
//            'user_id' => 'required|numeric|exists:users,id',
            'bet_types_id' => 'required|numeric|exists:bet_types,id',
            'amount' => 'required|numeric|min:0',
            'game_types_id' => 'required|numeric|exists:game_types,id',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
//        Create a new bet
        $bet = Bets::create($data);
        return response()->json(['new_bet' => $bet, 'user' => $user], 200);
    }

    /**
     * Return a listing of bets for user
     *
     * @param User $user
     * @return BetsResource
     * @internal param Bets $bets
     */
    public function show(User $user)
    {
//        Get user from token
        $currentUser = JWTAuth::parseToken()->toUser();
        if ($currentUser["id"] != $user["id"]){
            return response()->json(["error" => "you can see only your bets"], 401);
        }
//        Get user`s bets
        $bets = $user->bets;
        if ($bets->count() < 1){
            return response()->json(["error" => "can't find bets for user id: " . $user["id"]], 404);
        }
        return new BetsResource($bets);
//        return response()->json($bets, 200);
    }

}
