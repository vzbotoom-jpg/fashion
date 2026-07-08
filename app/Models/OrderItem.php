<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'quantity',
        'price',
        'total',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // ============================================================
    // RELATIONSHIPS
    // ============================================================
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    // ============================================================
    // ACCESSORS
    // ============================================================
    
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    public function getSubtotalAttribute(): float
    {
        return $this->price * $this->quantity;
    }

    // ============================================================
    // SCOPES
    // ============================================================
    
    public function scopeByProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    public function scopeByOrder($query, $orderId)
    {
        return $query->where('order_id', $orderId);
    }

    // ============================================================
    // HELPER METHODS
    // ============================================================
    
    public function updateTotal()
    {
        $this->total = $this->price * $this->quantity;
        $this->save();
        return $this;
    }

    public static function getTotalQuantitySold($productId)
    {
        return static::whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->where('product_id', $productId)
            ->sum('quantity');
    }

    public static function getTotalRevenue($productId)
    {
        return static::whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->where('product_id', $productId)
            ->sum('total');
    }
}