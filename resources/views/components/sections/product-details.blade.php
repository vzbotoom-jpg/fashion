@props([
    'product' => null,
])

@php
    $mainImage = $product->images->first();
    $otherImages = $product->images; // Show all images including first as thumb
    $isInStock = $product->isInStock();
@endphp

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
    <!-- Images Section -->
    <div class="space-y-6">
        <!-- Main Image -->
        <div class="aspect-square rounded-3xl overflow-hidden bg-gray-50 border border-gray-100 shadow-inner group">
            @if($mainImage)
                <img id="main-product-image" src="{{ asset('storage/' . $mainImage->image_path) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-32 h-32 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
        </div>
        
        <!-- Thumbnails -->
        @if($otherImages->count() > 1)
            <div class="grid grid-cols-5 gap-4">
                @foreach($otherImages as $image)
                    <button onclick="changeProductImage('{{ asset('storage/' . $image->image_path) }}')" 
                            class="aspect-square rounded-xl overflow-hidden border-2 border-transparent hover:border-primary transition bg-gray-50">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="Thumbnail"
                             class="w-full h-full object-cover">
                    </button>
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- Info Section -->
    <div class="flex flex-col">
        <div class="mb-6">
            <span class="eyebrow">{{ $product->category->name ?? 'Koleksi' }}</span>
            <h1 class="section-title !text-4xl md:!text-5xl mt-2">{{ $product->name }}</h1>

            <div class="flex items-center gap-4 mt-6">
                <span class="text-3xl font-extrabold text-secondary">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
                @if(!$isInStock)
                    <span class="bg-red-50 text-red-500 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-red-100">
                        Habis
                    </span>
                @else
                    <span class="bg-green-50 text-secondary px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-green-100">
                        Tersedia
                    </span>
                @endif
            </div>
        </div>

        <hr class="border-gray-100 mb-8">
        
        <!-- Description -->
        <div class="mb-8">
            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4">Deskripsi Produk</h4>
            <div class="text-gray-600 leading-relaxed space-y-4">
                {{ $product->description }}
            </div>
        </div>
        
        <!-- Sizes -->
        @if($product->sizes->isNotEmpty())
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest">Pilih Ukuran</h4>
                    <button type="button" class="text-xs font-bold text-primary hover:underline">Panduan Ukuran</button>
                </div>
                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                    @foreach($product->sizes as $size)
                        @php $hasStock = $size->pivot->stock > 0; @endphp
                        <button
                            onclick="selectSize({{ $size->id }}, {{ $size->pivot->stock }})"
                            class="size-option-btn py-3 px-2 rounded-xl border-2 transition-all text-center group {{ $hasStock ? 'border-gray-100 hover:border-primary' : 'border-gray-50 bg-gray-50 opacity-50 cursor-not-allowed' }}"
                            data-size-id="{{ $size->id }}"
                            {{ !$hasStock ? 'disabled' : '' }}
                        >
                            <span class="block font-bold text-gray-900 group-hover:text-primary">{{ $size->name }}</span>
                            <span class="text-[10px] text-gray-400">{{ $size->pivot->stock }} unit</span>
                        </button>
                    @endforeach
                </div>
                <input type="hidden" id="selected-size-id" value="">
            </div>
        @endif
        
        <!-- Actions -->
        <div class="mt-auto pt-8 border-t border-gray-100 space-y-4">
            @auth
                @if(auth()->user()->role === 'customer')
                    @if($isInStock)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <button onclick="handleAddToCart()"
                                    class="btn-primary !py-4 flex items-center justify-center gap-3 shadow-xl shadow-primary/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                            <a href="{{ route('customer.custom-order.create', ['product' => $product->id]) }}"
                               class="btn-secondary !py-4 flex items-center justify-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Custom Order
                            </a>
                        </div>
                    @else
                        <a href="{{ route('customer.pre-order.create', $product->slug) }}"
                           class="w-full btn-success !py-4 flex items-center justify-center gap-3 shadow-xl shadow-secondary/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Mulai Pre-Order
                        </a>
                    @endif
                @endif
            @else
                <a href="{{ route('login') }}" class="w-full btn-primary !py-4 flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk untuk Membeli
                </a>
            @endauth
        </div>
    </div>
</div>

<script>
    let currentSelectedSize = null;
    
    function selectSize(sizeId, stock) {
        currentSelectedSize = sizeId;
        document.getElementById('selected-size-id').value = sizeId;
        
        // Reset and Update UI
        document.querySelectorAll('.size-option-btn').forEach(btn => {
            btn.classList.remove('border-primary', 'bg-primary/5');
            btn.classList.add('border-gray-100');

            if (btn.dataset.sizeId == sizeId) {
                btn.classList.remove('border-gray-100');
                btn.classList.add('border-primary', 'bg-primary/5');
            }
        });
    }
    
    function changeProductImage(imageUrl) {
        const mainImg = document.getElementById('main-product-image');
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = imageUrl;
            mainImg.style.opacity = '1';
        }, 200);
    }
    
    function handleAddToCart() {
        if (!currentSelectedSize) {
            window.showToast('Silakan pilih ukuran terlebih dahulu', 'warning');
            return;
        }
        
        // Use the global helper from scripts.blade.php
        window.addToCart({{ $product->id }}, currentSelectedSize);
    }
</script>
