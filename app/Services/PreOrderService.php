<?php

namespace App\Services;

use App\Models\PreOrder;
use App\Models\ProductSize;
use Illuminate\Support\Facades\DB;

class PreOrderService
{
    public function createPreOrder($userId, $data)
    {
        return DB::transaction(function () use ($userId, $data) {
            $preOrder = PreOrder::create([
                'user_id' => $userId,
                'product_id' => $data['product_id'],
                'size_id' => $data['size_id'],
                'quantity' => $data['quantity'],
                'shipping_address' => $data['shipping_address'],
                'phone' => $data['phone'],
                'notes' => $data['notes'] ?? null,
                'status' => 'pending',
                'estimated_completion_date' => now()->addDays(14),
            ]);

            return $preOrder->load(['product', 'size']);
        });
    }

    public function updateStatus($id, $status, $notes = null)
    {
        $preOrder = PreOrder::findOrFail($id);
        $preOrder->update([
            'status' => $status,
            'admin_notes' => $notes,
        ]);

        if ($status === 'completed') {
            $preOrder->update(['completed_at' => now()]);
        }

        return $preOrder;
    }

    public function getPreOrdersByUser($userId)
    {
        return PreOrder::where('user_id', $userId)
            ->with(['product', 'size'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPreOrderDetails($id)
    {
        return PreOrder::with(['user', 'product', 'size', 'payment'])
            ->findOrFail($id);
    }
}