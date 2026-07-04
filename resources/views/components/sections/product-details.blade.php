@props([
    'product' => null,
])

@php
    $mainImage = $product->images->first();
    $otherImages = $product->images->skip(1);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Images -->
    <div>
        <!-- Main Image -->
        <div class="aspect-square rounded-2xl overflow-hidden bg-gray-800">
            @if($mainImage)
                <img id="main-product-image" src="{{ asset('storage/' . $mainImage->image_path) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-white/5 to-secondary/5">
                    <!-- Shirt Icon -->
                    <svg class="w-32 h-32 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            @endif
        </div>
        
        <!-- Thumbnails -->
        @if($otherImages->isNotEmpty())
            <div class="grid grid-cols-4 gap-3 mt-4">
                @foreach($otherImages as $image)
                    <button onclick="changeProductImage('{{ asset('storage/' . $image->image_path) }}')" 
                            class="aspect-square rounded-xl overflow-hidden bg-gray-800 hover:ring-2 hover:ring-white transition">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="Product image" 
                             class="w-full h-full object-cover">
                    </button>
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- Info -->
    <div>
        <!-- Category -->
        <p class="text-sm text-gray-500 mb-2">
            {{ $product->category->name ?? 'Uncategorized' }}
        </p>
        
        <!-- Name -->
        <h1 class="text-3xl font-display font-bold text-white">{{ $product->name }}</h1>
        
        <!-- Price -->
        <div class="mt-4">
            <span class="text-3xl font-bold text-white">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </span>
        </div>
        
        <!-- Sizes -->
        @if($product->sizes->isNotEmpty())
            <div class="mt-6">
                <p class="font-medium text-gray-300 mb-3">Pilih Ukuran:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($product->sizes as $size)
                        <button onclick="selectSize({{ $size->id }}, {{ $product->id }})" 
                                class="size-btn size-option size-option-default" 
                                data-size="{{ $size->id }}"
                                data-stock="{{ $size->pivot->stock }}">
                            {{ $size->name }}
                            <span class="text-xs text-gray-500 block">{{ $size->pivot->stock }} stok</span>
                        </button>
                    @endforeach
                </div>
                <input type="hidden" id="selected-size" value="">
            </div>
        @endif
        
        <!-- Stock Info -->
        <div class="mt-4">
            @if($product->isInStock())
                <span class="text-secondary text-sm font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Tersedia
                </span>
            @else
                <span class="text-red-400 text-sm font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Habis - Silahkan Pre-Order
                </span>
            @endif
        </div>
        
        <!-- Description -->
        <div class="mt-6">
            <h4 class="font-medium text-gray-300 mb-2">Deskripsi</h4>
            <p class="text-gray-400 text-sm leading-relaxed">{{ $product->description }}</p>
        </div>
        
        <!-- Actions -->
        <div class="mt-8 space-y-3">
            <!-- Purchase Mode Tabs -->
            @include('components.sections.purchase-mode-tabs', ['product' => $product])
            
            <!-- Buy Button -->
            @auth
                @if(auth()->user()->role === 'customer')
                    <button onclick="addToCart()" 
                            class="w-full btn-primary btn-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="w-full block text-center btn-primary btn-lg flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Login untuk Membeli
                </a>
            @endauth
        </div>
    </div>
</div>

<script>
    let selectedSizeId = null;
    
    function selectSize(sizeId, productId) {
        selectedSizeId = sizeId;
        document.getElementById('selected-size').value = sizeId;
        
        // Update UI
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.classList.remove('size-option-selected');
            btn.classList.add('size-option-default');
            if (btn.dataset.size == sizeId) {
                btn.classList.remove('size-option-default');
                btn.classList.add('size-option-selected');
            }
        });
    }
    
    function changeProductImage(imageUrl) {
        document.getElementById('main-product-image').src = imageUrl;
    }
    
    function addToCart() {
        const productId = {{ $product->id }};
        const sizeId = selectedSizeId;
        
        if (!sizeId) {
            showToast('Silahkan pilih ukuran terlebih dahulu', 'warning');
            return;
        }
        
        // Check stock
        const selectedBtn = document.querySelector(`.size-btn[data-size="${sizeId}"]`);
        if (selectedBtn && parseInt(selectedBtn.dataset.stock) < 1) {
            showToast('Stok habis, silahkan pre-order', 'error');
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