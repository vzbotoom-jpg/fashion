@props([
    'product' => null,
])

@php
    $mainImage = $product ? $product->images->first() : null;
    $isInStock = $product ? $product->isInStock() : false;
@endphp

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
                    Unggulan
                </span>
            @endif
            @if($product && !$isInStock)
                <span class="product-card-badge-item product-card-badge-soldout">Habis</span>
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