@extends('layouts.admin')

@section('title', 'Manajemen Stok - Admin Panel')
@section('page_title', 'Manajemen Stok')
@section('page_subtitle', 'Kelola stok produk: ' . $product->name)

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-bold text-red-800">Terjadi kesalahan:</h4>
                    <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.products.stock.update', $product->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @if($product->sizes->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($product->sizes as $size)
                    <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-semibold text-gray-800 flex items-center justify-between">
                            <span>{{ $size->name }} ({{ $size->code }})</span>
                            <span class="badge {{ $size->pivot->stock > $size->pivot->min_stock ? 'badge-success' : 'badge-danger' }}">
                                {{ $size->pivot->stock > $size->pivot->min_stock ? 'Stok Aman' : 'Stok Rendah' }}
                            </span>
                        </h4>
                        <div class="mt-3 space-y-3">
                            <input type="hidden" name="sizes[{{ $loop->index }}][size_id]" value="{{ $size->id }}">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                                <input type="number" 
                                       name="sizes[{{ $loop->index }}][stock]" 
                                       value="{{ $size->pivot->stock }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                                       required min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Min Stok</label>
                                <input type="number" 
                                       name="sizes[{{ $loop->index }}][min_stock]" 
                                       value="{{ $size->pivot->min_stock }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                                       required min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (opsional)</label>
                                <input type="number" 
                                       name="sizes[{{ $loop->index }}][price]" 
                                       value="{{ $size->pivot->price }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                                       placeholder="Harga khusus ukuran" min="0">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Update Stok
                </button>
                <a href="{{ route('admin.products.stock.index') }}" class="btn-secondary px-8 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        @else
            <!-- Jika tidak ada ukuran -->
            <div class="text-center py-12">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Belum Ada Ukuran</h3>
                <p class="text-sm text-gray-500 mt-2">Produk ini belum memiliki ukuran. Silakan tambahkan ukuran melalui halaman edit produk.</p>
                <div class="mt-4 flex justify-center gap-3">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-primary px-6 py-2 rounded-lg text-sm">
                        Edit Produk
                    </a>
                    <a href="{{ route('admin.products.stock.index') }}" class="btn-secondary px-6 py-2 rounded-lg text-sm">
                        Kembali
                    </a>
                </div>
            </div>
        @endif
    </form>
</div>

<style>
    .badge {
        @apply px-2 py-0.5 rounded-full text-xs font-medium;
    }
    .badge-success {
        @apply bg-green-100 text-green-800;
    }
    .badge-danger {
        @apply bg-red-100 text-red-800;
    }
</style>
@endsection