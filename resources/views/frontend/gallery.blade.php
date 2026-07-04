@extends('layouts.app')

@section('title', 'Galeri - ' . config('app.name'))
@section('meta_description', 'Galeri koleksi fashion terbaik dari Fashion Pre-Order')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-display font-bold text-gray-800">Galeri Fashion</h1>
            <p class="text-gray-500 mt-2">Lihat koleksi fashion terbaik dari kami</p>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($galleryImages as $image)
                <a href="{{ $image->image_url }}" 
                   data-lightbox="gallery" 
                   class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100">
                    <img src="{{ $image->image_url }}" 
                         alt="{{ $image->title ?? 'Gallery image' }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <!-- Eye Icon -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    @if($image->title)
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                            <p class="text-white text-sm font-medium">{{ $image->title }}</p>
                            @if($image->category)
                                <p class="text-white/70 text-xs">{{ $image->category }}</p>
                            @endif
                        </div>
                    @endif
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <!-- Image Icon -->
                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500">Belum ada gambar galeri</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if(isset($galleryImages) && $galleryImages->hasPages())
            <div class="mt-8">
                <x-ui.pagination :paginator="$galleryImages" />
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    });
</script>
@endpush