<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function Callback($provider)
    {
        $user_social = Socialite::driver($provider)->stateless()->user();
        // dd($user_social);
        $users = User::where(['email' => $user_social->getEmail()])->first();
        // dd($users);
        if ($users) {
            Auth::login($users);
            return redirect('/');
        } else {
            $user = User::create([
                'name'          => $user_social->getName(),
                'first_name'    => $user_social->getName(),
                'last_name'     => $user_social->getName(),
                'email'         => $user_social->getEmail(),
                'image'         => $user_social->getAvatar(),
                'provider_id'   => $user_social->getId(),
                'provider'      => $provider,
            ]);
            return redirect()->route('home');
        }
    }


    
}
