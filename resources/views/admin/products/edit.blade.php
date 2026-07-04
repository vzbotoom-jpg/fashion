@extends('layouts.admin')

@section('title', 'Edit Produk - Admin Panel')
@section('page_title', 'Edit Produk')
@section('page_subtitle', 'Update informasi produk')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-form.input 
                    name="name" 
                    label="Nama Produk" 
                    value="{{ old('name', $product->name) }}"
                    required
                />
            </div>

            <!-- SKU -->
            <div>
                <x-form.input 
                    name="sku" 
                    label="SKU" 
                    value="{{ old('sku', $product->sku) }}"
                    disabled
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
                    value="{{ old('category_id', $product->category_id) }}"
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
                    value="{{ old('collection_id', $product->collection_id) }}"
                    placeholder="Pilih Koleksi (Opsional)"
                />
            </div>

            <!-- Price -->
            <div>
                <x-form.input 
                    type="number"
                    name="price" 
                    label="Harga" 
                    value="{{ old('price', $product->price) }}"
                    required
                    icon="💰"
                />
            </div>

            <!-- Featured -->
            <div class="flex items-center pt-6">
                <x-form.checkbox 
                    name="is_featured" 
                    label="Jadikan Produk Unggulan" 
                    checked="{{ old('is_featured', $product->is_featured) }}"
                />
            </div>
        </div>

        <!-- Description -->
        <div>
            <x-form.textarea 
                name="description" 
                label="Deskripsi" 
                value="{{ old('description', $product->description) }}"
                rows="4"
                required
            />
        </div>

        <!-- Sizes & Stock -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4">📏 Ukuran & Stok</h3>
            <div id="sizes-container">
                @foreach($sizes ?? [] as $size)
                    @php
                        $productSize = $product->sizes->where('id', $size->id)->first();
                        $stock = $productSize ? $productSize->pivot->stock : 0;
                        $minStock = $productSize ? $productSize->pivot->min_stock : 5;
                        $sizePrice = $productSize ? $productSize->pivot->price : null;
                    @endphp
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-3 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <x-form.checkbox 
                                name="sizes[{{ $loop->index }}][size_id]" 
                                label="{{ $size->name }} ({{ $size->code }})"
                                value="{{ $size->id }}"
                                checked="{{ $productSize ? true : false }}"
                            />
                        </div>
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $loop->index }}][stock]" 
                            label="Stok" 
                            value="{{ $stock }}"
                            placeholder="Jumlah stok"
                        />
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $loop->index }}][min_stock]" 
                            label="Min Stok" 
                            value="{{ $minStock }}"
                            placeholder="Minimal stok"
                        />
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $loop->index }}][price]" 
                            label="Harga (opsional)" 
                            value="{{ $sizePrice }}"
                            placeholder="Harga khusus ukuran"
                        />
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Current Images -->
        @if($product->images->isNotEmpty())
            <div>
                <h3 class="font-semibold text-gray-800 mb-4">🖼️ Gambar Saat Ini</h3>
                <div class="flex flex-wrap gap-4">
                    @foreach($product->images as $image)
                        <div class="relative w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="Product image" 
                                 class="w-full h-full object-cover">
                            <button type="button" onclick="removeImage({{ $image->id }})" 
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                                ×
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- New Images -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4">🖼️ Tambah Gambar</h3>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition">
                <input type="file" name="images[]" accept="image/*" multiple 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, JPEG (Max 5MB per gambar)</p>
            </div>
        </div>

        <!-- Status -->
        <div class="flex items-center space-x-6">
            <x-form.checkbox 
                name="is_active" 
                label="Aktif" 
                checked="{{ old('is_active', $product->is_active) }}"
            />
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg">
                💾 Update Produk
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-secondary px-8 py-3 rounded-lg">
                ← Kembali
            </a>
        </div>
    </form>
</div>

<script>
    function removeImage(imageId) {
        if (confirm('Hapus gambar ini?')) {
            fetch(`/admin/products/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }
    }
</script>
@endsection