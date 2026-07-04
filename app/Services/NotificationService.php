<?php

namespace App\Services;

use App\Models\PreOrder;
use App\Models\CustomOrder;
use App\Models\Order;
use App\Models\ContactMessage;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function sendPreOrderNotification(PreOrder $preOrder)
    {
        try {
            // Send email to customer
            Mail::send('emails.pre-order-confirmation', [
                'preOrder' => $preOrder,
                'customer' => $preOrder->user,
            ], function ($message) use ($preOrder) {
                $message->to($preOrder->user->email)
                    ->subject('Konfirmasi Pre-Order #' . $preOrder->order_number);
            });

            // Send WhatsApp notification to admin
            $this->whatsappService->sendPreOrderNotification($preOrder);

            Log::info('Pre-order notification sent', [
                'order_number' => $preOrder->order_number,
                'user_id' => $preOrder->user_id,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send pre-order notification: ' . $e->getMessage());
            return false;
        }
    }

    public function sendCustomOrderNotification(CustomOrder $customOrder)
    {
        try {
            Mail::send('emails.custom-order-confirmation', [
                'customOrder' => $customOrder,
                'customer' => $customOrder->user,
            ], function ($message) use ($customOrder) {
                $message->to($customOrder->user->email)
                    ->subject('Konfirmasi Custom Order #' . $customOrder->order_number);
            });

            $this->whatsappService->sendCustomOrderNotification($customOrder);

            Log::info('Custom order notification sent', [
                'order_number' => $customOrder->order_number,
                'user_id' => $customOrder->user_id,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send custom order notification: ' . $e->getMessage());
            return false;
        }
    }

    public function sendOrderNotification(Order $order)
    {
        try {
            Mail::send('emails.order-confirmation', [
                'order' => $order,
                'customer' => $order->user,
            ], function ($message) use ($order) {
                $message->to($order->user->email)
                    ->subject('Konfirmasi Pesanan #' . $order->order_number);
            });

            $this->whatsappService->sendOrderNotification($order);

            Log::info('Order notification sent', [
                'order_number' => $order->order_number,
                'user_id' => $order->user_id,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send order notification: ' . $e->getMessage());
            return false;
        }
    }

    public function sendPaymentNotification(Payment $payment)
    {
        try {
            Mail::send('emails.payment-confirmation', [
                'payment' => $payment,
                'order' => $payment->order,
            ], function ($message) use ($payment) {
                $message->to($payment->order->user->email)
                    ->subject('Konfirmasi Pembayaran');
            });

            Log::info('Payment notification sent', [
                'payment_id' => $payment->id,
                'order_id' => $payment->order_id,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send payment notification: ' . $e->getMessage());
            return false;
        }
    }

    public function sendContactMessageNotification(ContactMessage $message)
    {
        try {
            // Send to admin email
            Mail::send('emails.contact-message', [
                'message' => $message,
            ], function ($m) use ($message) {
                $m->to(config('mail.admin_email'))
                    ->subject('Pesan Kontak Baru: ' . $message->subject);
            });

            Log::info('Contact message notification sent', [
                'message_id' => $message->id,
                'email' => $message->email,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send contact message notification: ' . $e->getMessage());
            return false;
        }
    }

    public function sendPreOrderStatusUpdate(PreOrder $preOrder)
    {
        try {
            Mail::send('emails.pre-order-status-update', [
                'preOrder' => $preOrder,
                'customer' => $preOrder->user,
            ], function ($message) use ($preOrder) {
                $message->to($preOrder->user->email)
                    ->subject('Update Status Pre-Order #' . $preOrder->order_number);
            });

            Log::info('Pre-order status update sent', [
                'order_number' => $preOrder->order_number,
                'status' => $preOrder->status,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send pre-order status update: ' . $e->getMessage());
            return false;
        }
    }

    public function sendCustomOrderStatusUpdate(CustomOrder $customOrder)
    {
        try {
            Mail::send('emails.custom-order-status-update', [
                'customOrder' => $customOrder,
                'customer' => $customOrder->user,
            ], function ($message) use ($customOrder) {
                $message->to($customOrder->user->email)
                    ->subject('Update Status Custom Order #' . $customOrder->order_number);
            });

            Log::info('Custom order status update sent', [
                'order_number' => $customOrder->order_number,
                'status' => $customOrder->status,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send custom order status update: ' . $e->getMessage());
            return false;
        }
    }
}