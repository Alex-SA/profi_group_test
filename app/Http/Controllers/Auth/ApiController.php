<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class ApiController extends Controller
{
    /**
     * Create a new user with credentials
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){

        $data = $request->all();
//        validate signup data
        $validator = Validator::make($data, [
            'nickname' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $data['name'] = $data['nickname'];
//      password hashing
        $data['password'] = bcrypt($data['password']);
//      add new  user
        $user = User::create($data);
        return response()->json($user,201);
    }

    /**
     *
     * User login by credentials
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $data = $request->all();
//        validate login data
        $validator = Validator::make($data, [
            'g-recaptcha-response' => 'required|captcha',
            'password' => 'required',
//            'email' => 'email',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
//      check credentials: email or nickname
        $loginField = '';
        if (isset($data["email"]) && $data["email"] != ""){
            $loginField = 'email';
        } else if (isset($data["nickname"]) && $data["nickname"] != "") {
            $loginField = 'nickname';
        }
        if (!$loginField) {
            return response()->json(["error" => "email or nickname can't be empty"], 401);
        }

//      generate a user's token
        $credentials = $request->only($loginField, 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)){
                return response()->json(["error" => "invalid credentials"], 401);
            }
        } catch (JWTException $e){
            return response()->json(["error" => "could not create token"], 500);
        }
//        return token of user
        return response()->json(['token' => $token],200);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = JWTAuth::parseToken()->toUser();
//        Invalidate user token
        JWTAuth::invalidate();
        return response()->json([
            'logout' => 'User: '. $user["name"] .' logged out successfully.'
        ], 200);
    }
}

