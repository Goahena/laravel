<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('auth.admin')->with('error', 'Bạn phải đăng nhập để sử dụng chức năng này');
        }

        if (Auth::check() && Auth::user()->user_catalogue_id != '1') {
            return redirect()->route('index')->with('error', 'Tài khoản không có quyền quản trị');
        }

        return $next($request);
    }
}
