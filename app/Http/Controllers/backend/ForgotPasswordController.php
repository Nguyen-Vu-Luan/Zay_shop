<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
class ForgotPasswordController extends Controller
{
    public function showForm() {
        return view('auth.forgot_password');
    }

    public function sendResetLink(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
    
    public function showResetForm($token) {
        return view('auth.reset_password', ['token' => $token]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login.form')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
