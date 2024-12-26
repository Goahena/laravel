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
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $provinceRepository;

    public function __construct(
        ProvinceService $provinceRepository,
    ) {
        $this->provinceRepository = $provinceRepository;
    }

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
            return redirect()->back()->with('error', 'Chưa có sản phẩm trong giỏ hàng');
        }

        // Lấy sản phẩm đã chọn
        foreach ($check_carts as $check_cart) {
            if (isset($carts[$check_cart])) {
                $payments[$check_cart] = $carts[$check_cart];
            }
        }

        // Nếu người dùng chưa đăng nhập
        if (session()->get('check') == 0) {
            return redirect()->route('auth.admin');
        }
        $provinces = $this->provinceRepository->all();
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
            'provinces',
            'payments'
        ));
    }

    public function store(Request $request)
    {
        // Lấy giỏ hàng từ session
        $carts = session()->get('cart');

        if (!$carts || count($carts) === 0) {
            return redirect()->back()->withErrors(['Giỏ hàng của bạn đang trống.']);
        }

        $payments = unserialize($request->input('payments'));
        DB::beginTransaction();
        try {
            foreach ($payments as $payment) {
                $productId = $payment['id'];
                $quantity = $payment['quantity'];

                // Lấy sản phẩm từ cơ sở dữ liệu
                $product = Product::find($productId);
                if (!$product) {
                    throw new Exception("Sản phẩm với ID {$productId} không tồn tại.");
                }

                // Kiểm tra nếu tổng số lượng khả dụng và số lượng giả định đủ để xử lý đặt hàng
                if ($product->quantity - $product->reserved_quantity < $quantity) {
                    throw new Exception("Sản phẩm '{$product->name}' không đủ số lượng để đặt hàng.");
                }

                // Tăng số lượng giả định (reserved_quantity)
                $product->increment('reserved_quantity', $quantity);
            }
            // Tạo hóa đơn mới trong bảng Orders
            $order = Order::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'ward_id' => $request->input('ward_id'),
                'district_id' => $request->input('district_id'),
                'province_id' => $request->input('province_id'),
                'description' => $request->input('description'),
                'total_price' => $request->input('total_price'),
                'invoice' => $request->input('payments'),
                'payment_method' => $request->input('payment_method'),
                'status' => $request->input('status'), // Mặc định là 0: Chờ xác nhận
                'user_id' => $request->input('user_id'),
            ]);

            // Loại bỏ các sản phẩm đã đặt khỏi giỏ hàng
            foreach ($payments as $id => $details) {
                if (isset($carts[$id])) {
                    unset($carts[$id]);
                }
            }

            // Cập nhật giỏ hàng mới vào session
            session()->put('cart', $carts);
            DB::commit();
            return redirect('/')->with('success', 'Đơn hàng của bạn đã được tạo thành công.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reserveQuantity($productId, $quantity)
    {
        $product = Product::findOrFail($productId);

        // Kiểm tra nếu số lượng khả dụng đủ
        if ($product->quantity - $product->reserved_quantity >= $quantity) {
            $product->increment('reserved_quantity', $quantity); // Cộng số lượng giả định
            return true;
        }

        // Trả về false nếu số lượng không đủ
        return false;
    }
    public function myOrders()
    {
        // Lấy danh sách đơn hàng của người dùng hiện tại
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        $template = 'frontend.order.my-orders';

        return view('frontend.layout', compact('orders', 'template'));
    }
    public function show($id)
    {
        // Lấy đơn hàng của người dùng hiện tại
        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $template = 'frontend.order.show';
    
        $payments = unserialize($order->invoice);
    
        return view('frontend.layout', compact('order', 'payments', 'template'));
    }
    
}
