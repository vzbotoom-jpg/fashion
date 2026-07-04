@props([
    'collections' => [],
    'title' => 'Koleksi Unggulan',
    'subtitle' => 'Temukan koleksi fashion terbaik dari kami',
])

<section class="section-padding">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-white">{{ $title }}</h2>
            <p class="text-gray-400 mt-2">{{ $subtitle }}</p>
        </div>
        
        <!-- Collections Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($collections as $collection)
                <a href="{{ route('collections.show', $collection->slug) }}" class="group">
                    <div class="card group-hover:-translate-y-1">
                        <div class="aspect-[4/3] overflow-hidden bg-gray-800">
                            @if($collection->image_path)
                                <img src="{{ asset('storage/' . $collection->image_path) }}" 
                                     alt="{{ $collection->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-white/5 to-secondary/10">
                                    <!-- Collection Icon -->
                                    <svg class="w-20 h-20 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-white group-hover:text-gray-300 transition">
                                {{ $collection->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $collection->product_count ?? 0 }} produk
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <!-- Shopping Bag Icon -->
                    <svg class="w-20 h-20 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <p class="text-gray-500">Belum ada koleksi</p>
                </div>
            @endforelse
        </div>
        
        <!-- View All -->
        <div class="text-center mt-10">
            <a href="{{ route('collections.index') }}" class="inline-flex items-center text-secondary font-semibold hover:underline">
                Lihat Semua Koleksi
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>