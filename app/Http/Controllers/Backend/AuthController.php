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
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;
use App\Repositories\Interfaces\WardRepositoryInterface as WardService;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Http\Requests\UpdateUserRequest;

class AuthController extends Controller
{
    protected $provinceRepository;
    protected $wardRepository;
    protected $districtRepository;
    protected $userRepository;
    protected $userService;

    public function __construct(
        ProvinceService $provinceRepository,
        WardService $wardRepository,
        DistrictService $districtRepository,
        UserService $userService,
        UserRepository $userRepository
    ) {
        $this->provinceRepository = $provinceRepository;
        $this->wardRepository = $wardRepository;
        $this->districtRepository = $districtRepository;
        $this->userService = $userService;
        $this->userRepository = $userRepository;
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

        // Sử dụng remember
        $remember = $request->has('remember');

        if (Auth::attempt($credential, $remember)) {
            $user = Auth::user();

            $request->session()->put('LogIn', $user->id);
            $request->session()->put('UserName', $user->name);
            $request->session()->put('UserImage', $user->image);

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
        $provinces = $this->provinceRepository->all();
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
    public function edit($id)
    {
        $data = $this->userRepository->findById($id);
        $provinces = $this->provinceRepository->all();
        $template = 'frontend.account.index';

        return view('frontend.layout', compact(
            'template',
            'provinces',
            'data',
        ));
    }
    public function update($id, UpdateUserRequest $updateRequest)
    {
        if ($this->userService->update($id, $updateRequest)) {
            return redirect()->route('auth.edit', ['id' => auth()->id()])->with('success', 'Cập nhật thành thành công');
        }
        return redirect()->route('auth.edit', ['id' => auth()->id()])->with('error', 'Cập nhật không thành công, hãy thử lại');
    }
    public function changePassword()
    {
        $template = 'frontend.account.change-password';

        return view('frontend.layout', compact(
            'template'
        ));
    }
    public function updatePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        /** @var \App\Models\User $user */

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
        }

        // Cập nhật mật khẩu
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('auth.edit', ['id' => auth()->id()])->with('success', 'Đổi mật khẩu thành công!');
    }
}
