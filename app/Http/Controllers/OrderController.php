<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
    }
    public function index()
    {

    }
    public function showCheckout()
{
    $carts = session('cart', []); // Lấy giỏ hàng từ session
    $totalPrice = 0;

    foreach ($carts as $cart) {
        $totalPrice += $cart['quantity'] * ($cart['discounted_price'] ?? $cart['price']);
    }

    return view('checkout', compact('carts', 'totalPrice'));
}
public function placeOrder(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'payment_method' => 'required|string',
    ]);

    $carts = session('cart', []);
    $totalPrice = $request->input('total_price');

    $order = new \App\Models\Order();
    $order->name = $request->input('name');
    $order->phone = $request->input('phone');
    $order->address = $request->input('address');
    $order->description = $request->input('description');
    $order->total_price = $totalPrice;
    $order->payment_method = $request->input('payment_method');
    $order->invoice = json_encode($carts); // Lưu chi tiết giỏ hàng vào invoice
    $order->save();

    // Xóa giỏ hàng sau khi đặt hàng
    session()->forget('cart');

    return redirect()->route('checkout')->with('success', 'Đặt hàng thành công!');
}

}