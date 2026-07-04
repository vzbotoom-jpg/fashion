@props([
    'categories' => [],
    'title' => 'Kategori Pilihan',
    'subtitle' => 'Temukan gaya yang tepat berdasarkan kategori produk favorit Anda.',
])

<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <span class="eyebrow">Eksplorasi</span>

        <div class="text-center mb-12">
            <span class="eyebrow">Pilihan Kategori</span>
            <h2 class="section-title">{{ $title }}</h2>
            <p class="section-subtitle">{{ $subtitle }}</p>
        </div>
        
        <!-- Categories Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group">
                    <div class="bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary/10 transition-colors">
                            <div class="text-gray-400 group-hover:text-primary transition-colors">
                                @switch($category->name)
                                    @case('Kaos')
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                        @break
                                    @case('Kemeja')
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        @break
                                    @case('Jaket')
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                        @break
                                    @case('Celana')
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        @break
                                    @default
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                        </svg>
                                @endswitch
                            </div>
                        </div>
                        <h3 class="font-bold text-gray-900 group-hover:text-primary transition-colors">
                            {{ $category->name }}
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">

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
                <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-gray-100">

                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    <p class="text-gray-500">Belum ada kategori yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
