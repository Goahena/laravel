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
                if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                    $query->where('product.name', 'LIKE', '%' . $condition['keyword'] . '%')
                          ->orWhere('product.description', 'LIKE', '%' . $condition['keyword'] . '%')
                          ->orWhere('product.price', 'LIKE', '%' . $condition['keyword'] . '%');
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
