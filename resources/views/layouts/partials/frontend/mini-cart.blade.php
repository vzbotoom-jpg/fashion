<!-- Mini Cart Dropdown -->
@php
    $cartItems = auth()->check() ? \App\Services\CartService::getCart(auth()->id()) : null;
    $cartTotal = auth()->check() ? \App\Services\CartService::calculateTotal(auth()->id()) : 0;
    $cartCount = auth()->check() ? \App\Services\CartService::getCartCount(auth()->id()) : 0;
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open" class="relative p-2 text-gray-700 hover:text-primary transition rounded-full hover:bg-gray-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
        </svg>
        
        <!-- Badge -->
        <span id="cart-badge" class="absolute -top-1 -right-1 bg-secondary text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
            {{ $cartCount }}
        </span>
    </button>
    
    <!-- Dropdown -->
    <div x-show="open" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden z-50">
        <div class="p-4 border-b border-gray-200">
            <h3 class="font-semibold text-gray-800">Keranjang Belanja</h3>
            <p class="text-sm text-gray-500">{{ $cartCount }} item</p>
        </div>
        
        <div class="max-h-80 overflow-y-auto p-4 space-y-3">
            @if($cartItems && $cartItems->items->isNotEmpty())
                @foreach($cartItems->items as $item)
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex-shrink-0 flex items-center justify-center">
                            <span class="text-2xl">👕</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ $item->product->name }}</p>
                            <p class="text-xs text-gray-500">{{ $item->size->name }} x {{ $item->quantity }}</p>
                            <p class="text-sm font-semibold text-primary">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                        <button onclick="removeFromCart({{ $item->id }})" class="text-gray-400 hover:text-red-500 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <span class="text-4xl mb-2 block">🛒</span>
                    <p class="text-gray-500">Keranjang kosong</p>
                    <a href="{{ route('products.index') }}" class="text-primary text-sm hover:underline mt-2 inline-block">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
        
        @if($cartItems && $cartItems->items->isNotEmpty())
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                <div class="flex justify-between items-center mb-3">
                    <span class="font-medium text-gray-800">Total:</span>
                    <span class="font-bold text-primary text-lg">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('customer.cart.index') }}" class="btn-primary w-full text-center py-2 px-4 rounded-lg block">
                    Lihat Keranjang
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    function removeFromCart(itemId) {
        if (confirm('Hapus item dari keranjang?')) {
            fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
</script>