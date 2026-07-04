@extends('layouts.admin')

@section('title', 'Manajemen Koleksi - Admin Panel')
@section('page_title', 'Koleksi')
@section('page_subtitle', 'Kelola semua koleksi fashion')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: {{ $collections->total() }} koleksi</p>
    <a href="{{ route('admin.collections.create') }}" class="btn-primary px-4 py-2 rounded-lg text-sm">
        + Tambah Koleksi
    </a>
</div>

<!-- Collections Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($collections as $collection)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition">
            <div class="aspect-[4/3] bg-gray-100 overflow-hidden">
                @if($collection->image_path)
                    <img src="{{ asset('storage/' . $collection->image_path) }}" 
                         alt="{{ $collection->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-primary/10 to-secondary/10">
                        👗
                    </div>
                @endif
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-gray-800">{{ $collection->name }}</h3>
                <p class="text-sm text-gray-500">{{ $collection->products_count ?? 0 }} produk</p>
                <div class="mt-3 flex items-center gap-2">
                    <span class="badge {{ $collection->is_active ? 'badge-success' : 'badge-danger' }}">
                        {{ $collection->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                    <a href="{{ route('admin.collections.edit', $collection->id) }}" class="text-blue-500 hover:text-blue-700 ml-auto">✏️</a>
                    <form action="{{ route('admin.collections.destroy', $collection->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus koleksi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <span class="text-6xl block mb-4">📂</span>
            <p class="text-gray-500">Belum ada koleksi</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $collections->links() }}
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