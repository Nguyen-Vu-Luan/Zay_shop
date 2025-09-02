<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()
        ],[
                'name' => $googleUser->getName(), 
                'password' => bcrypt(uniqid()), 
                'role' => 'user'
        ]);
        Auth::login($user);
        return redirect()->route('shop');
        // return redirect()->route($user->role === 'admin' ? 'dashboard' : 'shop');
    }
}
