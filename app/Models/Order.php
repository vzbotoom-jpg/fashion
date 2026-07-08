<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Services\SettingService;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total',
        'shipping_address',
        'city',
        'province',
        'postal_code',
        'phone',
        'notes',
        'status',
        'payment_method',
        'payment_status',
        'shipping_cost',
        'tax',
        'discount',
        'grand_total',
        'paid_at',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                // ✅ Ambil prefix order dari pengaturan
                $prefix = app(SettingService::class)->get('order_prefix', 'ORD');
                $order->order_number = $prefix . '-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }
        });
    }

    // ============================================================
    // RELATIONSHIPS
    // ============================================================
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }

    // ============================================================
    // SCOPES
    // ============================================================
    
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

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    // ============================================================
    // ACCESSORS
    // ============================================================
    
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Diterima',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getPaymentStatusLabelAttribute(): string
    {
        $labels = [
            'pending' => 'Menunggu',
            'paid' => 'Dibayar',
            'failed' => 'Gagal',
            'cancelled' => 'Dibatalkan',
            'refunded' => 'Dikembalikan',
        ];
        return $labels[$this->payment_status] ?? $this->payment_status;
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');
    }

    // ============================================================
    // HELPER METHODS
    // ============================================================
    
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'processing']) && !$this->isPaid();
    }

    public function markAsPaid()
    {
        $this->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);
    }

    public function markAsShipped()
    {
        $this->update([
            'status' => 'shipped',
            'shipped_at' => now(),
        ]);
    }

    public function markAsDelivered()
    {
        $this->update([
            'status' => 'delivered',
            'delivered_at' => now(),
        ]);
    }

    public function markAsCompleted()
    {
        $this->update(['status' => 'completed']);
    }

    public function addStatus($status, $description = null)
    {
        // Set all existing statuses to not current
        $this->statuses()->update(['is_current' => false]);

        // Create new status
        return $this->statuses()->create([
            'status' => $status,
            'description' => $description,
            'is_current' => true,
            'changed_by' => auth()->id(),
        ]);
    }

    public function getCurrentStatus()
    {
        return $this->statuses()->current()->first();
    }
}