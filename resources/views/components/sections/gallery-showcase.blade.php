@props([
    'images' => [],
    'title' => 'Galeri Fashion',
    'subtitle' => 'Lihat koleksi fashion terbaik kami',
])

<section class="section-padding">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-white">{{ $title }}</h2>
            <p class="text-gray-400 mt-2">{{ $subtitle }}</p>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($images as $image)
                <a href="{{ $image->image_url }}" 
                   data-lightbox="gallery" 
                   class="group gallery-item">
                    <img src="{{ $image->image_url }}" 
                         alt="{{ $image->title ?? 'Gallery image' }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="gallery-item-overlay">
                        <!-- Eye Icon -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    @if($image->title)
                        <div class="gallery-item-title">
                            <p class="gallery-item-title-text">{{ $image->title }}</p>
                        </div>
                    @endif
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <!-- Image Icon -->
                    <svg class="w-20 h-20 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500">Belum ada gambar galeri</p>
                </div>
            @endforelse
        </div>
        
        <!-- View All -->
        <div class="text-center mt-10">
            <a href="{{ route('gallery') }}" class="inline-flex items-center text-secondary font-semibold hover:underline">
                Lihat Semua Galeri
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>