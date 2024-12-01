<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Reponsitories\CartReponsitory;

class CartController extends Controller
{
    protected $cartService;
    protected $cartRepository;

    public function __construct(CartService $cartService, CartReponsitory $cartRepository)
    {
        $this->cartService = $cartService;
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        $template = 'frontend.cart.index';
        $carts = $this->cartService->getCart();
        return view('frontend.layout', compact('carts', 'template'));
    }

    public function addToCart($id)
    {
        $success = $this->cartService->addToCart($id);

        if ($success) {
            return redirect()->route('gio-hang')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
        }

        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
    }

    public function update(Request $request)
    {
        $this->cartService->updateCart($request->id, $request->quantity);
        return redirect()->route('gio-hang')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function destroy($id)
    {
        $this->cartService->removeFromCart($id);
        return redirect()->route('gio-hang')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}
