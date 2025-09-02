<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyUserMail;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        // 📩 Gửi email cảnh báo
        Mail::to($request->user()->email)->send(
            new NotifyUserMail(
                'Mật khẩu của bạn đã được thay đổi',
                'Nếu bạn không thực hiện hành động này, vui lòng liên hệ ngay với chúng tôi.'
            )
        );

        return back()->with('success', 'Mật khẩu đã được thay đổi.');
    }
}
