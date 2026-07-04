@extends('layouts.admin')

@section('title', 'Tambah Kategori - Admin Panel')
@section('page_title', 'Tambah Kategori')
@section('page_subtitle', 'Buat kategori produk baru')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-form.input 
                    name="name" 
                    label="Nama Kategori" 
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama kategori"
                    required
                />
            </div>

            <!-- Parent Category -->
            <div>
                <x-form.select 
                    name="parent_id" 
                    label="Kategori Induk" 
                    :options="$parentCategories ?? []"
                    optionValue="id"
                    optionLabel="name"
                    value="{{ old('parent_id') }}"
                    placeholder="Pilih Kategori Induk (Opsional)"
                />
            </div>
        </div>

        <!-- Description -->
        <div>
            <x-form.textarea 
                name="description" 
                label="Deskripsi" 
                value="{{ old('description') }}"
                placeholder="Deskripsi kategori"
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
                💾 Simpan Kategori
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary px-8 py-3 rounded-lg">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection