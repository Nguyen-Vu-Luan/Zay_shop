<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyUserMail;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'agree' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Mail::to($user->email)->send(
            new NotifyUserMail(
                'Chào mừng bạn đến với Zay Shop',
                'Tài khoản của bạn đã được tạo thành công. Hãy đăng nhập và bắt đầu mua sắm ngay!'
            )
        );

        return redirect()->route('login')->with('success', 'Đăng ký thành công, vui lòng đăng nhập!');
    }
}
