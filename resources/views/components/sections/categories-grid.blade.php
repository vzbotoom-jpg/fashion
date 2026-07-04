@props([
    'categories' => [],
    'title' => 'Kategori Produk',
    'subtitle' => 'Pilih kategori yang Anda minati',
])

<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="eyebrow">Pilihan Kategori</span>
            <h2 class="section-title">{{ $title }}</h2>
            <p class="section-subtitle">{{ $subtitle }}</p>
        </div>
        
        <!-- Categories Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group">
                    <div class="bg-white border border-gray-100 rounded-xl p-8 text-center hover:shadow-lg hover:border-secondary transition-all duration-300">
                        <div class="mb-5 flex justify-center">
                            @php
                                $iconClass = "w-10 h-10 text-gray-400 group-hover:text-secondary transition-colors duration-300";
                            @endphp
                            @switch($category->name)
                                @case('Kaos')
                                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    @break
                                @case('Kemeja')
                                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    @break
                                @default
                                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                            @endswitch
                        </div>
                        <h3 class="text-sm font-bold text-gray-900 group-hover:text-secondary transition-colors uppercase tracking-widest">
                            {{ $category->name }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-2">
                            {{ $category->products_count ?? 0 }} Produk
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    <p class="text-gray-500">Belum ada kategori</p>
                </div>
            @endforelse
        </div>
    </div>
</section>