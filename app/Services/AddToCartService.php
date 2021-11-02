<?php

namespace App\Services;

use App\Product;
use App\Cart;
use App\CartItem;

class AddToCartService
{
    public function addToCart($productId, $quantity = 1, $size)
    {
        $product = Product::find($productId);
        // $subtotal += $product->price * $quantity;
        // $total += $product->price * $quantity;
        $cart = Cart::create([
            'subtotal' => $product->price,
            'total' => $product->price,
        ]);

        $cartItems = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'image'=> $product->image,
            'size' => $size,
        ]);

        
        // $cart = session(['cart'=> ['subtotal' => $product->price,
        //                             'total' => $product->price]]);
        
        // $cartItems = session(['cartItems'=> ['cart_id' => $cart->id,
        //                                     'product_id' => $product->id,
        //                                     'name' => $product->name,
        //                                     'price' => $product->price,
        //                                     'quantity' => $quantity]]);
        return $cart;
    }

    public function updateCart($productId, $quantity = 1, $cart, $size)
    {
        $cartItems = $cart->cartItems()->get();
        foreach ($cartItems as $item) {
            if ($item->product_id == $productId) {
                // Update quantity
                $item->update([
                    'quantity' => $item->quantity + $quantity,
                ]);
                $cart->update([
                    'subtotal' => $cart->subtotal + ($item->price * $quantity),
                    'total' => $item->total + ($item->price * $quantity),
                ]);
                break;
            } else {
                $product = Product::find($productId);
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'image'=> $product->image,
                    'size' => $size
                ]);
                break;
            }
        }
    }

    // $cartItems = $cart->cartItems()->get();
        // foreach ($cartItems as $item) {
        //     if ($item->product_id == $productId) {
        //         // Update quantity
        //         $item->quantity = ($item->quantity + $quantity);
        //         $cart->subtotal = $cart->subtotal + ($item->price * $quantity);
        //         $cart->total = $item->total + ($item->price * $quantity);
        //         break;
        //     } else {
        //         $product = Product::find($productId);
        //         session(['cartItems'=> ['cart_id' => $cart->id,
        //                                 'product_id' => $product->id,
        //                                 'name' => $product->name,
        //                                 'price' => $product->price,
        //                                 'quantity' => $quantity]]);
        //         break;
        //     }
        // }
}