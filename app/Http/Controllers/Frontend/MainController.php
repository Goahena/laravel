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
use App\Reponsitories\Interfaces\MainReponsitoryInterface as MainReponsitory;
use App\Services\Interfaces\MainServiceInterface as MainService;
use Laravel\Prompts\Prompt;

class MainController extends Controller
{
    protected $mainReponsitory;
    protected $mainService;
    public function __construct(
        MainReponsitory $mainReponsitory,
        MainService $mainService
    ) {
        $this->mainReponsitory = $mainReponsitory;
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

        $products = $this->mainService->paginate($request);
        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $template = 'frontend.product.index';
        $config['seo'] = config('apps.product');

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

    public function search(Request $request)
    {
        $data = User::where('id', session('LogIn'))->first();
        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $products = DB::table('product')->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('shoe_type_name', 'like', '%' . $request->search . '%')
            ->orWhere('brand_name', 'like', '%' . $request->search . '%')
            ->orWhere('price', 'like', '%' . $request->search . '%')
            ->paginate(12);

        $users = User::all();
        $promotions = Promotion::all();

        return view('index')->with('route', 'store')
            ->with('data', $data)
            ->with('brands', $brands)
            ->with('shoetypes', $shoetypes)
            ->with('products', $products)
            ->with('users', $users)
            ->with('promotions', $promotions)
            ->with('searchshoetype', '')->with('searchbrand', '')
        ;
    }

    public function product($slug)
{
    $data = User::where('id', session('LogIn'))->first();

    // Lấy thông tin sản phẩm theo slug
    $product = Product::with('promotions')->where('slug', $slug)->firstOrFail();

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



    //

    public function searchshoetype($request)
    {
        $data = User::where('id', session('LogIn'))->first();
        $products = $this->mainService->paginate($request);
        $template = 'frontend.product.index';
        $config['seo'] = config('apps.product');

        return view('frontend.layout', compact(
            'template',
            'products',
            'config',
        ));
    }


    public function searchbrand($brand)
    {
        $data = User::where('id', session('LogIn'))->first();
        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $users = User::all();
        $promotions = Promotion::all();
        $products = DB::table('product')
            ->leftJoin('brands', 'product.brand_id', '=', 'brands.id')
            ->select('product.*', 'brands.brand_name')
            ->orderBy('product.updated_at', 'desc')
            ->paginate(9);

        return view('frontend.store.index')->with('route', 'store')
            ->with('data', $data)
            ->with('brands', $brands)
            ->with('shoetypes', $shoetypes)
            ->with('products', $products)
            ->with('users', $users)
            ->with('promotions', $promotions)
            ->with('searchbrand', $brand)
            ->with('searchshoetype', '')
        ;
    }

    public function searchprice($price1, $price2)
    {
        $data = User::where('id', session('LogIn'))->first();
        $brands = Brand::all();
        $shoetypes = ShoeType::all();

        if ($price1 == '0') {
            $products = DB::table('product')->where('price', '<', $price2)->paginate(9);
        } else {
            $products = DB::table('product')->where('price', '>', $price1)->where('price', '<', $price2)->paginate(9);
        }

        $users = User::all();
        $promotions = Promotion::all();

        return view('index')->with('route', 'store')
            ->with('data', $data)
            ->with('brands', $brands)
            ->with('shoetypes', $shoetypes)
            ->with('products', $products)
            ->with('users', $users)
            ->with('promotions', $promotions)
            ->with('searchbrand', '')
            ->with('searchshoetype', '')
        ;
    }

    public function aboutUs()
    {
        return view('index')->with('route', 'aboutus');
    }
}

