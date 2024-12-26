<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\ShoeType;
use App\Models\User;
use App\Models\UserCatalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\MainRepositoryInterface as MainRepository;
use App\Services\Interfaces\MainServiceInterface as MainService;
use Laravel\Prompts\Prompt;

class MainController extends Controller
{
    protected $mainRepository;
    protected $mainService;
    public function __construct(
        MainRepository $mainRepository,
        MainService $mainService
    ) {
        $this->mainRepository = $mainRepository;
        $this->mainService = $mainService;
    }
    public function index()
    {
        if (session()->get('cart') == null) {
            $cart = array();
            session()->put('cart', $cart);
        }
        $data = User::where('id', session('LogIn'))->first();
        $products = DB::table('product')
            ->join('brands', 'product.brand_id', '=', 'brands.id')
            ->leftJoin('promotions', 'product.promotion_id', '=', 'promotions.id')
            ->select('product.*', 'brands.brand_name as brand_name', 'promotions.promotion_name', 'promotions.promotion_value')
            ->orderBy('product.updated_at', 'desc')
            ->get();

        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $users = User::all();
        $usercatalogues = UserCatalogue::all();
        $promotions = Promotion::all();
        $template = 'frontend.home.index';
        $lastestshoes = DB::table('product')
            ->leftJoin('promotions', 'product.promotion_id', '=', 'promotions.id')
            ->select('product.*', 'promotions.promotion_name', 'promotions.promotion_value')
            ->orderBy('product.updated_at', 'desc')
            ->get();

        $featuredshoes = DB::table('product')->orderBy('purchase_quantity', 'desc')->get();

        return view('frontend.layout', compact(
            'template',
            'data',
            'brands',
            'shoetypes',
            'products',
            'users',
            'usercatalogues',
            'promotions',
            'lastestshoes',
            'featuredshoes',
        ));;
    }
    public function store(Request $request)
    {
        $data = User::where('id', session('LogIn'))->first();

        // Lấy sản phẩm theo các tiêu chí tìm kiếm
        $products = $this->mainService->paginate($request);

        // Lấy danh sách thương hiệu và loại giày
        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        // Thiết lập SEO
        $template = 'frontend.product.index';
        $config['seo'] = config('apps.product');

        // Trả về view với các dữ liệu
        return view('frontend.layout', compact(
            'template',
            'products',
            'brands',
            'shoetypes',
            'config'
        ));
    }


    public function payment()
    {
        $data = User::where('id', session('LogIn'))->first();
        $products = DB::table('product')
            ->join('brands', 'product.brand_id', '=', 'brands.id')
            ->leftJoin('promotions', 'product.promotion_id', '=', 'promotions.id')
            ->select('product.*', 'brands.brand_name as brand_name', 'promotions.promotion_name', 'promotions.promotion_value')
            ->orderBy('product.updated_at', 'desc')
            ->get();

        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $users = User::all();
        $usercatalogues = UserCatalogue::all();
        $promotions = Promotion::all();
        $template = 'frontend.store.index';

        return view('frontend.layout', compact(
            'template',
            'data',
            'brands',
            'shoetypes',
            'products',
            'users',
            'usercatalogues',
            'promotions',
            'lastestshoes',
            'featuredshoes',
        ));;
    }

    public function product($slug)
    {
        $data = User::where('id', session('LogIn'))->first();

        // Lấy thông tin sản phẩm theo slug
        $product = Product::with('promotions')->where('slug', $slug)->firstOrFail();

        // Cập nhật số lượng khả dụng trong sản phẩm
        $product->available_quantity = $product->quantity - $product->reserved_quantity;

        $sameproducts = Product::query()
            ->where('brand_id', $product->brand_id)
            ->orWhere('shoe_type_id', $product->shoe_type_id)
            ->where('id', '!=', $product->id) // Loại bỏ chính sản phẩm đang xem
            ->take(12) // Lấy tối đa 12 sản phẩm (3 slide, mỗi slide 4 sản phẩm)
            ->get();

        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $users = User::all();
        $promotions = Promotion::all();
        $template = 'frontend.product.component.detail'; // Chỉ đường dẫn view chi tiết

        // Lấy giỏ hàng từ session
        $carts = session()->get('cart', []);

        // Render layout với template chỉ định
        return view('frontend.layout', compact(
            'data',
            'brands',
            'shoetypes',
            'product',
            'template',
            'sameproducts',
            'users',
            'promotions',
            'carts'
        ));
    }
}
