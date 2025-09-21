<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyUserMail;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only(['name', 'email']));

        // Gửi email thông báo
        $subject = 'Thông tin tài khoản đã được cập nhật';
        $message = "Xin chào {$user->name},\n\nThông tin tài khoản của bạn vừa được cập nhật.";

        Mail::to($user->email)->send(new NotifyUserMail($subject, $message));

        return back()->with('success', 'Cập nhật thông tin thành công! Email đã được gửi.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Gửi email thông báo
        $subject = 'Mật khẩu tài khoản đã được thay đổi';
        $message = "Xin chào {$user->name},\n\nMật khẩu tài khoản của bạn vừa được thay đổi. Nếu không phải bạn thực hiện, vui lòng liên hệ ngay với bộ phận hỗ trợ.";

        Mail::to($user->email)->send(new NotifyUserMail($subject, $message));

        return back()->with('success', 'Đổi mật khẩu thành công! Email đã được gửi.');
    }
}
