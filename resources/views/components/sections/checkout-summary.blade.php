@props([
    'cart' => null,
    'total' => 0,
    'subtotal' => 0,
    'shipping' => 0,
    'tax' => 0,
    'discount' => 0,
    'grandTotal' => 0,
    'showActions' => true,
])

<div {{ $attributes->merge(['class' => 'checkout-summary']) }}>
    <h3 class="text-lg font-semibold text-white mb-4">Ringkasan Pesanan</h3>

    <div class="space-y-3">
        <!-- Items -->
        @if($cart && $cart->items->isNotEmpty())
            <div class="max-h-60 overflow-y-auto space-y-2">
                @foreach($cart->items as $item)
                    <div class="checkout-summary-item">
                        <span class="text-gray-400">
                            {{ $item->product->name }} 
                            <span class="text-gray-500">x{{ $item->quantity }}</span>
                            <span class="text-xs text-gray-500">({{ $item->size->name }})</span>
                        </span>
                        <span class="font-medium text-white">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-white/10 my-3"></div>
        @endif

        <!-- Subtotal -->
        <div class="checkout-summary-item">
            <span class="text-gray-400">Subtotal</span>
            <span class="font-medium text-white">
                Rp {{ number_format($subtotal, 0, ',', '.') }}
            </span>
        </div>

        <!-- Shipping -->
        <div class="checkout-summary-item">
            <span class="text-gray-400">Ongkos Kirim</span>
            @if($shipping > 0)
                <span class="font-medium text-white">
                    Rp {{ number_format($shipping, 0, ',', '.') }}
                </span>
            @else
                <span class="text-secondary font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    GRATIS
                </span>
            @endif
        </div>

        <!-- Tax -->
        @if($tax > 0)
            <div class="checkout-summary-item">
                <span class="text-gray-400">Pajak (11%)</span>
                <span class="font-medium text-white">
                    Rp {{ number_format($tax, 0, ',', '.') }}
                </span>
            </div>
        @endif

        <!-- Discount -->
        @if($discount > 0)
            <div class="checkout-summary-item text-secondary">
                <span>Diskon</span>
                <span class="font-medium">
                    -Rp {{ number_format($discount, 0, ',', '.') }}
                </span>
            </div>
        @endif

        <!-- Grand Total -->
        <div class="checkout-summary-total">
            <div class="flex items-center justify-between">
                <span class="text-base font-semibold text-white">Total</span>
                <span class="checkout-summary-grand-total">
                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        @if($showActions)
            <div class="space-y-3 mt-4">
                <a href="{{ route('customer.checkout') }}" class="w-full btn-primary text-center block flex items-center justify-center gap-2">
                    <!-- Shopping Cart Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Lanjutkan ke Pembayaran
                </a>
                <a href="{{ route('customer.cart') }}" class="w-full btn-secondary text-center block flex items-center justify-center gap-2">
                    <!-- Arrow Left Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Keranjang
                </a>
            </div>
        @endif
    </div>
</div>