<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Carbon;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Reponsitories\Interfaces\ProvinceReponsitoryInterface as ProvinceService;
use App\Reponsitories\Interfaces\WardReponsitoryInterface as WardService;
use App\Reponsitories\Interfaces\DistrictReponsitoryInterface as DistrictService;
use App\Reponsitories\Interfaces\UserReponsitoryInterface as UserReponsitory;
use App\Services\Interfaces\UserServiceInterface as UserService;

class AuthController extends Controller
{
    protected $provinceReponsitory;
    protected $wardReponsitory;
    protected $districtReponsitory;
    protected $userReponsitory;
    protected $userService;

    public function __construct(
        ProvinceService $provinceReponsitory,
        WardService $wardReponsitory,
        DistrictService $districtReponsitory,
        UserService $userService,
        UserReponsitory $userReponsitory
    ) {
        $this->provinceReponsitory = $provinceReponsitory;
        $this->wardReponsitory = $wardReponsitory;
        $this->districtReponsitory = $districtReponsitory;
        $this->userService = $userService;
        $this->userReponsitory = $userReponsitory;
    }

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
            $user = Auth::user();

            $request->session()->put('LogIn', $user->id);
            $request->session()->put('UserName', $user->name);

            $check = $user->user_catalogue_id == '1' ? '1' : '2';
            $request->session()->put('check', $check);

            if ($check == '1') {
                return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công');
            } elseif ($check == '2') {
                return redirect()->route('index')->with('success', 'Đăng nhập thành công');
            }
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

    public function register()
    {
        $provinces = $this->provinceReponsitory->all();
        return view('backend.auth.register', compact(
            'provinces',
        ));
    }

    public function storeRegister(StoreUserRequest $request)
    {
        if ($this->userService->create($request)) {
            return redirect()->route('auth.admin')->with('success', 'Thêm mới thành thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    }
}
