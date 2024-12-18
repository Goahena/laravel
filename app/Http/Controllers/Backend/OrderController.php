<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Reponsitories\OrderReponsitory as orderReponsitory;
use App\Services\OrderService as orderService;

class OrderController extends Controller
{
    protected $orderReponsitory;
    protected $orderService;
        public function __construct(
            orderReponsitory $orderReponsitory,
            orderService $orderService
        ) {
        $this->orderReponsitory = $orderReponsitory;
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
        $config['seo'] = config('apps.order');
        $orders = $this->orderReponsitory->findById($id);
        $payments = unserialize($orders->invoice);
        $template = 'backend.order.detail';
        return View('backend.dashboard.layout', compact(
            'template',
            'orders',
            'config',
            'payments'
        ));
    }
    public function confirm(Order $order)
    {
        // Chuyển đổi trạng thái is_confirmed
        $order->is_confirmed = !$order->is_confirmed;
        $order->save();

        // Thông báo trạng thái mới
        $status = $order->is_confirmed ? 'Đã xác nhận' : 'Chưa xác nhận';

        return redirect()->back()->with('success', "Trạng thái đơn hàng được cập nhật: $status");
    }
    public function bulkConfirm(Request $request)
    {
        $orderIds = json_decode($request->input('order_ids'), true);

        if (!is_array($orderIds) || empty($orderIds)) {
            return redirect()->back()->with('error', 'Không có đơn hàng nào được chọn.');
        }

        // Xác nhận các đơn hàng
        Order::whereIn('id', $orderIds)->update(['is_confirmed' => true]);

        return redirect()->back()->with('success', 'Đã xác nhận các đơn hàng thành công.');
    }

    public function bulkUnconfirm(Request $request)
    {
        $orderIds = json_decode($request->input('order_ids'), true);

        if (!is_array($orderIds) || empty($orderIds)) {
            return redirect()->back()->with('error', 'Không có đơn hàng nào được chọn.');
        }

        // Hủy xác nhận các đơn hàng
        Order::whereIn('id', $orderIds)->update(['is_confirmed' => false]);

        return redirect()->back()->with('success', 'Đã hủy xác nhận các đơn hàng thành công.');
    }
    public function delete($id)
    {
        $config['seo'] = config('apps.order');
        $order = $this->orderReponsitory->findById($id);
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
        if ($this->orderService->destroy($id)) {
            return redirect()->route('order.index')->with('success', 'Xóa thành thành công');
        }
        return redirect()->route('order.index')->with('error', 'Xóa không thành công, hãy thử lại');
    }
}

