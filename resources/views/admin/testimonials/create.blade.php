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
                <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Format: JPG, PNG (Max 2MB)
                </p>
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
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan Testimoni
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection