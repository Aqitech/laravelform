<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Auth;

class SocialsController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider){
        $userSocial =   Socialite::driver($provider)->stateless()->user();
        $users      =   User::where(['email' => $userSocial->getEmail()])->first();
        if($users){
            Auth::login($users);
            return redirect('/');
        }else{
            if ($provider == 'github') {
               $name =  $userSocial->getNickname();
            }else{
                $name =  $userSocial->getName();
            }
        $user = User::create([
            'name'          => $name,
            'email'         => $userSocial->getEmail(),
            'profile_pic'   => $userSocial->getAvatar(),
            'provider_id'   => $userSocial->getId(),
            'provider'      => $provider,
        ]);
        return redirect()->route('dashboard');
        }
    }
}
