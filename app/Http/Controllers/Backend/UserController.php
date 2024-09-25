<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ward;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Reponsitories\Interfaces\UserReponsitoryInterface as userReponsitory;
use App\Reponsitories\Interfaces\ProvinceReponsitoryInterface as ProvinceService;
use App\Reponsitories\Interfaces\WardReponsitoryInterface as WardService;
use App\Reponsitories\Interfaces\DistrictReponsitoryInterface as DistrictService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userReponsitory;
    protected $userService;
    protected $provinceReponsitory;
    protected $wardReponsitory;
    protected $districtReponsitory;
    public function __construct(
        userReponsitory $userReponsitory,
        UserService $userService,
        ProvinceService $provinceReponsitory,
        WardService $wardReponsitory,
        DistrictService $districtReponsitory,
    ) {
        $this->userService = $userService;
        $this->provinceReponsitory = $provinceReponsitory;
        $this->wardReponsitory = $wardReponsitory;
        $this->districtReponsitory = $districtReponsitory;
        $this->userReponsitory = $userReponsitory;
    }
    public function index()
    {
        $users = $this->userService->paginate();
        $template = 'backend.user.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.layout', compact(
            'template',
            'users',
            'config',
        ));
    }
    public function store(StoreUserRequest $request)
    {
        if ($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm mới thành thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    }
    public function create()
    {
        $provinces = $this->provinceReponsitory->all();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
        $template = 'backend.user.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'provinces',
            'config',
        ));
    }
    public function update($id, UpdateUserRequest $updateRequest) {
        if ($this->userService->update($id, $updateRequest)) {
            return redirect()->route('user.index')->with('success', 'Cập nhật thành thành công');
        }
        return redirect()->route('user.index')->with('error', 'Cập nhật không thành công, hãy thử lại');
    }
    public function edit($id)
    {
        $user = $this->userReponsitory->findById($id);
        $provinces = $this->provinceReponsitory->all();
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $template = 'backend.user.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'provinces',
            'config',
            'user',
        ));
    }
    public function delete($id)
    {
        $config['seo'] = config('apps.user');
        $user = $this->userReponsitory->findById($id);
        $template = 'backend.user.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'user',
            'config'
        ));
    }
    public function destroy($id) {
        if ($this->userService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa thành thành công');
        }
        return redirect()->route('user.index')->with('error', 'Xóa không thành công, hãy thử lại');
    }
}
