<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $orderRepository;
    protected $productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        ProductRepository $productRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }
    public function paginate($request)
    {
        $condition['status'] = $request->input('status');
        $sortBy = $request->input('sort_by');
        $perPage = $request->input('perpage') ?: 5;

        $orders = $this->orderRepository->orderPagination(
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
            $order = $this->orderRepository->destroy($id);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public function updateOrderStatus($orderId, $status)
    {
        $order = $this->orderRepository->findById($orderId);

        if (!$order) {
            throw new \Exception('Đơn hàng không tồn tại.');
        }

        // Kiểm tra trạng thái và xử lý kho
        if ($status == 1 && $order->status == 0) {
            $payments = unserialize($order->invoice);

            foreach ($payments as $payment) {
                $product = $this->productRepository->findById($payment['id']);

                if (!$product || ($product->quantity - $payment['quantity'] < 0)) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ số lượng trong kho.");
                }

                // Trừ số lượng sản phẩm
                $this->productRepository->decrementQuantity($product, $payment['quantity']);
            }
        }

        // Cập nhật trạng thái
        $order->status = $status;
        $this->orderRepository->save($order);

        return 'Trạng thái đơn hàng đã được cập nhật.';
    }

    public function deleteOrder($orderId)
    {
        $order = $this->orderRepository->findById($orderId);

        if (!$order || $order->status != 0) {
            throw new \Exception('Đơn hàng không hợp lệ hoặc đã được xử lý.');
        }

        $payments = unserialize($order->invoice);

        foreach ($payments as $payment) {
            $product = $this->productRepository->findById($payment['product_id']);
            $this->productRepository->releaseReservedQuantity($product, $payment['quantity']);
        }

        $this->orderRepository->delete($order);
    }

    public function getRevenueReport($filters)
    {
        return $this->orderRepository->getRevenueReport($filters);
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
