@extends('layouts.admin')

@section('title', 'Tambah Koleksi - Admin Panel')
@section('page_title', 'Tambah Koleksi')
@section('page_subtitle', 'Buat koleksi fashion baru')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-form.input 
                    name="name" 
                    label="Nama Koleksi" 
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama koleksi"
                    required
                />
            </div>

            <!-- Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Koleksi</label>
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
                value="{{ old('description') }}"
                placeholder="Deskripsi koleksi"
                rows="3"
            />
        </div>

        <!-- Status -->
        <div>
            <x-form.checkbox 
                name="is_active" 
                label="Aktif" 
                checked="{{ old('is_active', true) }}"
            />
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg">
                💾 Simpan Koleksi
            </button>
            <a href="{{ route('admin.collections.index') }}" class="btn-secondary px-8 py-3 rounded-lg">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection