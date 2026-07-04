<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'size_id',
        'order_number',
        'quantity',
        'custom_description',
        'custom_image',
        'shipping_address',
        'phone',
        'notes',
        'status',
        'price_quote',
        'admin_notes',
        'estimated_completion_date',
        'completed_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price_quote' => 'decimal:2',
        'estimated_completion_date' => 'date',
        'completed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customOrder) {
            if (empty($customOrder->order_number)) {
                $customOrder->order_number = 'CO-' . date('Ymd') . '-' . strtoupper(Str::random(6));
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

    public function scopeInProduction($query)
    {
        return $query->where('status', 'production');
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
            'review' => 'Review',
            'design' => 'Desain',
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
            'review' => 'info',
            'design' => 'primary',
            'production' => 'secondary',
            'shipped' => 'dark',
            'completed' => 'success',
            'cancelled' => 'danger',
        ];
        return $colors[$this->status] ?? 'secondary';
    }

    public function getCustomImageUrlAttribute()
    {
        return $this->custom_image ? asset('storage/' . $this->custom_image) : null;
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

    public function hasPriceQuote(): bool
    {
        return !is_null($this->price_quote) && $this->price_quote > 0;
    }

    public function getFormattedPriceQuoteAttribute(): string
    {
        return $this->price_quote ? 'Rp ' . number_format($this->price_quote, 0, ',', '.') : '-';
    }
}