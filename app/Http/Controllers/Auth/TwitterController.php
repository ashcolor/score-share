<?php

namespace App\Http\Controllers\Auth;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{

    public function login(Request $request)
    {
        $twitter_connect = new TwitterOAuth(env('TWITTER_API_KEY'), env('TWITTER_API_SECRET'));
        $request_token = $twitter_connect->oauth(
            'oauth/request_token', [
            'oauth_callback' => env('TWITTER_CALLBACK')
        ]);

        $session = $request->session();
        $session->put('oauth_token', $request_token['oauth_token']);
        $session->put('oauth_token_secret', $request_token['oauth_token_secret']);

        $url = $twitter_connect->url('oauth/authorize', [
            'oauth_token' => $request_token['oauth_token']
        ]);
        return redirect($url);
    }

    public function callback(Request $request)
    {
        $session = $request->session();
        $twitter_connect = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            $session->get('oauth_token'),
            $session->get('oauth_token_secret')
        );
        $access_token = $twitter_connect->oauth('oauth/access_token', [
            'oauth_verifier' => $request->input('oauth_verifier'),
            'oauth_token' => $request->input('oauth_token')
        ]);
        $user_connect = new TwitterOAuth(env('TWITTER_API_KEY'), env('TWITTER_API_SECRET'), $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $userInfo = $user_connect->get('account/verify_credentials');

        $user = User::where('twitter_id', $userInfo->id)->first();

        if($user) {
            $user->save(
                [
                    'twitter_name' => $userInfo->name,
                    'twitter_screen_name' => $userInfo->screen_name,
                    'twitter_profile_image_url_https' => $userInfo->profile_image_url_https,
                ]);
        } else {
            $user = User::create(
                [
                    'twitter_id' => $userInfo->id,
                    'twitter_name' => $userInfo->name,
                    'twitter_screen_name' => $userInfo->screen_name,
                    'twitter_profile_image_url_https' => $userInfo->profile_image_url_https,
                ]);
        }

        Auth::login($user, $remember = true);
        return redirect('/');
    }

}
