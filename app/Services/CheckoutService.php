<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\ProductSize;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public function createOrder($userId, $data, $cart)
    {
        return DB::transaction(function () use ($userId, $data, $cart) {
            $subtotal = $cart->total;
            $shippingCost = $this->calculateShipping($data['shipping_address'], $subtotal);
            $tax = $subtotal * 0.11; // 11% tax
            $grandTotal = $subtotal + $shippingCost + $tax;

            $order = Order::create([
                'user_id' => $userId,
                'total' => $subtotal,
                'shipping_address' => $data['shipping_address'],
                'city' => $data['city'],
                'province' => $data['province'],
                'postal_code' => $data['postal_code'],
                'phone' => $data['phone'],
                'notes' => $data['notes'] ?? null,
                'status' => 'pending',
                'payment_method' => $data['payment_method'],
                'payment_status' => 'pending',
                'shipping_cost' => $shippingCost,
                'tax' => $tax,
                'grand_total' => $grandTotal,
            ]);

            // Create order items
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'size_id' => $cartItem->size_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'total' => $cartItem->price * $cartItem->quantity,
                ]);

                // Reduce stock
                $productSize = ProductSize::where('product_id', $cartItem->product_id)
                    ->where('size_id', $cartItem->size_id)
                    ->first();

                if ($productSize) {
                    $productSize->decrement('stock', $cartItem->quantity);
                }
            }

            // Create initial status
            OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'pending',
                'description' => 'Pesanan dibuat',
                'is_current' => true,
            ]);

            return $order->load(['items.product', 'items.size']);
        });
    }

    public function updateOrderStatus($orderId, $status, $description = null)
    {
        $order = Order::findOrFail($orderId);

        // Mark old status as not current
        OrderStatus::where('order_id', $orderId)
            ->where('is_current', true)
            ->update(['is_current' => false]);

        // Create new status
        OrderStatus::create([
            'order_id' => $orderId,
            'status' => $status,
            'description' => $description ?? "Status diubah ke " . $status,
            'is_current' => true,
            'changed_by' => auth()->id(),
        ]);

        // Update order status
        $order->update(['status' => $status]);

        return $order;
    }

    protected function calculateShipping($address, $subtotal)
    {
        // Basic shipping calculation
        // Could be extended with more complex logic (courier API, etc.)
        $shippingMethods = [
            'standard' => 20000,
            'express' => 50000,
            'same_day' => 100000,
        ];

        // Free shipping for orders over 500,000
        if ($subtotal >= 500000) {
            return 0;
        }

        return $shippingMethods['standard'] ?? 20000;
    }
}