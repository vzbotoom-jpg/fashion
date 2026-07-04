@props([
    'products' => [],
    'title' => 'Produk Terbaru',
    'subtitle' => 'Temukan produk fashion terbaru dari kami',
    'columns' => 4,
])

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-display font-bold text-gray-800">{{ $title }}</h2>
                <p class="text-gray-500 mt-1">{{ $subtitle }}</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-primary font-semibold hover:underline flex items-center gap-1">
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