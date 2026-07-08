<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Process payment for an order
     */
    public function processPayment(Order $order, string $method)
    {
        return DB::transaction(function () use ($order, $method) {
            // ✅ Cek metode pembayaran dari pengaturan
            $allowedMethods = $this->getAvailablePaymentMethods();
            
            if (!in_array($method, $allowedMethods)) {
                throw new \Exception('Metode pembayaran tidak tersedia.');
            }

            $paymentCode = $this->generatePaymentCode($method);
            
            // ✅ Cek apakah Midtrans diaktifkan
            $midtransEnabled = (bool) $this->settingService->get('midtrans_enabled', false);
            
            $payment = Payment::create([
                'payable_type' => Order::class,
                'payable_id' => $order->id,
                'order_id' => $order->id,
                'amount' => $order->grand_total,
                'payment_method' => $method,
                'payment_code' => $paymentCode,
                'status' => 'pending',
                'expired_at' => now()->addHours(24),
                'midtrans_enabled' => $midtransEnabled,
            ]);

            // ✅ Jika Midtrans diaktifkan, proses pembayaran via Midtrans
            if ($midtransEnabled) {
                $this->processMidtransPayment($payment, $order);
            }

            return $payment;
        });
    }

    /**
     * Process payment via Midtrans
     */
    protected function processMidtransPayment(Payment $payment, Order $order)
    {
        try {
            // ✅ Cek apakah Midtrans package terinstall
            if (!class_exists('\Midtrans\Config')) {
                Log::warning('Midtrans package not installed');
                return;
            }

            // Configure Midtrans
            $serverKey = $this->settingService->get('midtrans_server_key', '');
            $clientKey = $this->settingService->get('midtrans_client_key', '');
            
            if (empty($serverKey) || empty($clientKey)) {
                Log::warning('Midtrans keys not configured');
                return;
            }

            \Midtrans\Config::$serverKey = $serverKey;
            \Midtrans\Config::$clientKey = $clientKey;
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $payment->payment_code,
                    'gross_amount' => (int) $payment->amount,
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->phone ?? '081234567890',
                ],
                'item_details' => $this->getItemDetails($order),
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $payment->update([
                'snap_token' => $snapToken,
                'midtrans_response' => json_encode($params),
            ]);

            Log::info('Midtrans payment processed', ['order_id' => $order->id, 'payment_id' => $payment->id]);

        } catch (\Exception $e) {
            Log::error('Midtrans Payment Error: ' . $e->getMessage(), [
                'order_id' => $order->id,
                'payment_id' => $payment->id,
            ]);
            // Continue with payment even if midtrans fails
        }
    }

    /**
     * Get item details for Midtrans
     */
    protected function getItemDetails(Order $order): array
    {
        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                'id' => $item->product_id,
                'price' => (int) $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        }

        // Add shipping cost as item if > 0
        if ($order->shipping_cost > 0) {
            $items[] = [
                'id' => 'SHIPPING',
                'price' => (int) $order->shipping_cost,
                'quantity' => 1,
                'name' => 'Ongkos Kirim',
            ];
        }

        // Add tax as item if > 0
        if ($order->tax > 0) {
            $items[] = [
                'id' => 'TAX',
                'price' => (int) $order->tax,
                'quantity' => 1,
                'name' => 'Pajak',
            ];
        }

        return $items;
    }

    /**
     * Verify payment
     */
    public function verifyPayment(Payment $payment)
    {
        // ✅ Cek apakah payment sudah expired
        if ($this->isPaymentExpired($payment)) {
            $payment->markAsExpired();
            throw new \Exception('Pembayaran sudah kadaluarsa.');
        }

        $payment->markAsCompleted();
        return $payment;
    }

    /**
     * Refund payment
     */
    public function refundPayment(Payment $payment)
    {
        // ✅ Cek apakah payment bisa di-refund
        if ($payment->status !== 'completed') {
            throw new \Exception('Pembayaran tidak dapat di-refund.');
        }

        $payment->markAsRefunded();
        return $payment;
    }

    /**
     * Generate payment code
     */
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

    /**
     * Get payment status
     */
    public function getPaymentStatus($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        return $payment->status;
    }

    /**
     * Get payment details
     */
    public function getPaymentDetails($paymentId)
    {
        return Payment::with(['payable', 'order'])
            ->findOrFail($paymentId);
    }

    /**
     * Check if payment is expired
     */
    public function isPaymentExpired(Payment $payment): bool
    {
        if (!$payment->expired_at) {
            return false;
        }
        return now()->gt($payment->expired_at);
    }

    /**
     * Get available payment methods from settings
     */
    public function getAvailablePaymentMethods(): array
    {
        $methods = $this->settingService->get('payment_methods', 'bank_transfer,credit_card,e_wallet');
        
        // Filter dan trim
        $methods = array_map('trim', explode(',', $methods));
        return array_filter($methods);
    }

    /**
     * Get payment method label
     */
    public function getPaymentMethodLabel($method): string
    {
        $labels = [
            'bank_transfer' => 'Transfer Bank',
            'credit_card' => 'Kartu Kredit',
            'e_wallet' => 'E-Wallet',
        ];
        return $labels[$method] ?? ucfirst(str_replace('_', ' ', $method));
    }

    /**
     * Get payment method icon (SVG)
     */
    public function getPaymentMethodIcon($method): string
    {
        $icons = [
            'bank_transfer' => '<svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
            'credit_card' => '<svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16"/></svg>',
            'e_wallet' => '<svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>',
        ];
        return $icons[$method] ?? '💰';
    }

    /**
     * Update payment status via callback
     */
    public function handleCallback(array $data)
    {
        $payment = Payment::where('payment_code', $data['order_id'])->first();
        
        if (!$payment) {
            Log::warning('Payment not found for callback', ['order_id' => $data['order_id']]);
            return false;
        }

        $transactionStatus = $data['transaction_status'] ?? 'pending';
        $fraudStatus = $data['fraud_status'] ?? 'accept';

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            if ($fraudStatus == 'accept') {
                $payment->markAsCompleted();
                $payment->order->markAsPaid();
                Log::info('Payment completed via callback', ['payment_id' => $payment->id]);
            }
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $payment->markAsFailed();
            Log::info('Payment failed via callback', ['payment_id' => $payment->id]);
        }

        return true;
    }
}