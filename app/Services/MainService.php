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
        // Lấy điều kiện từ request
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['brand_id'] = $request->input('brand_id'); // Thêm điều kiện tìm kiếm theo brand_id
        $condition['shoe_type_id'] = $request->input('shoe_type_id'); // Thêm điều kiện tìm kiếm theo shoe_type_id

        $perPage = $request->integer('perpage') ? $request->integer('perpage') : 9;

        $products = $this->mainRepository->pagination(
            $this->selectPaginate(),
            $condition,
            [], // Có thể thêm join nếu cần
            ['path' => 'store'], // Đường dẫn phân trang
            $perPage,
            ['shoeType', 'brand', 'promotions'] // Các quan hệ (relations)
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
