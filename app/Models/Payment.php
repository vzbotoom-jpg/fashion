<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payable_type',
        'payable_id',
        'order_id',
        'amount',
        'payment_method',
        'payment_channel',
        'transaction_id',
        'payment_code',
        'status',
        'paid_at',
        'expired_at',
        'payment_proof',
        'notes',
        'midtrans_enabled',
        'snap_token',
        'midtrans_response',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'midtrans_enabled' => 'boolean',
    ];

    // ============================================================
    // RELATIONSHIPS
    // ============================================================
    
    public function payable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // ============================================================
    // ACCESSORS
    // ============================================================
    
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'pending' => 'Menunggu',
            'completed' => 'Selesai',
            'failed' => 'Gagal',
            'cancelled' => 'Dibatalkan',
            'refunded' => 'Dikembalikan',
            'expired' => 'Kadaluarsa',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute(): string
    {
        $colors = [
            'pending' => 'warning',
            'completed' => 'success',
            'failed' => 'danger',
            'cancelled' => 'secondary',
            'refunded' => 'info',
            'expired' => 'danger',
        ];
        return $colors[$this->status] ?? 'secondary';
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    // ============================================================
    // CHECK METHODS
    // ============================================================
    
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function isRefunded(): bool
    {
        return $this->status === 'refunded';
    }

    public function isExpired(): bool
    {
        return $this->status === 'expired';
    }

    public function isMidtransEnabled(): bool
    {
        return (bool) $this->midtrans_enabled;
    }

    // ============================================================
    // STATUS UPDATE METHODS
    // ============================================================
    
    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        if ($this->order) {
            $this->order->markAsPaid();
        }
    }

    public function markAsFailed($reason = null)
    {
        $this->update([
            'status' => 'failed',
            'notes' => $reason,
        ]);
    }

    public function markAsRefunded()
    {
        $this->update(['status' => 'refunded']);
    }

    public function markAsExpired()
    {
        $this->update(['status' => 'expired']);
    }

    public function markAsCancelled()
    {
        $this->update(['status' => 'cancelled']);
    }

    // ============================================================
    // HELPER METHODS
    // ============================================================
    
    public function getPaymentInstructions()
    {
        if ($this->payment_method === 'bank_transfer') {
            return [
                'bank' => app(\App\Services\SettingService::class)->get('bank_transfer_account', 'BCA'),
                'account_number' => app(\App\Services\SettingService::class)->get('bank_transfer_number', '1234567890'),
                'account_name' => app(\App\Services\SettingService::class)->get('bank_transfer_name', 'PT Fashion Indonesia'),
                'amount' => $this->formatted_amount,
                'code' => $this->payment_code,
            ];
        }

        if ($this->payment_method === 'e_wallet') {
            return [
                'provider' => 'OVO / GoPay / DANA',
                'code' => $this->payment_code,
                'amount' => $this->formatted_amount,
            ];
        }

        if ($this->payment_method === 'qris') {
            return [
                'code' => $this->payment_code,
                'amount' => $this->formatted_amount,
            ];
        }

        return [
            'code' => $this->payment_code,
            'amount' => $this->formatted_amount,
        ];
    }

    public function getMidtransSnapUrl()
    {
        if ($this->snap_token) {
            return 'https://app.midtrans.com/snap/v2/vtweb/' . $this->snap_token;
        }
        return null;
    }
}