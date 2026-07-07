@php
    $cartService = app(\App\Services\CartService::class);
    $cartItems = auth()->check() ? $cartService->getCart(auth()->id()) : null;
    $cartTotal = auth()->check() ? $cartService->calculateTotal(auth()->id()) : 0;
    $cartCount = auth()->check() ? $cartService->getCartCount(auth()->id()) : 0;
@endphp

<div x-data="miniCart"
     @cart-updated.window="updateCart"
     class="relative">
    <!-- Cart Trigger -->
    <button @click="toggle" class="relative p-2 text-gray-600 hover:text-primary transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
        </svg>
        <span x-show="count > 0"
              x-text="count"
              class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-primary rounded-full">
            {{ $cartCount }}
        </span>
    </button>

    <!-- Cart Dropdown -->
    <div x-show="isOpen"
         @click.away="close"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 border border-gray-100 overflow-hidden"
         style="display: none;">
        
        <div class="p-4 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-900">Keranjang Belanja</h3>
            <span class="text-sm text-gray-500" x-text="`${count} Produk`">{{ $cartCount }} Produk</span>
        </div>

        <div class="max-h-96 overflow-y-auto">
            @if(auth()->check() && $cartItems && $cartItems->items->count() > 0)
                <div class="divide-y divide-gray-50">
                    @foreach($cartItems->items as $item)
                        <div class="p-4 flex gap-4 hover:bg-gray-50 transition-colors">
                            <div class="w-16 h-16 rounded bg-gray-100 flex-shrink-0 overflow-hidden">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 truncate">{{ $item->product->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1">Ukuran: {{ $item->size->name }} | Jml: {{ $item->quantity }}</p>
                                <p class="text-sm font-bold text-primary mt-1">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm">Keranjang Anda kosong</p>
                    <a href="{{ route('products.index') }}" class="text-primary text-sm font-medium hover:underline mt-2 inline-block">Mulai Belanja</a>
                </div>
            @endif
        </div>

        @if(auth()->check() && $cartItems && $cartItems->items->count() > 0)
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm text-gray-600 font-medium">Total</span>
                    <span class="text-lg font-bold text-primary">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('customer.cart.index') }}" class="px-4 py-2 text-center text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded hover:bg-gray-50 transition-colors">
                        Lihat Keranjang
                    </a>
                    <a href="{{ route('customer.checkout.index') }}" class="px-4 py-2 text-center text-sm font-medium text-white bg-primary rounded hover:bg-primary/90 transition-colors">
                        Checkout
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
