@extends('layouts.admin')

@section('title', 'Manajemen Galeri - Admin Panel')
@section('page_title', 'Galeri')
@section('page_subtitle', 'Kelola gambar galeri')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: {{ $images->total() }} gambar</p>
    <a href="{{ route('admin.gallery.create') }}" class="btn-primary px-4 py-2 rounded-lg text-sm flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Gambar
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
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                <a href="{{ route('admin.gallery.edit', $image->id) }}" class="bg-white text-gray-800 p-2 rounded-lg hover:bg-primary hover:text-white transition" title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>
                <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus gambar ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-white text-red-500 p-2 rounded-lg hover:bg-red-500 hover:text-white transition" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
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
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500">Belum ada gambar galeri</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $images->links() }}
</div>
@endsection