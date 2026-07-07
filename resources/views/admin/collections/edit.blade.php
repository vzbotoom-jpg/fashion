@extends('layouts.admin')

@section('title', 'Edit Koleksi - Admin Panel')
@section('page_title', 'Edit Koleksi')
@section('page_subtitle', 'Update informasi koleksi')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.collections.update', $collection->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-form.input 
                    name="name" 
                    label="Nama Koleksi" 
                    value="{{ old('name', $collection->name) }}"
                    required
                />
            </div>

            <!-- Current Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                @if($collection->image_path)
                    <div class="w-32 h-32 bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $collection->image_path) }}" 
                             alt="{{ $collection->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                @else
                    <p class="text-sm text-gray-500">Tidak ada gambar</p>
                @endif
            </div>

            <!-- New Image -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar</label>
                <input type="file" name="image" accept="image/*" 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max 5MB)</p>
            </div>
        </div>

        <!-- Description -->
        <div>
            <x-form.textarea 
                name="description" 
                label="Deskripsi" 
                value="{{ old('description', $collection->description) }}"
                rows="3"
            />
        </div>

        <!-- Status -->
        <div>
            <x-form.checkbox 
                name="is_active" 
                label="Aktif" 
                checked="{{ old('is_active', $collection->is_active) }}"
            />
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Update Koleksi
            </button>
            <a href="{{ route('admin.collections.index') }}" class="btn-secondary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection