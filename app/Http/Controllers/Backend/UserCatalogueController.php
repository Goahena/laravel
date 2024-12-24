<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as userCatalogueRepository;
use App\Http\Requests\StoreUserCatalogueRequest;

class UserCatalogueController extends Controller
{
    protected $userCatalogueRepository;
    protected $userCatalogueService;
    public function __construct(
        userCatalogueRepository $userCatalogueRepository,
        UserCatalogueService $userCatalogueService,
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    public function index(Request $request)
    {
        $userCatalogues = $this->userCatalogueService->paginate($request);
        $template = 'backend.user.catalogue.index';
        $config['seo'] = config('apps.userCatalogue');
        return view('backend.dashboard.layout', compact(
            'template',
            'userCatalogues',
            'config',
        ));
    }
    public function store(StoreUserCatalogueRequest $request)
    {
        if ($this->userCatalogueService->create($request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Thêm mới thành thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    }
    public function create()
    {
        $config['seo'] = config('apps.userCatalogue');
        $config['method'] = 'create';
        $template = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }
    public function update($id, StoreUserCatalogueRequest $updateRequest) {
        if ($this->userCatalogueService->update($id, $updateRequest)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Cập nhật thành thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Cập nhật không thành công, hãy thử lại');
    }
    public function edit($id)
    {
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $config['seo'] = config('apps.userCatalogue');
        $config['method'] = 'edit';
        $template = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'userCatalogue',
        ));
    }
    public function delete($id)
    {
        $config['seo'] = config('apps.userCatalogue');
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $template = 'backend.user.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'userCatalogue',
            'config'
        ));
    }
    public function destroy($id) {
        if ($this->userCatalogueService->destroy($id)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Xóa thành thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Xóa không thành công, hãy thử lại');
    }
}
