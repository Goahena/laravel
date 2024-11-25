<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct() {}

    public function index()
    {
        if (Auth::id() > 0) {
            return redirect()->route('dashboard.index');
        }
        return view('backend.auth.login');
    }

    public function login(AuthRequest $request)
    {
        $credential = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credential)) {
            // Lấy thông tin người dùng đang đăng nhập
            $user = Auth::user();

            // Lưu thông tin vào session
            $request->session()->put('LogIn', $user->id);
            $request->session()->put('check', $user->role == 'admin' ? '1' : '2'); // Giả sử `role` chứa quyền user

            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->route('auth.admin')->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
    }

    public function logout(Request $request)
    {
        // Xóa thông tin session
        $request->session()->forget('LogIn');
        $request->session()->put('check', '0');

        // Đăng xuất khỏi Auth
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.admin');
    }


    // public function login(AuthRequest $request)
    // {
    //     $credential = [
    //         'email' => $request->input('email'),
    //         'password' => $request->input('password')
    //     ];

    //     if (Auth::attempt($credential)) {
    //         return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công');
    //     }

    //     return redirect()->route('auth.admin')->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
    // }
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect()->route('auth.admin');
    // }
}
