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

class MainController extends Controller
{
    public function __construct() {}
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
        $template = 'frontend.index';
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
}
