<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\ProductReponsitoryInterface;
use App\Reponsitories\BaseReponsitory;
use App\Models\Product;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductReponsitory extends BaseReponsitory implements ProductReponsitoryInterface
{
    protected $model;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate(){
        return Product::paginate(5);
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
            ->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%');
            }
        });
        if (!empty($join)) {
            $query->join(...$join);
        }
        return $query->paginate($perpage)
                    ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
}
