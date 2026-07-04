@extends('layouts.app')

@section('title', 'Pre-Order - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <!-- Package Icon -->
                    <svg class="w-16 h-16 text-primary mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <h1 class="text-3xl font-display font-bold text-gray-800">Pre-Order</h1>
                    <p class="text-gray-500 mt-2">
                        Pesan produk dengan ukuran yang Anda inginkan
                        @if($product)
                            <span class="block text-primary font-medium">"{{ $product->name }}"</span>
                        @endif
                    </p>
                </div>

                <!-- Product Info -->
                @if($product)
                    <div class="bg-gray-50 rounded-lg p-4 mb-6 flex items-center space-x-4">
                        <div class="w-16 h-16 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden">
                            @if($product->images->first())
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <!-- Shirt Icon -->
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $product->name }}</p>
                            <p class="text-sm text-primary font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Pre-Order Form -->
                <x-sections.pre-order-form :product="$product" :sizes="$sizes ?? []" />
            </div>
        </div>
    </div>
</section>
@endsection