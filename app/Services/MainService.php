<?php

namespace App\Services;

use App\Services\Interfaces\MainServiceInterface;
use App\Repositories\Interfaces\MainRepositoryInterface as MainRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MainService implements MainServiceInterface
{
    protected $mainRepository;

    public function __construct(MainRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function paginate($request)
    {
        // Lấy các điều kiện tìm kiếm từ request
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['brand_id'] = $request->input('brand_id'); // Lấy id thương hiệu
        $condition['shoe_type_id'] = $request->input('shoe_type_id'); // Lấy id loại giày
        $condition['price'] = $request->input('price'); // Lấy giá

        // Số lượng sản phẩm trên mỗi trang
        $perPage = $request->integer('perpage') ?: 9;

        // Truyền các điều kiện vào repository để truy vấn cơ sở dữ liệu
        $products = $this->mainRepository->pagination(
            $this->selectPaginate(),
            $condition,
            [],
            ['path' => 'store'], // Đường dẫn cho phân trang
            $perPage,
            ['shoeType', 'brand', 'promotions'] // Quan hệ giữa các bảng
        );

        return $products;
    }



    private function selectPaginate()
    {
        return [
            'product.id',
            'product.name',
            'product.shoe_type_id',
            'product.brand_id',
            'product.slug',
            'product.description',
            'product.price',
            'product.quantity',
            'product.image_1',
            'product.image_2',
            'product.image_3',
            'product.image_4',
            'product.promotion_id',
            'product.purchase_quantity',
        ];
    }
}
