<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function register(Request $request){

        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response()->json($user,201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $data = $request->all();
        $identityField = '';
        $identityValue = '';
        if (isset($data["email"]) && $data["email"] != ""){
            $identityField = 'email';
            $identityValue = $data["email"];
        } else if (isset($data["name"]) && $data["name"] != "") {
            $identityField = 'name';
            $identityValue = $data["name"];
        }
        if ($identityField == "" || $data["password"] == "") {
            return response()->json(["message" => "(email or name) and password can't be empty"], 401);
        }
        $user = User::where($identityField,  $identityValue)->first();
        if (is_null($user) || !Hash::check($data['password'], $user["password"])){
            return response()->json(["message" => "bad email or password "],401);
        }
        return response()->json($user,200);
    }
}
