<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        // Validate dữ liệu vào
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required'
        ]);

        // Kiểm tra token khớp với email trong bảng password_resets
        $check = DB::table('password_resets')
            ->where('email', $request->getemail())
            ->where('token', $request->gettoken())
            ->first();

        if (!$check) {
            return back()->withErrors(['email' => 'Token không hợp lệ hoặc đã hết hạn!']);
        }

        // Cập nhật mật khẩu mới cho user
        $user = User::where('email', $request->getemail())->first();
        $user->password = Hash::make($request->setpassword());
        $user->save();

        // Xoá token sau khi dùng xong
        DB::table('password_resets')->where('email', $request->getemail())->delete();

        // Chuyển hướng về login với thông báo
        return redirect('/login')->with('message', 'Mật khẩu đã được cập nhật!');
    }
}
