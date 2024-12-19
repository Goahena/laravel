<?php

namespace App\Services;

use App\Reponsitories\OrderReponsitory;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $orderReponsitory;
    public function __construct(
        OrderReponsitory $orderReponsitory
    ) {
        $this->orderReponsitory = $orderReponsitory;
    }
    public function paginate($request)
    {
        $condition['status'] = $request->input('status');
        $sortBy = $request->input('sort_by');
        $perPage = $request->input('perpage') ?: 5;

        $orders = $this->orderReponsitory->orderPagination(
            ['*'],
            $condition,
            [],
            ['sort_by' => $sortBy],
            $perPage
        );

        return $orders;
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderReponsitory->destroy($id);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    private function selectPaginate()
    {
        return [
            'id',
            'name',
            'phone',
            'payment_method',
            'address',
            'description',
            'total_price',
            'invoice'
        ];
    }
}