<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShoeType;
use App\Models\Brand;
use App\Models\Promotion;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\Interfaces\PromotionServiceInterface as PromotionService;
use App\Reponsitories\Interfaces\PromotionReponsitoryInterface as PromotionReponsitory;

class PromotionController extends Controller
{
    protected $promotionReponsitory;
    protected $promotionService;

    public function __construct(
        PromotionReponsitory $promotionReponsitory,
        PromotionService $promotionService
    ) {
        $this->promotionReponsitory = $promotionReponsitory;
        $this->promotionService = $promotionService;
    }

    public function index(Request $request)
    {
        $config['seo'] = config('apps.product');

        $promotions = $this->promotionService->paginate($request);

        $template = 'backend.promotion.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'promotions',
        ));
    }

    public function store(StoreProductRequest $request)
    {
        if ($this->promotionService->create($request)) {
            return redirect()->route('promotion.index')->with('success', 'Thêm mới thành thành công');
        }
        return redirect()->route('promotion.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    }
    public function create()
    {
        $config['seo'] = config('apps.product');
        $config['method'] = 'create';

        $template = 'backend.promotion.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }
    public function update($id, UpdateProductRequest $updateRequest)
    {
        if ($this->promotionService->update($id, $updateRequest)) {
            return redirect()->route('promotion.index')->with('success', 'Cập nhật thành thành công');
        }
        return redirect()->route('promotion.index')->with('error', 'Cập nhật không thành công, hãy thử lại');
    }
    public function edit($id)
    {
        $promotion = $this->promotionReponsitory->findById($id);
        $config['seo'] = config('apps.product');
        $config['method'] = 'edit';
        $template = 'backend.promotion.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'promotion',
        ));
    }
    public function delete($id)
    {
        $config['seo'] = config('apps.product');
        $promotion = $this->promotionReponsitory->findById($id);
        $template = 'backend.promotion.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'promotion',
            'config'
        ));
    }
    public function destroy($id)
    {
        if ($this->promotionService->destroy($id)) {
            return redirect()->route('promotion.index')->with('success', 'Xóa thành thành công');
        }
        return redirect()->route('promotion.index')->with('error', 'Xóa không thành công, hãy thử lại');
    }
}
