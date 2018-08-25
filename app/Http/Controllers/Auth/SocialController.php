<?php


namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Socialite;
use Exception;
use Auth;
use JWTAuth;


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
            return Socialite::driver($social)->stateless()->redirect();
        } catch (Exception $e) {
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
            $user = Socialite::driver($social)->stateless()->user();
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
            $createdUser["token"] = JWTAuth::fromUser($createdUser);
            return response()->json($createdUser, 200);

        } catch (Exception $e) {
            return response()->json([
                    "message" => "can't authenticate user from social network: " . $social,
                    "error" => $e->getMessage()
                ], 401);
        }
    }

    public function google(Request $request){
//        TODO: check errors
        $data = $request->all();
        $client = new Client();
        $url = config('social.googleapis_tokeninfo');
        $response = $client->get(
            $url,
            [
                'query' => [
                    'id_token' => $data["token"],
                ]
            ]
        );
        $response = json_decode($response->getBody()->getContents(), true);
        $create['name'] = $response["name"];
        $create['email'] = $response["email"];
        $create['social_id'] = 'google' . "::" . $response["sub"];
        $create['password'] = '';

        $userModel = new User;
        $createdUser = $userModel->addNewFromSocial($create);
        $token = JWTAuth::fromUser($createdUser);
        return response()->json(['user' => $createdUser, 'token' => $token], 200);
    }

    public function facebook(Request $request){
        $data = $request->all();
        $client = new Client();
        $url = config('social.facebook_apis_tokeninfo') . $data["token"];
        $response = $client->get($url);
        $response = json_decode($response->getBody()->getContents(), true);
        $create['name'] = $response["name"];
        $create['email'] = $response["email"];
        $create['social_id'] = 'facebook' . "::" . $response["id"];
        $create['password'] = '';
//        return response()->json(['response' => $response, 'create' => $create], 200);
        $userModel = new User;
        $createdUser = $userModel->addNewFromSocial($create);
        $token = JWTAuth::fromUser($createdUser);
        return response()->json(['user' => $createdUser, 'token' => $token], 200);

    }
}