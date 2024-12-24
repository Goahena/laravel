<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShoeType;
use App\Models\Brand;
use App\Models\Promotion;
use App\Http\Requests\StoreProductRequest;
use App\Services\Interfaces\BrandServiceInterface as BrandService;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\BrandRepositoryInterface as BrandRepository;

class BrandController extends Controller
{
    protected $brandRepository;
    protected $brandService;

    public function __construct(
        BrandRepository $brandRepository,
        BrandService $brandService
    ) {
        $this->brandRepository = $brandRepository;
        $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        $brands = Brand::all();
        $config['seo'] = config('apps.product');

        $brands = $this->brandService->paginate($request);

        $template = 'backend.brand.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'brands',
            'config',
        ));
    }

    public function store(StoreProductRequest $request)
    {
        if ($this->brandService->create($request)) {
            return redirect()->route('brand.index')->with('success', 'Thêm mới thành thành công');
        }
        return redirect()->route('brand.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    }
    public function create()
    {
        $config['seo'] = config('apps.product');
        $config['method'] = 'create';

        $template = 'backend.product.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }
    public function update($id, StoreProductRequest $updateRequest)
    {
        if ($this->brandService->update($id, $updateRequest)) {
            return redirect()->route('brand.index')->with('success', 'Cập nhật thành thành công');
        }
        return redirect()->route('brand.index')->with('error', 'Cập nhật không thành công, hãy thử lại');
    }
    public function edit($id)
    {
        $brand = $this->brandRepository->findById($id);
        $config['seo'] = config('apps.product');
        $config['method'] = 'edit';
        $template = 'backend.brand.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'brands',
        ));
    }
    public function delete($id)
    {
        $config['seo'] = config('apps.product');
        $brand = $this->brandRepository->findById($id);
        $template = 'backend.brand.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'brand',
            'config'
        ));
    }
    public function destroy($id)
    {
        if ($this->brandService->destroy($id)) {
            return redirect()->route('brand.index')->with('success', 'Xóa thành thành công');
        }
        return redirect()->route('brand.index')->with('error', 'Xóa không thành công, hãy thử lại');
    }
}
