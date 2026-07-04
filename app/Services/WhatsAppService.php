<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $apiKey;
    protected $senderNumber;
    protected $enabled;

    public function __construct()
    {
        $this->apiKey = config('whatsapp.api_key');
        $this->senderNumber = config('whatsapp.sender_number');
        $this->enabled = config('whatsapp.enabled', false);
    }

    public function sendPreOrderNotification($preOrder)
    {
        if (!$this->enabled) {
            return false;
        }

        $message = "🆕 *PRE-ORDER BARU*\n\n";
        $message .= "No. Pesanan: {$preOrder->order_number}\n";
        $message .= "Pelanggan: {$preOrder->user->name}\n";
        $message .= "Produk: {$preOrder->product->name}\n";
        $message .= "Ukuran: {$preOrder->size->name}\n";
        $message .= "Jumlah: {$preOrder->quantity}\n";
        $message .= "Status: Menunggu\n\n";
        $message .= "Segera proses pesanan ini!";

        return $this->send($message);
    }

    public function sendCustomOrderNotification($customOrder)
    {
        if (!$this->enabled) {
            return false;
        }

        $message = "🎨 *CUSTOM ORDER BARU*\n\n";
        $message .= "No. Pesanan: {$customOrder->order_number}\n";
        $message .= "Pelanggan: {$customOrder->user->name}\n";
        $message .= "Deskripsi: {$customOrder->custom_description}\n";
        $message .= "Ukuran: {$customOrder->size->name}\n";
        $message .= "Jumlah: {$customOrder->quantity}\n";
        $message .= "Status: Menunggu Review\n\n";
        $message .= "Segera review custom order ini!";

        if ($customOrder->custom_image) {
            $message .= "\n📷 Ada gambar custom: " . asset('storage/' . $customOrder->custom_image);
        }

        return $this->send($message);
    }

    public function sendOrderNotification($order)
    {
        if (!$this->enabled) {
            return false;
        }

        $message = "🛍️ *PESANAN BARU*\n\n";
        $message .= "No. Pesanan: {$order->order_number}\n";
        $message .= "Pelanggan: {$order->user->name}\n";
        $message .= "Total: Rp " . number_format($order->grand_total, 0, ',', '.') . "\n";
        $message .= "Metode Pembayaran: {$order->payment_method}\n";
        $message .= "Status: Menunggu Pembayaran\n\n";
        $message .= "Segera konfirmasi pembayaran!";

        return $this->send($message);
    }

    public function sendPaymentNotification($payment)
    {
        if (!$this->enabled) {
            return false;
        }

        $message = "💳 *PEMBAYARAN DITERIMA*\n\n";
        $message .= "No. Pesanan: {$payment->order->order_number}\n";
        $message .= "Jumlah: Rp " . number_format($payment->amount, 0, ',', '.') . "\n";
        $message .= "Metode: {$payment->payment_method}\n";
        $message .= "Status: Selesai\n\n";
        $message .= "Pesanan siap diproses!";

        return $this->send($message);
    }

    public function sendPreOrderStatusUpdate($preOrder)
    {
        if (!$this->enabled) {
            return false;
        }

        $statusLabels = [
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'production' => 'Produksi',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $message = "📦 *UPDATE STATUS PRE-ORDER*\n\n";
        $message .= "No. Pesanan: {$preOrder->order_number}\n";
        $message .= "Status: " . ($statusLabels[$preOrder->status] ?? $preOrder->status) . "\n\n";
        $message .= "Terima kasih telah mempercayai kami!";

        return $this->send($message);
    }

    public function sendCustomOrderStatusUpdate($customOrder)
    {
        if (!$this->enabled) {
            return false;
        }

        $statusLabels = [
            'pending' => 'Menunggu',
            'review' => 'Review',
            'design' => 'Desain',
            'production' => 'Produksi',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $message = "🎨 *UPDATE STATUS CUSTOM ORDER*\n\n";
        $message .= "No. Pesanan: {$customOrder->order_number}\n";
        $message .= "Status: " . ($statusLabels[$customOrder->status] ?? $customOrder->status) . "\n\n";
        $message .= "Terima kasih telah mempercayai kami!";

        return $this->send($message);
    }

    public function send($message)
    {
        try {
            if (!$this->enabled) {
                return false;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.whatsapp.com/v1/messages', [
                'sender' => $this->senderNumber,
                'message' => $message,
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp message sent successfully');
                return true;
            }

            Log::error('WhatsApp API error: ' . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('WhatsApp send error: ' . $e->getMessage());
            return false;
        }
    }
}