<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    public function addProduct($product, $quantity = 1)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
            ];
        }

        Session::put('cart', $cart);
    }

    public function removeProduct($productId)
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }

    public function getCart()
    {
        return Session::get('cart', []);
    }

    public function clearCart()
    {
        Session::forget('cart');
    }

    public function getTotal()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
