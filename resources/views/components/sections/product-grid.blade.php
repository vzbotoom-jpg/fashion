@props([
    'products' => [],
    'title' => 'Produk Terbaru',
    'subtitle' => 'Temukan produk fashion terbaru dari kami',
    'columns' => 4,
])

<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <span class="eyebrow">Koleksi Kami</span>
                <h2 class="section-title">{{ $title }}</h2>
                <p class="section-subtitle">{{ $subtitle }}</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-secondary font-bold text-sm uppercase tracking-widest hover:text-secondary-dark transition flex items-center gap-2 mb-2">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        
        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ $columns }} gap-6">
            @forelse($products as $product)
                @include('components.sections.product-card', ['product' => $product])
            @empty
                <div class="col-span-full text-center py-12">
                    <!-- Shopping Cart Icon -->
                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <p class="text-gray-500">Belum ada produk</p>
                </div>
            @endforelse
        </div>
    </div>
</section>