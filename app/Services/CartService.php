<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Promotion;

class CartService
{
    public function getCart()
    {
        $cart = session()->get('cart', []);
        return $cart;
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return false; // Sản phẩm không tồn tại
        }

        $cart = $this->getCart();

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'image_1' => $product->image_1,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];

            // Kiểm tra xem sản phẩm có khuyến mãi hay không
            if ($product->promotion_id) {
                // Truy vấn thông tin khuyến mãi từ bảng promotions
                $promotion = Promotion::find($product->promotion_id);

                if ($promotion) {
                    // Tính giá sau khi áp dụng khuyến mãi
                    $discountedPrice = $product->price * (1 - $promotion->promotion_value / 100);

                    // Lưu thông tin khuyến mãi vào giỏ hàng
                    $cart[$productId]['promotion'] = $promotion->promotion_value;
                    $cart[$productId]['discounted_price'] = $discountedPrice;
                } else {
                    // Nếu promotion_id tồn tại nhưng không tìm thấy trong bảng promotions
                    $cart[$productId]['promotion'] = 0;
                    $cart[$productId]['discounted_price'] = $product->price; // Giá gốc
                }
            } else {
                // Nếu không có khuyến mãi
                $cart[$productId]['promotion'] = 0;
                $cart[$productId]['discounted_price'] = $product->price; // Giá gốc
            }
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);
        return true;
    }


    public function updateCart($productId, $quantity)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
    }
}
