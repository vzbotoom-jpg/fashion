@extends('layouts.app')

@section('title', $product->name . ' - ' . config('app.name'))
@section('meta_description', Str::limit($product->description, 160))
@section('meta_keywords', $product->name . ', fashion, pre-order, custom fashion')

@section('content')
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <!-- Product Details -->
        <x-sections.product-details :product="$product" />

        <!-- Related Products -->
        @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
            <div class="mt-16">
                <h3 class="text-2xl font-display font-bold text-gray-800 mb-6">Produk Terkait</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related->slug) }}" class="group">
                            <div class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-md transition">
                                <div class="aspect-square overflow-hidden">
                                    @if($related->images->first())
                                        <img src="{{ asset('storage/' . $related->images->first()->image_path) }}" 
                                             alt="{{ $related->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <!-- Shirt Icon -->
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-3">
                                    <h4 class="text-sm font-medium text-gray-800 group-hover:text-primary transition line-clamp-1">
                                        {{ $related->name }}
                                    </h4>
                                    <p class="text-sm font-semibold text-primary mt-1">
                                        Rp {{ number_format($related->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection