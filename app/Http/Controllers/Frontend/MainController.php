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
        $template = 'frontend.product.index';
        $config['seo'] = config('apps.product'); // Tùy chỉnh SEO nếu cần
        return view('frontend.layout', compact(
            'template',
            'products',
            'config',
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
        $brands = Brand::all();
        $shoetypes = ShoeType::all();
        $products = Product::find($slug);

        if (DB::table('product')->where('brand_name', $products['brand_name'])->orWhere('shoe_type_name', $products['shoe_type_name'])->count() < 4) {
            $sameproducts = DB::table('product')
                ->where('brand_name', $products['brand_name'])
                ->orWhere('price', '>', $products['price'] - 100000)->where('price', '<', $products['price'] + 100000)
                ->orWhere('shoe_type_name', $products['shoe_type_name'])->get();
        } else if (DB::table('product')->where('brand_name', $products['brand_name'])->count() < 4) {
            $sameproducts = DB::table('product')->where('brand_name', $products['brand_name'])->orWhere('shoe_type_name', $products['shoe_type_name'])->get();
        } else {
            $sameproducts = DB::table('product')->where('brand_name', $products['brand_name'])->get();
        }

        $users = User::all();
        $promotions = Promotion::all();

        $carts = session()->get('cart');
        if (!$carts) {
            $carts = array();
        }


        return view('frontend.store.index')->with('route', 'san-pham')
            ->with('data', $data)
            ->with('brands', $brands)
            ->with('shoetypes', $shoetypes)
            ->with('product', $products)
            ->with('sameproducts', $sameproducts)
            ->with('users', $users)
            ->with('promotions', $promotions)
            ->with('gio_hangs', $carts)
        ;
    }

    //

    public function searchshoetype($shoetype)
{
    $data = User::where('id', session('LogIn'))->first();
    $brands = Brand::all();
    $users = User::all();
    $promotions = Promotion::all();
    $shoetypes = ShoeType::all();

    $products = DB::table('product')
    ->join('shoe_types', 'product.shoe_type_id', '=', 'shoe_types.id')
    ->when(!empty($shoetype), function ($query) use ($shoetype) {
        $query->where('shoe_types.shoe_type_name', $shoetype);
    })
    ->select('product.*', 'shoe_types.shoe_type_name as shoe_type_name')
    ->paginate(9);


    return view('frontend.store.index')->with('route', 'store')
        ->with('data', $data)
        ->with('brands', $brands)
        ->with('shoetypes', $shoetypes)
        ->with('products', $products)
        ->with('users', $users)
        ->with('promotions', $promotions)
        ->with('searchshoetype', $shoetype)
        ->with('searchbrand', '');
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
