<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\MainReponsitoryInterface;
use App\Models\Product;

class MainReponsitory extends BaseReponsitory implements MainReponsitoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

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
            ->with($relations)
            ->where(function ($query) use ($condition) {
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
            });
    
        if (!empty($join)) {
            $query->join(...$join);
        }
    
        return $query->paginate($perpage)
                     ->withQueryString()
                     ->withPath(env('APP_URL') . $extend['path']);
    }
    
}
