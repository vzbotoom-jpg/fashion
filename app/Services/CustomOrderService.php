<?php

namespace App\Services;

use App\Models\CustomOrder;
use Illuminate\Support\Facades\Storage;

class CustomOrderService
{
    public function createCustomOrder($userId, $data)
    {
        $customImagePath = null;
        
        if (isset($data['custom_image']) && $data['custom_image']) {
            $customImagePath = $data['custom_image']->store('custom-orders', 'public');
        }

        $customOrder = CustomOrder::create([
            'user_id' => $userId,
            'product_id' => $data['product_id'] ?? null,
            'size_id' => $data['size_id'],
            'quantity' => $data['quantity'],
            'custom_description' => $data['custom_description'],
            'custom_image' => $customImagePath,
            'shipping_address' => $data['shipping_address'],
            'phone' => $data['phone'],
            'notes' => $data['notes'] ?? null,
            'status' => 'pending',
            'estimated_completion_date' => now()->addDays(21),
        ]);

        return $customOrder->load(['product', 'size']);
    }

    public function updateStatus($id, $status, $notes = null, $priceQuote = null)
    {
        $customOrder = CustomOrder::findOrFail($id);
        
        $data = ['status' => $status];
        
        if ($notes) {
            $data['admin_notes'] = $notes;
        }
        
        if ($priceQuote) {
            $data['price_quote'] = $priceQuote;
        }

        $customOrder->update($data);

        if ($status === 'completed') {
            $customOrder->update(['completed_at' => now()]);
        }

        return $customOrder;
    }

    public function getCustomOrdersByUser($userId)
    {
        return CustomOrder::where('user_id', $userId)
            ->with(['product', 'size'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getCustomOrderDetails($id)
    {
        return CustomOrder::with(['user', 'product', 'size', 'payment'])
            ->findOrFail($id);
    }

    public function deleteCustomOrder($id)
    {
        $customOrder = CustomOrder::findOrFail($id);
        
        if ($customOrder->custom_image) {
            Storage::delete('public/' . $customOrder->custom_image);
        }

        $customOrder->delete();
        return true;
    }
}