<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct() {
        // Middleware nếu cần
    }

    public function index() {
    
        // Tổng doanh thu theo tuần
        $revenueWeekly = DB::table('order')
            ->where('status', 3)
            ->whereBetween('updated_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->sum('total_price'); // Trả về tổng dưới dạng số chính xác
    
        // Tổng doanh thu theo tháng
        $revenueMonthly = DB::table('order')
            ->where('status', 3)
            ->whereBetween('updated_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->sum('total_price');
    
        // Tổng số người dùng có publish = 1 và user_catalogue_id = 2
        $totalUsers = DB::table('users')
            ->where('publish', 1)
            ->where('user_catalogue_id', 2)
            ->count();
    
        $template = 'backend.dashboard.home.index';
    
        return view('backend.dashboard.layout', compact(
            'template',
            'revenueWeekly',
            'revenueMonthly',
            'totalUsers' // Thêm biến này để truyền sang view
        ));
    }
    
}
