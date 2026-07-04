<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentService
{
    public function processPayment(Order $order, string $method)
    {
        return DB::transaction(function () use ($order, $method) {
            $paymentCode = $this->generatePaymentCode($method);
            
            $payment = Payment::create([
                'payable_type' => Order::class,
                'payable_id' => $order->id,
                'order_id' => $order->id,
                'amount' => $order->grand_total,
                'payment_method' => $method,
                'payment_code' => $paymentCode,
                'status' => 'pending',
                'expired_at' => now()->addHours(24),
            ]);

            return $payment;
        });
    }

    public function verifyPayment(Payment $payment)
    {
        $payment->markAsCompleted();
        return $payment;
    }

    public function refundPayment(Payment $payment)
    {
        // In real scenario, this would call payment gateway API
        $payment->markAsRefunded();
        return $payment;
    }

    public function generatePaymentCode($method)
    {
        $prefix = match($method) {
            'bank_transfer' => 'BT',
            'credit_card' => 'CC',
            'e_wallet' => 'EW',
            default => 'PM',
        };

        return $prefix . '-' . date('Ymd') . '-' . strtoupper(Str::random(6));
    }

    public function getPaymentStatus($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        return $payment->status;
    }

    public function getPaymentDetails($paymentId)
    {
        return Payment::with(['payable', 'order'])
            ->findOrFail($paymentId);
    }
}