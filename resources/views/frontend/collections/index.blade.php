@extends('layouts.app')

@section('title', 'Koleksi - ' . config('app.name'))
@section('meta_description', 'Koleksi fashion terbaik dari Fashion Pre-Order')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-display font-bold text-gray-800">Koleksi Fashion</h1>
            <p class="text-gray-500 mt-2">Temukan koleksi fashion terbaik dari kami</p>
        </div>

        <!-- Collections Grid -->
        @if($collections->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($collections as $collection)
                    <a href="{{ route('collections.show', $collection->slug) }}" class="group">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 group-hover:-translate-y-1">
                            <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                                @if($collection->image_path)
                                    <img src="{{ asset('storage/' . $collection->image_path) }}" 
                                         alt="{{ $collection->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-secondary/10">
                                        <!-- Collection Icon (Dress) -->
                                        <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800 group-hover:text-primary transition">
                                    {{ $collection->name }}
                                </h3>
                                @if($collection->description)
                                    <p class="text-gray-500 text-sm mt-1 line-clamp-2">
                                        {{ $collection->description }}
                                    </p>
                                @endif
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="text-sm text-gray-400">
                                        {{ $collection->products_count ?? 0 }} produk
                                    </span>
                                    <span class="text-primary font-medium group-hover:underline flex items-center gap-1">
                                        Lihat Koleksi
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($collections->hasPages())
                <div class="mt-8">
                    <x-ui.pagination :paginator="$collections" />
                </div>
            @endif
        @else
            <div class="text-center py-16">
                <!-- Folder Icon -->
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum ada koleksi</h3>
                <p class="text-gray-500">Koleksi akan segera hadir</p>
            </div>
        @endif
    </div>
</section>
@endsection