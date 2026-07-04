@props([
    'products' => [],
    'title' => 'Produk Terbaru',
    'subtitle' => 'Temukan produk fashion terbaru dari kami',
    'columns' => 4,
])

<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header -->
        <div class="flex flex-col md:flex-row items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl space-y-4">
                <span class="eyebrow">Koleksi Terpilih</span>
                <h2 class="section-title">{{ $title }}</h2>
                <p class="section-subtitle">{{ $subtitle }}</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn-secondary flex items-center gap-2 group">
                Lihat Semua Produk
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
=======
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ $columns }} gap-8">
            @forelse($products as $product)
                @include('components.sections.product-card', ['product' => $product])
            @empty
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <!-- Shopping Cart Icon -->
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada produk yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
