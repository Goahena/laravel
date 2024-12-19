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

        if (isset($condition['status']) && $condition['status'] !== '') {
            $query->where('status', $condition['status']);
        }

        if (!empty($extend['sort_by'])) {
            $query->orderBy('created_at', $extend['sort_by']);
        }

        return $query->paginate($perpage)->withQueryString();
    }
    public function revenuePaginate($request)
    {
        $query = Order::query();

        // Lọc theo trạng thái (nếu có)
        if ($request->has('status') && $request->input('status') !== '') {
            $query->where('status', $request->input('status'));
        }

        // Lọc theo tuần (giả định start_date và end_date dựa trên tuần)
        if ($request->filled('week')) {
            $week = $request->input('week');
            $query->whereBetween('created_at', $this->getWeekRange($week, $request->input('year')));
        }

        // Lọc theo tháng + năm
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->input('month'))
                ->whereYear('created_at', $request->input('year', now()->year)); // Default là năm hiện tại
        }

        // Lọc theo khoảng thời gian (ưu tiên nếu có)
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')]);
        }

        // Truy vấn phân trang
        $perPage = $request->input('perpage', 10); // Default là 10 bản ghi mỗi trang
        return $query->paginate($perPage)->appends($request->query());
    }

    // Hàm tính tuần trong năm
    protected function getWeekRange($week, $year)
    {
        $start = now()->setISODate($year, $week, 1)->startOfDay(); // Thứ 2 của tuần
        $end = now()->setISODate($year, $week, 7)->endOfDay();     // Chủ nhật của tuần

        return [$start, $end];
    }
}
