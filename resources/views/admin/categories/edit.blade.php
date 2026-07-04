@extends('layouts.admin')

@section('title', 'Edit Kategori - Admin Panel')
@section('page_title', 'Edit Kategori')
@section('page_subtitle', 'Update informasi kategori')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-form.input 
                    name="name" 
                    label="Nama Kategori" 
                    value="{{ old('name', $category->name) }}"
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
                    value="{{ old('parent_id', $category->parent_id) }}"
                    placeholder="Pilih Kategori Induk (Opsional)"
                />
            </div>
        </div>

        <!-- Description -->
        <div>
            <x-form.textarea 
                name="description" 
                label="Deskripsi" 
                value="{{ old('description', $category->description) }}"
                rows="3"
            />
        </div>

        <!-- Status -->
        <div>
            <x-form.checkbox 
                name="is_active" 
                label="Aktif" 
                checked="{{ old('is_active', $category->is_active) }}"
            />
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg">
                💾 Update Kategori
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary px-8 py-3 rounded-lg">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection