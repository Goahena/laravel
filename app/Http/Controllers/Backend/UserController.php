<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ward;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Reponsitories\Interfaces\ProvinceReponsitoryInterface as ProvinceService;
use App\Reponsitories\Interfaces\WardReponsitoryInterface as WardService;
use App\Reponsitories\Interfaces\DistrictReponsitoryInterface as DistrictService;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $provinceReponsitory;
    protected $wardReponsitory;
    protected $districtReponsitory;
    public function __construct(
        UserService $userService,
        ProvinceService $provinceReponsitory,
        WardService $wardReponsitory,
        DistrictService $districtReponsitory,
    ) {
        $this->userService = $userService;
        $this->provinceReponsitory = $provinceReponsitory;
        $this->wardReponsitory = $wardReponsitory;
        $this->districtReponsitory = $districtReponsitory;
    }
    public function index() {
        $users = $this->userService->paginate();
        $template = 'backend.user.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.layout', compact(
            'template',
            'users',
            'config',
        ));
    }
    public function create() {
        $provinces = $this->provinceReponsitory->all();
        $config['seo'] = config('apps.user');
        $template = 'backend.user.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'provinces',
            'config',
        ));
    }
    public function store(StoreUserRequest $request) {
        if($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'THêm mới người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    }
}
