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
    public function getAllPaginate()
    {
        return Order::paginate(5);
    }
    public function orderPagination(
        array $columns = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 5
    ) {
        $query = $this->model->select($columns);

        if (isset($condition['is_confirmed']) && $condition['is_confirmed'] !== '') {
            $query->where('is_confirmed', $condition['is_confirmed']);
        }

        if (!empty($extend['sort_by'])) {
            $query->orderBy('created_at', $extend['sort_by']);
        }

        return $query->paginate($perpage)->withQueryString();
    }
}
