@extends('layouts.admin')

@section('title', 'Manajemen Stok - Admin Panel')
@section('page_title', 'Manajemen Stok')
@section('page_subtitle', 'Kelola stok produk: ' . $product->name)

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.products.stock.update', $product->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($product->sizes as $size)
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h4 class="font-semibold text-gray-800">{{ $size->name }} ({{ $size->code }})</h4>
                    <div class="mt-3 space-y-3">
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $loop->index }}][size_id]" 
                            label="Size ID" 
                            value="{{ $size->id }}"
                            hidden
                        />
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $loop->index }}][stock]" 
                            label="Stok" 
                            value="{{ $size->pivot->stock }}"
                            required
                            min="0"
                        />
                        <x-form.input 
                            type="number"
                            name="sizes[{{ $loop->index }}][min_stock]" 
                            label="Min Stok" 
                            value="{{ $size->pivot->min_stock }}"
                            required
                            min="0"
                        />
                        <div class="text-sm">
                            <span class="badge {{ $size->pivot->stock > $size->pivot->min_stock ? 'badge-success' : 'badge-danger' }}">
                                {{ $size->pivot->stock > $size->pivot->min_stock ? 'Stok Aman' : 'Stok Rendah' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Update Stok
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