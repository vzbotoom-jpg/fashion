@extends('layouts.app')

@section('title', $collection->name . ' - ' . config('app.name'))
@section('meta_description', Str::limit($collection->description ?? $collection->name, 160))

@section('content')
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <!-- Collection Header -->
        <div class="mb-8">
            <div class="relative rounded-xl overflow-hidden bg-gradient-to-r from-primary to-primary-dark text-white p-8 md:p-12">
                <div class="relative z-10">
                    <h1 class="text-3xl md:text-4xl font-display font-bold">{{ $collection->name }}</h1>
                    @if($collection->description)
                        <p class="text-white/80 mt-2 max-w-2xl">{{ $collection->description }}</p>
                    @endif
                    <p class="text-sm text-white/60 mt-4">
                        {{ $collection->products->count() }} produk dalam koleksi ini
                    </p>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-secondary/20 rounded-full blur-2xl"></div>
            </div>
        </div>

        <!-- Products -->
        @if($collection->products->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($collection->products as $product)
                    <x-sections.product-card :product="$product" />
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <!-- Shopping Bag Icon -->
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum ada produk</h3>
                <p class="text-gray-500">Produk dalam koleksi ini akan segera hadir</p>
                <a href="{{ route('collections.index') }}" class="inline-block mt-4 text-primary hover:underline flex items-center gap-1">
                    <!-- Arrow Left Icon -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Koleksi
                </a>
            </div>
        @endif
    </div>
</section>
@endsection