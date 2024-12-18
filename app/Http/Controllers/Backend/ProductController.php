<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ShoeType;
use App\Models\Brand;
use App\Models\Promotion;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Reponsitories\Interfaces\ProductReponsitoryInterface as ProductReponsitory;

class ProductController extends Controller
{
    protected $productReponsitory;
    protected $productService;

    public function __construct(
        ProductReponsitory $productReponsitory,
        ProductService $productService
    ) {
        $this->productReponsitory = $productReponsitory;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $promotions = Promotion::all();
        $brands = Brand::all();
        $shoeTypes = ShoeType::all();
        $config['seo'] = config('apps.product');

        $products = $this->productService->paginate($request);

        $template = 'backend.product.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'products',
            'config',
            'promotions',
            'brands',
            'shoeTypes'
        ));
    }

    public function store(StoreProductRequest $request)
    {
        if ($this->productService->create($request)) {
            return redirect()->route('product.index')->with('success', 'Thêm mới thành thành công');
        }
        return redirect()->route('product.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    }
    public function create()
    {
        $config['seo'] = config('apps.product');
        $config['method'] = 'create';

        // Lấy danh sách từ bảng liên quan
        $promotions = Promotion::all();
        $brands = Brand::all();
        $shoeTypes = ShoeType::all();

        $template = 'backend.product.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'promotions',
            'brands',
            'shoeTypes'
        ));
    }
    public function update($id, UpdateProductRequest $updateRequest)
    {
        if ($this->productService->update($id, $updateRequest)) {
            return redirect()->route('product.index')->with('success', 'Cập nhật thành thành công');
        }
        return redirect()->route('product.index')->with('error', 'Cập nhật không thành công, hãy thử lại');
    }
    public function edit($id)
    {
        $promotions = Promotion::all();
        $brands = Brand::all();
        $shoeTypes = ShoeType::all();
        $product = $this->productReponsitory->findById($id);
        $config['seo'] = config('apps.product');
        $config['method'] = 'edit';
        $template = 'backend.product.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'product',
            'shoeTypes',
            'brands',
            'promotions',

        ));
    }
    public function delete($id)
    {
        $config['seo'] = config('apps.product');
        $product = $this->productReponsitory->findById($id);
        $template = 'backend.product.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'product',
            'config'
        ));
    }
    public function destroy($id)
    {
        if ($this->productService->destroy($id)) {
            return redirect()->route('product.index')->with('success', 'Xóa thành thành công');
        }
        return redirect()->route('product.index')->with('error', 'Xóa không thành công, hãy thử lại');
    }
}
