<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Reponsitories\OrderReponsitory;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderReponsitory;
    protected $orderService;

    public function __construct(
        OrderReponsitory $orderReponsitory,
        OrderService $orderService
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
        $statuses = [
            '' => 'All',
            '0' => 'Chưa xác nhận',
            '1' => 'Đã xác nhận',
            '2' => 'Đang vận chuyển',
            '3' => 'Đã hoàn thành',
        ];

        $config['seo'] = config('apps.order');
        $orders = $this->orderReponsitory->findById($id);
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
            'status' => 'required|integer|in:0,1,2,3', // Validate giá trị trạng thái
        ]);

        $order = Order::findOrFail($id);
        $order->status = $validated['status']; // Cập nhật trạng thái
        $order->save();

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
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
    public function revenueReport(Request $request)
    {
        $config['seo'] = config('apps.order');
        $week = $request->input('week');
        $month = $request->input('month'); // Không cần giá trị mặc định nữa
        $year = $request->input('year'); // Không cần giá trị mặc định nữa
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $query = Order::query();

        // Lọc theo trạng thái nếu có
        if ($status) {
            $query->where('status', $status);
        }

        // Lọc theo tháng và năm, nếu tháng và năm đều được chọn
        if ($month && $year && !$startDate && !$endDate) {
            $query->whereMonth('created_at', $month)
                ->whereYear('created_at', $year);
        }
        // Lọc theo năm, nếu không chọn tháng
        elseif (!$month && $year && !$startDate && !$endDate) {
            $query->whereYear('created_at', $year);
        }
        // Lọc theo chỉ tháng, nếu không chọn năm
        elseif ($month && !$year && !$startDate && !$endDate) {
            $query->whereMonth('created_at', $month);
        }
        // Lọc theo khoảng thời gian (nếu có)
        elseif ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        // Nếu không có lọc tháng, năm, hoặc ngày, tính tổng doanh thu của tất cả các đơn hàng
        if (!$month && !$year && !$startDate && !$endDate) {
            // Không áp dụng bất kỳ điều kiện lọc nào
        }

        // Truy vấn tổng doanh thu
        $orders = $query->selectRaw('SUM(total_price) as revenue')->get();

        // Template cho view
        $template = 'backend.order.revenue';

        return view('backend.dashboard.layout', compact('orders', 'template', 'week', 'month', 'year', 'startDate', 'endDate', 'config'));
    }
}
