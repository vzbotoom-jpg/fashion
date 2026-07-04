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
    <h3 class="text-xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h3>

    <div class="space-y-4">
        <!-- Items -->
        @if($cart && $cart->items->isNotEmpty())
            <div class="max-h-80 overflow-y-auto space-y-4 pr-2 -mr-2">
                @foreach($cart->items as $item)
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg border border-gray-100 bg-gray-50">
                                <span class="absolute -top-2 -right-2 w-5 h-5 bg-gray-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full">
                                    {{ $item->quantity }}
                                </span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900">{{ $item->product->name }}</span>
                                <span class="text-xs text-gray-500">{{ $item->size->name }}</span>
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-gray-100 my-6"></div>
        @endif

        <!-- Subtotal -->
        <div class="checkout-summary-item">
            <span class="text-gray-500">Subtotal</span>
            <span class="font-semibold text-gray-900">
                Rp {{ number_format($subtotal, 0, ',', '.') }}
            </span>
        </div>

        <!-- Shipping -->
        <div class="checkout-summary-item">
            <span class="text-gray-500">Ongkos Kirim</span>
            @if($shipping > 0)
                <span class="font-semibold text-gray-900">
                    Rp {{ number_format($shipping, 0, ',', '.') }}
                </span>
            @else
                <span class="text-primary font-bold flex items-center gap-1">
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
                <div>
                    <span class="text-lg font-bold text-gray-900 block">Total</span>
                    <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Termasuk PPN</span>
                </div>
                <span class="checkout-summary-grand-total">
                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        @if($showActions)
            <div class="space-y-4 mt-8">
                <a href="{{ route('customer.checkout.index') }}" class="w-full btn-primary !py-4 text-lg">
                    Lanjutkan ke Pembayaran
                </a>
                <a href="{{ route('products.index') }}" class="w-full btn-secondary !py-4 text-gray-500 hover:text-gray-900 border-none shadow-none">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Lanjut Belanja
                </a>
            </div>
        @endif
    </div>
</div>