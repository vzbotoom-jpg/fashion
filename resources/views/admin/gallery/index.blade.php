@extends('layouts.admin')

@section('title', 'Manajemen Galeri - Admin Panel')
@section('page_title', 'Galeri')
@section('page_subtitle', 'Kelola gambar galeri')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: {{ $images->total() }} gambar</p>
    <a href="{{ route('admin.gallery.create') }}" class="btn-primary px-4 py-2 rounded-lg text-sm">
        + Tambah Gambar
    </a>
</div>

<!-- Gallery Grid -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($images as $image)
        <div class="group relative bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="aspect-square overflow-hidden">
                <img src="{{ asset('storage/' . $image->image_path) }}" 
                     alt="{{ $image->title ?? 'Gallery image' }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            </div>
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center space-x-2">
                <a href="{{ route('admin.gallery.edit', $image->id) }}" class="bg-white text-gray-800 p-2 rounded-lg hover:bg-primary hover:text-white transition">
                    ✏️
                </a>
                <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus gambar ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-white text-red-500 p-2 rounded-lg hover:bg-red-500 hover:text-white transition">
                        🗑️
                    </button>
                </form>
            </div>
            @if($image->title)
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3">
                    <p class="text-white text-sm font-medium">{{ $image->title }}</p>
                    @if($image->category)
                        <p class="text-white/70 text-xs">{{ $image->category }}</p>
                    @endif
                </div>
            @endif
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <span class="text-6xl block mb-4">🖼️</span>
            <p class="text-gray-500">Belum ada gambar galeri</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $images->links() }}
</div>
@endsection