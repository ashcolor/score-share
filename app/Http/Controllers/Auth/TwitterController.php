<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{

    public function callback(Request $request)
    {
        $twitterUserInfo = Socialite::driver('twitter')->user();

        $user = User::where('twitter_id', $twitterUserInfo->id)->first();
        if($user) {
            $user->save(
                [
                    'twitter_name' => $twitterUserInfo->getNickname(),
                    'twitter_screen_name' => $twitterUserInfo->getName(),
                    'twitter_profile_image_url_https' => $twitterUserInfo->getAvatar(),
                ]);
        } else {
            $user = User::create(
                [
                    'twitter_id' => $twitterUserInfo->id,
                    'twitter_name' => $twitterUserInfo->getNickname(),
                    'twitter_screen_name' => $twitterUserInfo->getName(),
                    'twitter_profile_image_url_https' => $twitterUserInfo->getAvatar(),
                ]);
        }

        Auth::login($user, $remember = true);
        return redirect('/');
    }

}
