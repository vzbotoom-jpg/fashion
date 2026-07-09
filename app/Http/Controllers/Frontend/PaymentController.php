<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
        $this->middleware(['auth', 'role:customer']);
    }

    /**
     * Display Midtrans payment page
     */
    public function midtrans($paymentId)
    {
        $payment = Payment::with(['order', 'order.user', 'order.items', 'order.items.product'])
            ->where('id', $paymentId)
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        if (!$payment->midtrans_enabled || !$payment->snap_token) {
            return redirect()->route('customer.orders.show', $payment->order_id)
                ->with('error', 'Pembayaran tidak tersedia.');
        }

        if ($payment->isCompleted()) {
            return redirect()->route('customer.orders.show', $payment->order_id)
                ->with('info', 'Pembayaran ini sudah selesai.');
        }

        if ($payment->isExpired()) {
            return redirect()->route('customer.orders.show', $payment->order_id)
                ->with('error', 'Pembayaran sudah kadaluarsa.');
        }

        return view('frontend.payment.midtrans', compact('payment'));
    }

    /**
     * Handle Midtrans callback
     */
    public function callback(Request $request)
    {
        Log::info('Midtrans Callback Received', $request->all());

        $result = $this->paymentService->handleCallback($request->all());

        if ($result) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'failed'], 400);
    }

    /**
     * Handle payment success from Midtrans (redirect)
     */
    public function success(Request $request)
    {
        $orderId = $request->get('order_id');
        
        if (!$orderId) {
            return redirect()->route('customer.orders.index')
                ->with('error', 'Invalid payment data.');
        }

        $payment = Payment::where('payment_code', $orderId)->first();

        if (!$payment) {
            return redirect()->route('customer.orders.index')
                ->with('error', 'Payment not found.');
        }

        return redirect()->route('customer.orders.show', $payment->order_id)
            ->with('success', 'Pembayaran berhasil! Terima kasih telah berbelanja.');
    }

    /**
     * Handle payment pending from Midtrans (redirect)
     */
    public function pending(Request $request)
    {
        $orderId = $request->get('order_id');
        
        if (!$orderId) {
            return redirect()->route('customer.orders.index')
                ->with('error', 'Invalid payment data.');
        }

        $payment = Payment::where('payment_code', $orderId)->first();

        if (!$payment) {
            return redirect()->route('customer.orders.index')
                ->with('error', 'Payment not found.');
        }

        return redirect()->route('customer.orders.show', $payment->order_id)
            ->with('info', 'Pembayaran sedang diproses. Silakan tunggu konfirmasi.');
    }

    /**
     * Handle payment error from Midtrans (redirect)
     */
    public function error(Request $request)
    {
        $orderId = $request->get('order_id');
        
        if (!$orderId) {
            return redirect()->route('customer.orders.index')
                ->with('error', 'Invalid payment data.');
        }

        $payment = Payment::where('payment_code', $orderId)->first();

        if (!$payment) {
            return redirect()->route('customer.orders.index')
                ->with('error', 'Payment not found.');
        }

        return redirect()->route('customer.orders.show', $payment->order_id)
            ->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    }
}