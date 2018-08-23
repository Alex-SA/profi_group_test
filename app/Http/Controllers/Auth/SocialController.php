<?php


namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;


class SocialController extends Controller
{
    /**
     *  User login by social networks
     *
     * @param $social
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectToSocial($social)
    {
        try {
            return Socialite::driver($social)->redirect();
        } catch (Exception $e) {

//            dd('Four!', $e);
            return response()->json([
                "message" => "can't connect to social network: " . $social,
                "error" => $e->getMessage()
            ], 401);
        }
    }

    /**
     * User authorization from social networks
     *
     * @param $social
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleSocialCallback($social)
    {
        try {
            $user = Socialite::driver($social)->user();
            $create['name'] = $user->getName();
            if (!isset($create['name'])) {
                $create['name'] = $user->getNickname();
            }
            $create['email'] = $user->getEmail();
            $create['social_id'] = $social . "::" .$user->getId();
            $create['password'] = '';

            $userModel = new User;
            $createdUser = $userModel->addNewFromSocial($create);
//            Auth::loginUsingId($createdUser->id, true);
//            return redirect()->route('home');
            return response()->json($createdUser, 200);

        } catch (Exception $e) {
            return response()->json([
                    "message" => "can't authenticate user from social network: " . $social,
                    "error" => $e->getMessage()
                ], 401);
//            return redirect('api/auth/social/$social');
        }
    }
}