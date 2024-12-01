<?php

namespace App\Reponsitories;

use App\Reponsitories\BaseReponsitory;
use App\Models\Order;


class OrderReponsitory extends BaseReponsitory
{
    protected $model;
    public function __construct(Order $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate(){
        return Order::paginate(5);
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
