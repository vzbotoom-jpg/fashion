<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CartService;
use App\Services\CheckoutService;
use App\Services\PaymentService;
use App\Services\NotificationService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CheckoutController extends Controller implements HasMiddleware
{
    protected $cartService;
    protected $checkoutService;
    protected $paymentService;
    protected $notificationService;
    protected $settingService;

    public function __construct(
        CartService $cartService,
        CheckoutService $checkoutService,
        PaymentService $paymentService,
        NotificationService $notificationService,
        SettingService $settingService
    ) {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
        $this->paymentService = $paymentService;
        $this->notificationService = $notificationService;
        $this->settingService = $settingService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('role:customer'),
        ];
    }

    /**
     * Display checkout page
     */
    public function index()
    {
        $cart = $this->cartService->getCart(Auth::id());
        
        if ($cart->items->isEmpty()) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Keranjang Anda kosong!');
        }

        // ✅ Ambil metode pembayaran dari pengaturan
        $paymentMethods = $this->paymentService->getAvailablePaymentMethods();
        
        // ✅ Ambil metode pengiriman dari pengaturan
        $shippingMethods = $this->getShippingMethods();
        
        // ✅ Ambil biaya pengiriman dari pengaturan
        $shippingCosts = $this->getShippingCosts($shippingMethods);

        // ✅ Cek gratis ongkir
        $cartTotal = $this->cartService->calculateTotal(Auth::id());
        $freeShippingThreshold = (float) $this->settingService->get('free_shipping_threshold', 0);
        $isFreeShipping = $freeShippingThreshold > 0 && $cartTotal >= $freeShippingThreshold;

        // ✅ Ambil informasi toko dari pengaturan
        $storeInfo = [
            'name' => $this->settingService->get('store_name', config('app.name')),
            'email' => $this->settingService->get('store_email', config('mail.from.address')),
            'phone' => $this->settingService->get('store_phone', ''),
            'address' => $this->settingService->get('store_address', ''),
            'currency' => $this->settingService->get('currency', 'IDR'),
        ];

        $user = Auth::user();

        return view('customer.cart.checkout', compact(
            'cart',
            'cartTotal',
            'user',
            'paymentMethods',
            'shippingMethods',
            'shippingCosts',
            'isFreeShipping',
            'freeShippingThreshold',
            'storeInfo'
        ));
    }

    /**
     * Process checkout and create order
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string|in:' . implode(',', $this->paymentService->getAvailablePaymentMethods()),
            'shipping_method' => 'required|string|in:' . implode(',', $this->getShippingMethods()),
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

        // ✅ Hitung biaya pengiriman
        $shippingMethod = $request->shipping_method;
        $shippingCost = (float) $this->settingService->get('shipping_cost_' . $shippingMethod, 0);
        
        // ✅ Cek gratis ongkir
        $cartTotal = $this->cartService->calculateTotal(Auth::id());
        $freeShippingThreshold = (float) $this->settingService->get('free_shipping_threshold', 0);
        if ($freeShippingThreshold > 0 && $cartTotal >= $freeShippingThreshold) {
            $shippingCost = 0;
        }

        // ✅ Hitung pajak (dari pengaturan)
        $taxRate = (float) $this->settingService->get('tax_rate', 11);
        $tax = $cartTotal * ($taxRate / 100);

        // ✅ Hitung grand total
        $grandTotal = $cartTotal + $shippingCost + $tax;

        // ✅ Create order
        $order = $this->checkoutService->createOrder(
            Auth::id(),
            array_merge($request->all(), [
                'shipping_cost' => $shippingCost,
                'tax' => $tax,
                'grand_total' => $grandTotal,
            ]),
            $cart
        );

        // ✅ Process payment
        try {
            $payment = $this->paymentService->processPayment(
                $order,
                $request->payment_method
            );
        } catch (\Exception $e) {
            // Rollback order jika payment gagal
            $order->delete();
            return redirect()->back()
                ->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage())
                ->withInput();
        }

        // ✅ Clear cart after successful order
        $this->cartService->clearCart(Auth::id());

        // ✅ Send notifications
        try {
            $this->notificationService->sendOrderNotification($order);
            $this->notificationService->sendPaymentNotification($payment);
        } catch (\Exception $e) {
            Log::error('Failed to send notifications: ' . $e->getMessage());
        }

        // ✅ Redirect ke halaman pembayaran atau detail pesanan
        if ($payment->midtrans_enabled && $payment->snap_token) {
            return redirect()->route('customer.payment.midtrans', $payment->id);
        }

        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat! Silahkan selesaikan pembayaran Anda.');
    }

    /**
     * Get shipping methods from settings
     */
    protected function getShippingMethods(): array
    {
        $methods = $this->settingService->get('shipping_methods', 'standard,express,same_day');
        $methods = array_map('trim', explode(',', $methods));
        return array_filter($methods);
    }

    /**
     * Get shipping costs from settings
     */
    protected function getShippingCosts(array $methods): array
    {
        $costs = [];
        foreach ($methods as $method) {
            $costs[$method] = (float) $this->settingService->get('shipping_cost_' . $method, 0);
        }
        return $costs;
    }
}