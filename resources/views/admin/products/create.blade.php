@extends('layouts.admin')

@section('title', 'Tambah Produk - Admin Panel')
@section('page_title', 'Tambah Produk')
@section('page_subtitle', 'Buat produk fashion baru')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-form.input 
                    name="name" 
                    label="Nama Produk" 
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama produk"
                    required
                />
            </div>

            <!-- SKU -->
            <div>
                <x-form.input 
                    name="sku" 
                    label="SKU" 
                    value="{{ old('sku') }}"
                    placeholder="Kode produk unik"
                    hint="Kosongkan untuk generate otomatis"
                />
            </div>

            <!-- Category -->
            <div>
                <x-form.select 
                    name="category_id" 
                    label="Kategori" 
                    :options="$categories ?? []"
                    optionValue="id"
                    optionLabel="name"
                    value="{{ old('category_id') }}"
                    placeholder="Pilih Kategori"
                    required
                />
            </div>

            <!-- Collection -->
            <div>
                <x-form.select 
                    name="collection_id" 
                    label="Koleksi" 
                    :options="$collections ?? []"
                    optionValue="id"
                    optionLabel="name"
                    value="{{ old('collection_id') }}"
                    placeholder="Pilih Koleksi (Opsional)"
                />
            </div>

            <!-- Price -->
            <div>
                <x-form.input 
                    type="number"
                    name="price" 
                    label="Harga" 
                    value="{{ old('price') }}"
                    placeholder="0"
                    required
                    icon="💰"
                />
            </div>

            <!-- Featured -->
            <div class="flex items-center pt-6">
                <x-form.checkbox 
                    name="is_featured" 
                    label="Jadikan Produk Unggulan" 
                    checked="{{ old('is_featured') }}"
                />
            </div>
        </div>

        <!-- Description -->
        <div>
            <x-form.textarea 
                name="description" 
                label="Deskripsi" 
                value="{{ old('description') }}"
                placeholder="Deskripsi lengkap produk"
                rows="4"
                required
            />
        </div>

        <!-- Sizes & Stock -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Ukuran & Stok
            </h3>
            <div id="sizes-container">
                @foreach($sizes ?? [] as $index => $size)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-3 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <x-form.checkbox 
                                name="sizes[{{ $index }}][size_id]" 
                                label="{{ $size->name }} ({{ $size->code }})"
                                value="{{ $size->id }}"
                            />
                        </div>
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $index }}][stock]" 
                            label="Stok" 
                            value="0"
                            placeholder="Jumlah stok"
                        />
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $index }}][min_stock]" 
                            label="Min Stok" 
                            value="5"
                            placeholder="Minimal stok"
                        />
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $index }}][price]" 
                            label="Harga (opsional)" 
                            placeholder="Harga khusus ukuran"
                        />
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Images -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Gambar Produk
            </h3>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition">
                <input type="file" name="images[]" accept="image/*" multiple 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                <p class="text-xs text-gray-400 mt-2 flex items-center justify-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Format: JPG, PNG, JPEG (Max 5MB per gambar)
                </p>
            </div>
        </div>

        <!-- Status -->
        <div class="flex items-center space-x-6">
            <x-form.checkbox 
                name="is_active" 
                label="Aktif" 
                checked="{{ old('is_active', true) }}"
            />
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan Produk
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-secondary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection