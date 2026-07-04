@extends('layouts.app')

@section('title', 'Produk - ' . config('app.name'))
@section('meta_description', 'Koleksi produk fashion terbaik dari Fashion Pre-Order')

@section('content')
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-display font-bold text-gray-800">Koleksi Produk</h1>
                <p class="text-gray-500 mt-1">Temukan fashion favorit Anda dari koleksi kami</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="text-sm text-gray-500">{{ $products->total() }} produk ditemukan</span>
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-8">
            <x-ui.filters :route="route('products.index')">
                <!-- Search -->
                <div>
                    <x-form.input 
                        name="search" 
                        label="Cari Produk" 
                        value="{{ request('search') }}"
                        placeholder="Cari nama produk..."
                        icon="
                            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/>
                            </svg>
                        "
                    />
                </div>

                <!-- Category -->
                <div>
                    <x-form.select 
                        name="category" 
                        label="Kategori" 
                        :options="$categories ?? []"
                        optionValue="id"
                        optionLabel="name"
                        value="{{ request('category') }}"
                        placeholder="Semua Kategori"
                    />
                </div>

                <!-- Sort -->
                <div>
                    <x-form.select 
                        name="sort" 
                        label="Urutkan" 
                        :options="[
                            ['id' => 'newest', 'name' => 'Terbaru'],
                            ['id' => 'price_asc', 'name' => 'Harga Terendah'],
                            ['id' => 'price_desc', 'name' => 'Harga Tertinggi'],
                            ['id' => 'popular', 'name' => 'Terpopuler'],
                            ['id' => 'name_asc', 'name' => 'Nama A-Z'],
                            ['id' => 'name_desc', 'name' => 'Nama Z-A'],
                        ]"
                        optionValue="id"
                        optionLabel="name"
                        value="{{ request('sort', 'newest') }}"
                    />
                </div>

                <!-- Price Range -->
                <div>
                    <x-form.input 
                        name="min_price" 
                        label="Harga Min" 
                        value="{{ request('min_price') }}"
                        placeholder="Min"
                        icon="
                            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'/>
                            </svg>
                        "
                    />
                </div>
            </x-ui.filters>
        </div>

        <!-- Products Grid -->
        @if($products->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <x-sections.product-card :product="$product" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                <x-ui.pagination :paginator="$products" />
            </div>
        @else
            <div class="text-center py-16">
                <!-- Search Icon -->
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada produk ditemukan</h3>
                <p class="text-gray-500">Coba ubah filter atau kata kunci pencarian Anda</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-4 text-primary hover:underline">
                    Reset Filter
                </a>
            </div>
        @endif
    </div>
</section>
@endsection