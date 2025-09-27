<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Hiển thị form login admin
    public function create()
    {
        return view('auth.admin-login'); // Form login riêng
    }

    // Xử lý login admin
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Chỉ cho phép admin login
            if ($user->role !== 'admin') {
                Auth::logout();
                return redirect()->route('admin.login')
                    ->withErrors(['email' => 'Bạn phải đăng nhập bằng tài khoản Admin.']);
            }

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Đăng nhập admin thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
