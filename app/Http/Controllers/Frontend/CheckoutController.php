<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CartService;
use App\Services\CheckoutService;
use App\Services\PaymentService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    protected $cartService;
    protected $checkoutService;
    protected $paymentService;
    protected $notificationService;

    public function __construct(
        CartService $cartService,
        CheckoutService $checkoutService,
        PaymentService $paymentService,
        NotificationService $notificationService
    ) {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
        $this->paymentService = $paymentService;
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart(Auth::id());
        
        if ($cart->items->isEmpty()) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Keranjang Anda kosong!');
        }

        $cartTotal = $this->cartService->calculateTotal(Auth::id());
        $user = Auth::user();

        return view('customer.cart.checkout', compact('cart', 'cartTotal', 'user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string|in:bank_transfer,credit_card,e_wallet',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cart = $this->cartService->getCart(Auth::id());
        
        if ($cart->items->isEmpty()) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Keranjang Anda kosong!');
        }

        // Create order
        $order = $this->checkoutService->createOrder(
            Auth::id(),
            $request->all(),
            $cart
        );

        // Process payment
        $payment = $this->paymentService->processPayment(
            $order,
            $request->payment_method
        );

        // Clear cart after successful order
        $this->cartService->clearCart(Auth::id());

        // Send notifications
        $this->notificationService->sendOrderNotification($order);
        $this->notificationService->sendPaymentNotification($payment);

        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat! Silahkan selesaikan pembayaran Anda.');
    }
}