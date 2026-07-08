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
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Ukuran & Stok
            </h3>
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
                            min="0"
                        />
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $loop->index }}][min_stock]" 
                            label="Min Stok" 
                            value="{{ $minStock }}"
                            placeholder="Minimal stok"
                            min="0"
                        />
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $loop->index }}][price]" 
                            label="Harga (opsional)" 
                            value="{{ $sizePrice }}"
                            placeholder="Harga khusus ukuran"
                            min="0"
                        />
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Current Images -->
        @if($product->images->isNotEmpty())
            <div>
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Gambar Saat Ini
                </h3>
                <div class="flex flex-wrap gap-4">
                    @foreach($product->images as $image)
                        <div class="relative w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                            <button type="button" onclick="removeImage({{ $image->id }})" 
                                    class="absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- New Images -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Tambah Gambar
            </h3>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition">
                <input type="file" name="new_images[]" accept="image/*" multiple 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                <p class="text-xs text-gray-400 mt-2">
                    Format: JPG, PNG, JPEG (Max 5MB per gambar)
                </p>
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
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Update Produk
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
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus gambar. Silakan coba lagi.');
            });
        }
    }

    // Toggle all sizes checkbox
    function toggleAllSizes(checked) {
        document.querySelectorAll('input[name^="sizes"][name$="[size_id]"]').forEach(function(checkbox) {
            checkbox.checked = checked;
        });
    }
</script>
@endsection