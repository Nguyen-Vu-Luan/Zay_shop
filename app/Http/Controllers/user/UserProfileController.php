<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        return back()->with('success', 'Cập nhật thông tin thành công!');
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

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // Xóa avatar cũ nếu có
        if ($user->avatar && Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }

        // Lưu avatar mới
        $path = $request->file('avatar')->store('avatars', 'public');

        $user->update([
            'avatar' => $path,
        ]);

        return back()->with('success', 'Cập nhật ảnh đại diện thành công!');
    }
}
