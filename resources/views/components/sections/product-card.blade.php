@props([
    'product' => null,
])

@php
    $mainImage = $product->images->first();
    $isInStock = $product->isInStock();
@endphp

<div class="product-card group">
    <!-- Image -->
    <a href="{{ route('products.show', $product->slug) }}" class="block relative product-card-image">
        @if($mainImage)
            <img src="{{ asset('storage/' . $mainImage->image_path) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-white/5 to-secondary/5">
                <!-- Shirt Icon -->
                <svg class="w-20 h-20 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        @endif
        
        <!-- Badges -->
        <div class="product-card-badge">
            @if($product->is_featured)
                <span class="product-card-badge-item product-card-badge-featured flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Featured
                </span>
            @endif
            @if(!$isInStock)
                <span class="product-card-badge-item product-card-badge-soldout">Habis</span>
            @endif
        </div>
        
        <!-- Quick View -->
        <div class="product-card-overlay">
            <button class="btn-primary btn-sm">
                Lihat Detail
            </button>
        </div>
    </a>
    
    <!-- Content -->
    <div class="p-4">
        <a href="{{ route('products.show', $product->slug) }}" class="block">
            <h3 class="product-card-name">
                {{ $product->name }}
            </h3>
        </a>
        
        <div class="flex items-center justify-between mt-2">
            <div>
                <span class="product-card-price">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
                @if($product->sizes->count() > 0)
                    <span class="text-xs text-gray-500 ml-2">
                        {{ $product->sizes->count() }} ukuran
                    </span>
                @endif
            </div>
            <div class="flex items-center space-x-1">
                <span class="text-xs text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</span>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="mt-3 pt-3 border-t border-white/10">
            @auth
                @if(auth()->user()->role === 'customer' && $isInStock)
                    <button onclick="addToCart({{ $product->id }})" 
                            class="w-full btn-primary btn-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                @elseif(auth()->user()->role === 'customer' && !$isInStock)
                    <a href="{{ route('customer.pre-order.create', $product->slug) }}" 
                       class="w-full block text-center btn-warning btn-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Pre-Order
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" 
                   class="w-full block text-center btn-secondary btn-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Login untuk membeli
                </a>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script>
    function addToCart(productId) {
        // Get selected size (if multiple sizes)
        const sizeSelect = document.querySelector(`#size-${productId}`);
        const sizeId = sizeSelect ? sizeSelect.value : null;
        
        if (!sizeId) {
            showToast('Silahkan pilih ukuran terlebih dahulu', 'warning');
            return;
        }
        
        fetch('{{ route("customer.cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId,
                size_id: sizeId,
                quantity: 1
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                // Update cart badge
                document.getElementById('cart-badge').textContent = data.cart_count;
            } else {
                showToast(data.message || 'Gagal menambahkan ke keranjang', 'error');
            }
        })
        .catch(error => {
            showToast('Terjadi kesalahan', 'error');
            console.error('Error:', error);
        });
    }
</script>
@endpush