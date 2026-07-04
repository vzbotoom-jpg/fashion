@extends('layouts.app')

@section('title', $product->name . ' - ' . config('app.name'))
@section('meta_description', Str::limit($product->description, 160))
@section('meta_keywords', $product->name . ', fashion, pre-order, custom fashion')

@section('content')
<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Judul Langsung - TANPA BREADCRUMB -->
        <div class="mb-12">
            <span class="eyebrow">{{ $product->category->name ?? 'Koleksi' }}</span>
            <h1 class="section-title">{{ $product->name }}</h1>
        </div>

        <!-- Product Details -->
        <x-sections.product-details :product="$product" />

        <!-- Related Products -->
        @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
            <div class="mt-24">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl md:text-3xl font-display font-bold text-gray-900">Produk Terkait</h3>
                    <a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="text-secondary font-bold hover:underline">
                        Lihat Semua
                    </a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                    @foreach($relatedProducts as $related)
                        <x-sections.product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
