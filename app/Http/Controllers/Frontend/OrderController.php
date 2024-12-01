<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\ShoeType;
use App\Models\User;
use App\Models\UserCatalogue;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data = User::where('id', session('LogIn'))->first();
        $products = Product::all();
        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $users = User::all();
        $usercatalogues = UserCatalogue::all();
        $promotions = Promotion::all();
        $template = 'frontend.order.index';

        $carts = session()->get('cart');
        if (!$carts) {
            $carts = array();
        }

        return view('frontend.layout', compact(
            'template',
            'data',
            'brands',
            'shoetypes',
            'products',
            'carts',
            'users',
            'usercatalogues',
            'promotions',
        ));;
    }

    public function payment(Request $request)
    {
        // Lấy giỏ hàng từ session
        $carts = session()->get('cart', []);

        // Lọc sản phẩm được chọn
        $payments = [];
        $check_carts = $request->input('check-cart');

        // Kiểm tra nếu không có sản phẩm nào được chọn
        if (!is_array($check_carts) || empty($check_carts)) {
            return redirect()->back()->with('error', 'No products selected.');
        }

        // Lấy sản phẩm đã chọn
        foreach ($check_carts as $check_cart) {
            if (isset($carts[$check_cart])) {
                $payments[$check_cart] = $carts[$check_cart];
            }
        }

        // Nếu người dùng chưa đăng nhập
        if (session()->get('check') == 0) {
            return view('auth.login');
        }

        // Lấy thông tin cần thiết
        $data = User::where('id', session('LogIn'))->first();
        $products = Product::all();
        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $users = User::all();
        $usercatalogues = UserCatalogue::all();
        $promotions = Promotion::all();
        $template = 'frontend.order.index';

        // Trả dữ liệu view chỉ với `payments`
        return view('frontend.layout', compact(
            'template',
            'data',
            'brands',
            'shoetypes',
            'products',
            'users',
            'usercatalogues',
            'promotions',
            'payments'
        ));
    }

    public function store(Request $request)
    {
        // Lấy giỏ hàng từ session
        $carts = session()->get('cart');
    
        // Tạo hóa đơn mới trong bảng DonHang
        $order = Order::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'total_price' => $request->input('total_price'),
            'invoice' => $request->input('payments'),
            'payment_method' => $request->input('payment_method'),
        ]);
    
        // Loại bỏ các sản phẩm đã thanh toán khỏi giỏ hàng
        $oks = unserialize($request->input('payments'));
        foreach ($oks as $id => $ok) {
            if (isset($carts[$id])) {
                unset($carts[$id]);
            }
        }
    
        // Cập nhật giỏ hàng mới vào session
        session()->put('cart', $carts);
    
        // Điều hướng người dùng về trang chủ
        return Redirect('/');
    }
}