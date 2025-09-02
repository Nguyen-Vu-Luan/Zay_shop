<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct() {}
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(AuthRequest $request)
    {

        $credentials = $request->validate([
            'name'    => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Phân quyền sau khi đăng nhập
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('shop');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('shop');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            ['name' => $googleUser->getName(), 'password' => bcrypt(uniqid()), 'role' => 'user']
        );
        Auth::login($user);
        return redirect()->route('shop');
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'agree' => 'accepted',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        return redirect()->route('shop')->with('success', 'Đăng ký thành công!');
    }
}
