@extends('layouts.app')

@section('title', 'Produk - ' . config('app.name'))
@section('meta_description', 'Koleksi produk fashion terbaik dari Fashion Pre-Order')

@section('content')
<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header Section - TANPA BREADCRUMB -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl space-y-4">
                <span class="eyebrow">Koleksi Terpilih</span>
                <h1 class="section-title">Koleksi Produk</h1>
                <p class="section-subtitle">Temukan fashion favorit Anda dari koleksi terbaik kami yang dirancang khusus untuk Anda.</p>
            </div>
            <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-100">
                <span class="text-sm font-medium text-gray-600">{{ $products->total() }} Produk Tersedia</span>
            </div>
        </div>

        <!-- Filter & Search Bar - Shopify Style -->
        <div class="mb-12 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-wrap items-end gap-6">
                <!-- Search -->
                <div class="flex-grow min-w-[280px]">
                    <label for="search" class="form-label">Cari Produk</label>
                    <div class="relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               class="form-input !pl-12" placeholder="Masukkan nama produk...">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div class="w-full sm:w-auto min-w-[200px]">
                    <label for="category" class="form-label">Kategori</label>
                    <select name="category" id="category" class="form-input">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort -->
                <div class="w-full sm:w-auto min-w-[200px]">
                    <label for="sort" class="form-label">Urutkan</label>
                    <select name="sort" id="sort" class="form-input">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3 ml-auto">
                    <button type="submit" class="btn-secondary btn-sm !py-2.5">
                        Filter
                    </button>
                    @if(request()->anyFilled(['search', 'category', 'sort', 'min_price', 'max_price']))
                        <a href="{{ route('products.index') }}" class="btn-outline btn-sm !py-2.5">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        @if($products->isNotEmpty())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                @foreach($products as $product)
                    <x-sections.product-card :product="$product" />
                @endforeach
            </div>

            <!-- Pagination - Shopify Style -->
            <div class="mt-16 flex justify-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
                <p class="text-gray-500 max-w-sm mx-auto">Kami tidak dapat menemukan produk yang sesuai dengan filter Anda. Silakan coba kata kunci lain atau reset filter.</p>
                <a href="{{ route('products.index') }}" class="btn-primary mt-8">
                    Lihat Semua Produk
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
