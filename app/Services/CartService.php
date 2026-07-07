<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductSize;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getCart($userId)
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => $userId],
            ['total' => 0, 'items_count' => 0]
        );

        return $cart->load(['items.product', 'items.size']);
    }

    public function addToCart($userId, $productId, $sizeId, $quantity = 1)
    {
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        
        // Check stock
        $productSize = ProductSize::where('product_id', $productId)
            ->where('size_id', $sizeId)
            ->first();

        if (!$productSize || $productSize->stock < $quantity) {
            throw new \Exception('Stok tidak mencukupi');
        }

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->where('size_id', $sizeId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            if ($productSize->stock < $newQuantity) {
                throw new \Exception('Stok tidak mencukupi');
            }
            $cartItem->update([
                'quantity' => $newQuantity,
                'price' => $productSize->price ?? $productSize->product->price,
            ]);
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'size_id' => $sizeId,
                'quantity' => $quantity,
                'price' => $productSize->price ?? $productSize->product->price,
            ]);
        }

        $this->updateCartTotals($cart);

        return $cartItem->load(['product', 'size']);
    }

    public function removeFromCart($userId, $cartItemId)
    {
        $cart = Cart::where('user_id', $userId)->firstOrFail();
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('id', $cartItemId)
            ->firstOrFail();

        $cartItem->delete();
        $this->updateCartTotals($cart);

        return true;
    }

    public function updateCartQuantity($userId, $cartItemId, $quantity)
    {
        $cart = Cart::where('user_id', $userId)->firstOrFail();
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('id', $cartItemId)
            ->firstOrFail();

        if ($quantity <= 0) {
            return $this->removeFromCart($userId, $cartItemId);
        }

        // Check stock
        $productSize = ProductSize::where('product_id', $cartItem->product_id)
            ->where('size_id', $cartItem->size_id)
            ->first();

        if ($productSize && $productSize->stock < $quantity) {
            throw new \Exception('Stok tidak mencukupi');
        }

        $cartItem->update(['quantity' => $quantity]);
        $this->updateCartTotals($cart);

        return $cartItem->load(['product', 'size']);
    }

    public function clearCart($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();
        if ($cart) {
            $cart->items()->delete();
            $this->updateCartTotals($cart);
        }
        return true;
    }

    public function calculateTotal($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart) {
            return 0;
        }

        return $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function getCartCount($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart) {
            return 0;
        }

        return $cart->items->sum('quantity');
    }

    protected function updateCartTotals($cart)
    {
        $total = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $cart->update([
            'total' => $total,
            'items_count' => $cart->items->sum('quantity'),
        ]);

        return $cart;
    }
}
