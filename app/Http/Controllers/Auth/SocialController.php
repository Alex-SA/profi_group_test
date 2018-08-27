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
//    !!! work only with laravel app
//    /**
//     *  User login by social networks
//     *
//     * @param $social
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function redirectToSocial($social)
//    {
//        try {
//            return Socialite::driver($social)->stateless()->redirect();
//        } catch (Exception $e) {
//            return response()->json([
//                "message" => "can't connect to social network: " . $social,
//                "error" => $e->getMessage()
//            ], 401);
//        }
//    }
//
//    /**
//     * User authorization from social networks
//     *
//     * @param $social
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function handleSocialCallback($social)
//    {
//        try {
//            $user = Socialite::driver($social)->stateless()->user();
//            $create['name'] = $user->getName();
//            if (!isset($create['name'])) {
//                $create['name'] = $user->getNickname();
//            }
//            $create['email'] = $user->getEmail();
//            $create['social_id'] = $social . "::" .$user->getId();
//            $create['password'] = '';
//
//            $userModel = new User;
//            $createdUser = $userModel->addNewFromSocial($create);
////            Auth::loginUsingId($createdUser->id, true);
////            return redirect()->route('home');
//            $createdUser["token"] = JWTAuth::fromUser($createdUser);
//            return response()->json($createdUser, 200);
//
//        } catch (Exception $e) {
//            return response()->json([
//                    "message" => "can't authenticate user from social network: " . $social,
//                    "error" => $e->getMessage()
//                ], 401);
//        }
//    }

    /**
     * User authorization from Google
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function google(Request $request){
        return $this->getTokenForUserFromSocial('google', $request->all(), 'sub');
    }

    /**
     * User authorization from Facebook
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function facebook(Request $request){
        return $this->getTokenForUserFromSocial('facebook', $request->all(), 'id');
    }

    /**
     * @param $social - name of Social network
     * @param $data - response data from Social network
     * @param $idField  - name 'id' field in  response from Social network
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getTokenForUserFromSocial($social, $data, $idField){

        //        TODO: check errors
        $client = new Client();
        $url = config('social.' . $social . '_apis_tokeninfo');
        if ($url == '') {
            return response()->json(['error' => "can't find api tokeninfo ulr for " . $social ], 500);
        }
        $url = $url . $data["token"];
// Get user data from Social Networks by token
        $response = $client->get($url);
        $response = json_decode($response->getBody()->getContents(), true);
        $create['name'] = $response['name'];
        $create['email'] = $response['email'];
        $create['social_id'] = $social . "::" . $response[$idField];
        $create['password'] = '';
        $userModel = new User;
//        add new user if does not exists
        $createdUser = $userModel->addNewFromSocial($create);
//        get JWTAuth token for return to frontend
        $token = JWTAuth::fromUser($createdUser);
//        return user data & user token
        return response()->json(['user' => $createdUser, 'token' => $token], 200);
    }
}