<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_id',
        'old_stock',
        'new_stock',
        'quantity_change',
        'type',
        'reference_type',
        'reference_id',
        'changed_by',
        'notes',
    ];

    protected $casts = [
        'old_stock' => 'integer',
        'new_stock' => 'integer',
        'quantity_change' => 'integer',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function getTypeLabelAttribute(): string
    {
        $labels = [
            'add' => 'Penambahan',
            'subtract' => 'Pengurangan',
            'update' => 'Update',
            'adjust' => 'Adjustment',
            'sale' => 'Penjualan',
            'return' => 'Pengembalian',
        ];
        return $labels[$this->type] ?? $this->type;
    }

    public function getTypeBadgeAttribute(): string
    {
        $colors = [
            'add' => 'success',
            'subtract' => 'danger',
            'update' => 'info',
            'adjust' => 'warning',
            'sale' => 'primary',
            'return' => 'secondary',
        ];
        return $colors[$this->type] ?? 'secondary';
    }

    public function getQuantityChangeDisplayAttribute(): string
    {
        return $this->quantity_change > 0 ? '+' . $this->quantity_change : (string) $this->quantity_change;
    }
}