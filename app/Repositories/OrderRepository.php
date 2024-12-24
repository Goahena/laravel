<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Order;

class OrderRepository extends BaseRepository
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

        if (isset($condition['status']) && $condition['status'] !== '') {
            $query->where('status', $condition['status']);
        }

        if (!empty($extend['sort_by'])) {
            $query->orderBy('created_at', $extend['sort_by']);
        }

        return $query->paginate($perpage)->withQueryString();
    }
    public function save(Order $order)
    {
        return $order->save();
    }

    public function delete(Order $order)
    {
        return $order->delete();
    }

    public function getRevenueReport($filters)
    {
        $query = Order::query();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['month']) && !empty($filters['year'])) {
            $query->whereMonth('created_at', $filters['month'])
                  ->whereYear('created_at', $filters['year']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }

        return $query->selectRaw('SUM(total_price) as revenue')->get();
    }
}
