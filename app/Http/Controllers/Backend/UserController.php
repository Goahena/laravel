<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ward;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as userRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;
use App\Repositories\Interfaces\WardRepositoryInterface as WardService;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userRepository;
    protected $userService;
    protected $provinceRepository;
    protected $wardRepository;
    protected $districtRepository;
    public function __construct(
        userRepository $userRepository,
        UserService $userService,
        ProvinceService $provinceRepository,
        WardService $wardRepository,
        DistrictService $districtRepository,
    ) {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->wardRepository = $wardRepository;
        $this->districtRepository = $districtRepository;
        $this->userRepository = $userRepository;
    }
    public function index(Request $request)
    {
        $users = $this->userService->paginate($request);
        $template = 'backend.user.user.index';
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
        $provinces = $this->provinceRepository->all();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
        $template = 'backend.user.user.store';
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
        $user = $this->userRepository->findById($id);
        $provinces = $this->provinceRepository->all();
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $template = 'backend.user.user.store';
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
        $user = $this->userRepository->findById($id);
        $template = 'backend.user.user.delete';
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
