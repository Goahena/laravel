<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MainRepositoryInterface;
use App\Models\Product;

class MainRepository extends BaseRepository implements MainRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    // MainRepository.php
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 5,
        array $relations = []
    ) {
        $query = $this->model
            ->select($column)
            ->with($relations);

        // Thực hiện JOIN bảng `promotions`
        $query->join('promotions', 'product.promotion_id', '=', 'promotions.id');

        // Áp dụng điều kiện tìm kiếm trong where
        $query->where(function ($query) use ($condition) {
            // Tìm kiếm theo keyword
            if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('product.name', 'LIKE', '%' . $condition['keyword'] . '%')
                    ->orWhere('product.description', 'LIKE', '%' . $condition['keyword'] . '%')
                    ->orWhere('product.price', 'LIKE', '%' . $condition['keyword'] . '%');
            }

            // Tìm kiếm theo brand_id
            if (isset($condition['brand_id']) && !empty($condition['brand_id'])) {
                $query->where('product.brand_id', $condition['brand_id']);
            }

            // Tìm kiếm theo shoe_type_id
            if (isset($condition['shoe_type_id']) && !empty($condition['shoe_type_id'])) {
                $query->where('product.shoe_type_id', $condition['shoe_type_id']);
            }

            // Tìm kiếm theo price (giá)
            if (isset($condition['price']) && !empty($condition['price'])) {
                $priceRange = explode('-', $condition['price']);

                if (count($priceRange) == 2) {
                    $minPrice = $priceRange[0];
                    $maxPrice = $priceRange[1];

                    $query->whereRaw(
                        'product.price * (1 - promotions.promotion_value / 100) BETWEEN ? AND ?',
                        [$minPrice, $maxPrice]
                    );
                } elseif (count($priceRange) == 1) {
                    $minPrice = $priceRange[0];

                    $query->whereRaw(
                        'product.price * (1 - promotions.promotion_value / 100) <= ?',
                        [$minPrice]
                    );
                }
            }
        });

        // Thực hiện JOIN nếu cần
        if (!empty($join)) {
            $query->join(...$join);
        }

        // Phân trang kết quả
        return $query->paginate($perpage)
            ->withQueryString()
            ->withPath(env('APP_URL') . $extend['path']);
    }
}
