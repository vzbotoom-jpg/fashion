<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    public function index(Request $request)
    {
        $query = Payment::with(['order.user']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('method') && $request->method) {
            $query->where('payment_method', $request->method);
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(15);
        $statuses = ['pending', 'completed', 'failed', 'cancelled', 'refunded'];
        $methods = ['bank_transfer', 'credit_card', 'e_wallet'];

        return view('admin.payments.index', compact('payments', 'statuses', 'methods'));
    }

    public function show($id)
    {
        $payment = Payment::with(['order.user', 'order.items'])->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function verify($id)
    {
        $payment = Payment::findOrFail($id);
        
        if ($payment->status === 'pending') {
            $this->paymentService->verifyPayment($payment);
            
            $order = $payment->order;
            $order->update(['status' => 'processing']);
            
            return redirect()->route('admin.payments.show', $payment->id)
                ->with('success', 'Pembayaran berhasil diverifikasi!');
        }

        return redirect()->route('admin.payments.show', $payment->id)
            ->with('error', 'Pembayaran sudah diverifikasi sebelumnya.');
    }

    public function refund($id)
    {
        $payment = Payment::findOrFail($id);
        
        if ($payment->status === 'completed') {
            $this->paymentService->refundPayment($payment);
            
            $order = $payment->order;
            $order->update(['status' => 'cancelled']);
            
            return redirect()->route('admin.payments.show', $payment->id)
                ->with('success', 'Pembayaran berhasil di-refund!');
        }

        return redirect()->route('admin.payments.show', $payment->id)
            ->with('error', 'Hanya pembayaran yang sudah selesai yang dapat di-refund.');
    }
}