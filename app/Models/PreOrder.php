<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'size_id',
        'order_number',
        'quantity',
        'shipping_address',
        'phone',
        'notes',
        'status',
        'admin_notes',
        'estimated_completion_date',
        'completed_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'estimated_completion_date' => 'date',
        'completed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($preOrder) {
            if (empty($preOrder->order_number)) {
                $preOrder->order_number = 'PO-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, 'payable');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Helper methods
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'production' => 'Produksi',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute(): string
    {
        $colors = [
            'pending' => 'warning',
            'processing' => 'info',
            'production' => 'primary',
            'shipped' => 'secondary',
            'completed' => 'success',
            'cancelled' => 'danger',
        ];
        return $colors[$this->status] ?? 'secondary';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }
}