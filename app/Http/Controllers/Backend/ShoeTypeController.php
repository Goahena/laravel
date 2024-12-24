<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShoeType;
use App\Models\Brand;
use App\Models\Promotion;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\Interfaces\ShoeTypeServiceInterface as ShoeTypeService;
use App\Repositories\Interfaces\ShoeTypeRepositoryInterface as ShoeTypeRepository;

class ShoeTypeController extends Controller
{
    protected $shoeTypeRepository;
    protected $shoeTypeService;

    public function __construct(
        ShoeTypeRepository $shoeTypeRepository,
        ShoeTypeService $shoeTypeService
    ) {
        $this->shoeTypeRepository = $shoeTypeRepository;
        $this->shoeTypeService = $shoeTypeService;
    }

    public function index(Request $request)
    {
        $config['seo'] = config('apps.product');

        $shoeTypes = $this->shoeTypeService->paginate($request);

        $template = 'backend.shoe-type.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'shoeTypes'
        ));
    }

    public function store(StoreProductRequest $request)
    {
        if ($this->shoeTypeService->create($request)) {
            return redirect()->route('shoe-type.index')->with('success', 'Thêm mới thành thành công');
        }
        return redirect()->route('shoe-type.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    }
    public function create()
    {
        $config['seo'] = config('apps.product');
        $config['method'] = 'create';

        $template = 'backend.shoe-type.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }
    public function update($id, UpdateProductRequest $updateRequest)
    {
        if ($this->shoeTypeService->update($id, $updateRequest)) {
            return redirect()->route('shoe-type.index')->with('success', 'Cập nhật thành thành công');
        }
        return redirect()->route('shoe-type.index')->with('error', 'Cập nhật không thành công, hãy thử lại');
    }
    public function edit($id)
    {
        $shoeType = $this->shoeTypeRepository->findById($id);
        $config['seo'] = config('apps.product');
        $config['method'] = 'edit';
        $template = 'backend.shoe-type.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'shoeTypes',
        ));
    }
    public function delete($id)
    {
        $config['seo'] = config('apps.product');
        $shoeType = $this->shoeTypeRepository->findById($id);
        $template = 'backend.shoe-type.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'shoeType',
            'config'
        ));
    }
    public function destroy($id)
    {
        if ($this->shoeTypeService->destroy($id)) {
            return redirect()->route('shoe-type.index')->with('success', 'Xóa thành thành công');
        }
        return redirect()->route('shoe-type.index')->with('error', 'Xóa không thành công, hãy thử lại');
    }
}
