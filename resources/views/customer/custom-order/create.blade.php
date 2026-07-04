@extends('layouts.app')

@section('title', 'Custom Order - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <!-- Paint Brush Icon -->
                    <svg class="w-16 h-16 text-primary mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <h1 class="text-3xl font-display font-bold text-gray-800">Custom Order</h1>
                    <p class="text-gray-500 mt-2">
                        Buat fashion sesuai keinginan Anda
                        @if($product)
                            <span class="block text-primary font-medium">Referensi: "{{ $product->name }}"</span>
                        @endif
                    </p>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
                    <div class="flex items-start">
                        <!-- Lightbulb Icon -->
                        <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-700 font-medium">Cara Custom Order:</p>
                            <ul class="text-sm text-blue-600 list-disc list-inside mt-1 space-y-1">
                                <li>Pilih ukuran yang diinginkan</li>
                                <li>Jelaskan detail custom (warna, model, bahan, dll)</li>
                                <li>Upload gambar referensi (opsional)</li>
                                <li>Tim kami akan menghubungi Anda untuk konfirmasi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Product Reference -->
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
                            <p class="text-sm text-gray-500">Sebagai referensi desain</p>
                        </div>
                    </div>
                @endif

                <!-- Custom Order Form -->
                <x-sections.custom-order-form :product="$product" :sizes="$sizes ?? []" />
            </div>
        </div>
    </div>
</section>
@endsection