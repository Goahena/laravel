<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        OrderService $orderService
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $config['seo'] = config('apps.order');
        $orders = $this->orderService->paginate($request);

        $template = 'backend.order.index';
        return View('backend.dashboard.layout', compact(
            'template',
            'orders',
            'config',
        ));
    }

    public function detail($id)
    {
        $statuses = [
            '' => 'All',
            '0' => 'Chưa xác nhận',
            '1' => 'Đã xác nhận',
            '2' => 'Đang vận chuyển',
            '3' => 'Đã hoàn thành',
        ];

        $config['seo'] = config('apps.order');
        $orders = $this->orderRepository->findById($id);
        $payments = unserialize($orders->invoice);
        $template = 'backend.order.detail';
        return view('backend.dashboard.layout', compact(
            'template',
            'orders',
            'statuses',
            'config',
            'payments'
        ));
    }
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|integer|in:0,1,2,3',
        ]);

        try {
            $result = $this->orderService->updateOrderStatus($id, $validated['status']);
            return redirect()->back()->with('success', $result);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    public function delete($id)
    {
        $config['seo'] = config('apps.order');
        $order = $this->orderRepository->findById($id);
        $payments = unserialize($order->invoice);
        $template = 'backend.order.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'order',
            'config',
            'payments'
        ));
    }
    public function destroy($id)
    {
        try {
            $this->orderService->deleteOrder($id);
            return redirect()->route('order.index')->with('success', 'Đơn hàng đã bị hủy và số lượng sản phẩm được hoàn lại.');
        } catch (\Exception $e) {
            return redirect()->route('order.index')->with('error', $e->getMessage());
        }
    }
    
    public function releaseReservedQuantity($productId, $quantity)
    {
        $product = Product::findOrFail($productId);

        // Đảm bảo số lượng giả định không âm
        if ($product->reserved_quantity >= $quantity) {
            $product->decrement('reserved_quantity', $quantity); // Giảm số lượng giả định
            return true;
        }

        return false;
    }

    public function revenueReport(Request $request)
    {
        $filters = $request->only(['week', 'month', 'year', 'start_date', 'end_date', 'status']);

        $orders = $this->orderService->getRevenueReport($filters);

        $config['seo'] = config('apps.order');
        $template = 'backend.order.revenue';

        return view('backend.dashboard.layout', compact('orders', 'template', 'filters', 'config'));
    }
}