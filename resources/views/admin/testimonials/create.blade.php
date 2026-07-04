@extends('layouts.admin')

@section('title', 'Tambah Testimoni - Admin Panel')
@section('page_title', 'Tambah Testimoni')
@section('page_subtitle', 'Buat testimoni pelanggan baru')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Customer Name -->
            <div>
                <x-form.input 
                    name="customer_name" 
                    label="Nama Pelanggan" 
                    value="{{ old('customer_name') }}"
                    placeholder="Masukkan nama pelanggan"
                    required
                />
            </div>

            <!-- Customer Email -->
            <div>
                <x-form.input 
                    type="email"
                    name="customer_email" 
                    label="Email Pelanggan" 
                    value="{{ old('customer_email') }}"
                    placeholder="Masukkan email pelanggan"
                />
            </div>

            <!-- Avatar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
                <input type="file" name="customer_avatar" accept="image/*" 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max 2MB)</p>
            </div>

            <!-- Rating -->
            <div>
                <x-form.select 
                    name="rating" 
                    label="Rating" 
                    :options="[
                        ['id' => 1, 'name' => '⭐ 1'],
                        ['id' => 2, 'name' => '⭐⭐ 2'],
                        ['id' => 3, 'name' => '⭐⭐⭐ 3'],
                        ['id' => 4, 'name' => '⭐⭐⭐⭐ 4'],
                        ['id' => 5, 'name' => '⭐⭐⭐⭐⭐ 5'],
                    ]"
                    optionValue="id"
                    optionLabel="name"
                    value="{{ old('rating', 5) }}"
                    required
                />
            </div>
        </div>

        <!-- Content -->
        <div>
            <x-form.textarea 
                name="content" 
                label="Testimoni" 
                value="{{ old('content') }}"
                placeholder="Tulis testimoni pelanggan"
                rows="4"
                required
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
                💾 Simpan Testimoni
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary px-8 py-3 rounded-lg">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection