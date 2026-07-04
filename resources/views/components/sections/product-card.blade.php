@props([
    'product' => null,
])

@php
    $mainImage = $product ? $product->images->first() : null;
    $isInStock = $product ? $product->isInStock() : false;
@endphp

<div class="product-card group relative">
    <!-- Image Wrapper with hover effects -->
    <a href="{{ route('products.show', $product->slug) }}" class="block relative aspect-square overflow-hidden bg-gray-100 rounded-t-lg">
        @if($mainImage)
            <img src="{{ asset('storage/' . $mainImage->image_path) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif
        
        <!-- Badges -->
        <div class="absolute top-3 left-3 flex flex-col gap-2 z-10">
            @if($product->is_featured)
                <span class="bg-white/90 backdrop-blur-sm text-secondary text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded shadow-sm">
                    Unggulan
                </span>
            @endif
            @if(!$isInStock)
                <span class="bg-red-500 text-white text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded shadow-sm">
                    Habis
                </span>
            @endif
        </div>

        <!-- Add to Cart Overlay - Shopify Style -->
        <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 z-20">
            @if($isInStock)
                <button onclick="event.preventDefault(); addToCart({{ $product->id }})"
                        class="w-full btn-primary !py-2 text-sm shadow-xl flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Tambah ke Keranjang
                </button>
            @else
                <button disabled class="w-full bg-gray-200 text-gray-500 font-bold py-2 rounded text-sm cursor-not-allowed">
                    Stok Habis
                </button>
            @endif

<div class="product-card group bg-white">
    <!-- Image -->
    <div class="relative product-card-image group-hover:shadow-lg transition-shadow duration-500">
        <a href="{{ $product ? route('products.show', $product->slug) : '#' }}" class="block h-full">
            @if($product && $mainImage)
                <img src="{{ asset('storage/' . $mainImage->image_path) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-50 group-hover:bg-gray-100 transition-colors duration-500">
                    <svg class="w-12 h-12 text-gray-200 group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            @endif
        </a>
        
        <!-- Badges -->
        <div class="product-card-badge">
            @if($product && $product->is_featured)
                <span class="product-card-badge-item product-card-badge-featured">
                    Featured
                </span>
            @endif
            @if($product && !$isInStock)
                <span class="product-card-badge-item product-card-badge-soldout">Sold Out</span>
            @endif
        </div>

        <!-- Add to Cart Overlay (Shopify Style) -->
        <div class="absolute inset-x-4 bottom-4 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 flex flex-col gap-2">
            @if($product && $isInStock)
                <button onclick="window.Alpine.store('app').addToCart({{ $product->id }}, {{ $product->sizes->first()->id ?? 'null' }})"
                        class="w-full bg-white text-gray-900 text-[10px] font-bold uppercase tracking-widest py-3 shadow-xl hover:bg-gray-900 hover:text-white transition-colors duration-300">
                    Tambah ke Keranjang
                </button>
            @elseif($product && !$isInStock)
                <a href="{{ route('customer.pre-order.create', $product->slug) }}"
                   class="w-full bg-secondary text-white text-center text-[10px] font-bold uppercase tracking-widest py-3 shadow-xl hover:bg-secondary-dark transition-colors duration-300">
                    Pre-Order
                </a>
            @endif
            <a href="{{ $product ? route('products.show', $product->slug) : '#' }}"
               class="w-full bg-white/90 backdrop-blur-sm text-gray-900 text-center text-[10px] font-bold uppercase tracking-widest py-2 hover:bg-white transition-colors duration-300">
                Lihat Detail
            </a>
        </div>
    </div>
    
    <!-- Content -->
    <div class="p-4 space-y-2">
        <div class="flex items-center justify-between gap-2">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest truncate">
                {{ $product->category->name ?? 'Koleksi' }}
            </p>
        </div>

        <a href="{{ route('products.show', $product->slug) }}" class="block">
            <h3 class="text-gray-900 font-medium text-base leading-tight hover:text-secondary transition-colors line-clamp-2 min-h-[2.5rem]">
                {{ $product->name }}
            </h3>
        </a>
        
        <div class="pt-1">
            <span class="text-secondary font-bold text-lg">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </span>
        </div>
    </div>
</div>

    <div class="pt-4 px-1 pb-2">
        <a href="{{ $product ? route('products.show', $product->slug) : '#' }}" class="block">
            <h3 class="product-card-name text-gray-900 group-hover:text-secondary transition-colors duration-300">
                {{ $product->name ?? 'Nama Produk' }}
            </h3>
        </a>
        
        <div class="flex items-center justify-between mt-1.5">
            <span class="product-card-price text-gray-600">
                Rp {{ $product ? number_format($product->price, 0, ',', '.') : '0' }}
            </span>
            <span class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                {{ $product->category->name ?? 'Koleksi' }}
            </span>
        </div>
    </div>
</div>
