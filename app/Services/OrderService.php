<?php

namespace App\Services;

use App\Reponsitories\OrderReponsitory as OrderReponsitory;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\select;

/**
 * Class UserService
 * @package App\Services
 */
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
        $condition['is_confirmed'] = $request->input('is_confirmed');
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
            echo $e->getMessage();
            die();
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
