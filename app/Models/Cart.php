<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'total',
        'items_count',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'items_count' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Helper methods
    public function calculateTotal(): float
    {
        $total = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $this->update(['total' => $total]);
        return $total;
    }

    public function getItemsCountAttribute(): int
    {
        return $this->items->sum('quantity');
    }

    public function hasItems(): bool
    {
        return $this->items()->count() > 0;
    }

    public function isEmpty(): bool
    {
        return !$this->hasItems();
    }

    public function clear()
    {
        $this->items()->delete();
        $this->update([
            'total' => 0,
            'items_count' => 0,
        ]);
    }
}