@extends('layouts.admin')

@section('title', 'Pengaturan Umum - Super Admin')
@section('page_title', 'Pengaturan Umum')
@section('page_subtitle', 'Kelola informasi dasar toko')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.super.settings.general') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Store Name -->
            <div>
                <x-form.input 
                    name="store_name" 
                    label="Nama Toko" 
                    value="{{ old('store_name', $settings['store_name'] ?? '') }}"
                    required
                />
            </div>

            <!-- Store Email -->
            <div>
                <x-form.input 
                    type="email"
                    name="store_email" 
                    label="Email Toko" 
                    value="{{ old('store_email', $settings['store_email'] ?? '') }}"
                    required
                />
            </div>

            <!-- Store Phone -->
            <div>
                <x-form.input 
                    name="store_phone" 
                    label="Telepon Toko" 
                    value="{{ old('store_phone', $settings['store_phone'] ?? '') }}"
                    required
                />
            </div>

            <!-- Timezone -->
            <div>
                <x-form.select 
                    name="timezone" 
                    label="Zona Waktu" 
                    :options="[
                        ['id' => 'Asia/Jakarta', 'name' => 'Asia/Jakarta (WIB)'],
                        ['id' => 'Asia/Makassar', 'name' => 'Asia/Makassar (WITA)'],
                        ['id' => 'Asia/Jayapura', 'name' => 'Asia/Jayapura (WIT)'],
                    ]"
                    optionValue="id"
                    optionLabel="name"
                    value="{{ old('timezone', $settings['timezone'] ?? 'Asia/Jakarta') }}"
                />
            </div>

            <!-- Currency -->
            <div>
                <x-form.select 
                    name="currency" 
                    label="Mata Uang" 
                    :options="[
                        ['id' => 'IDR', 'name' => 'IDR - Rupiah Indonesia'],
                        ['id' => 'USD', 'name' => 'USD - US Dollar'],
                    ]"
                    optionValue="id"
                    optionLabel="name"
                    value="{{ old('currency', $settings['currency'] ?? 'IDR') }}"
                />
            </div>
        </div>

        <!-- Store Address -->
        <div>
            <x-form.textarea 
                name="store_address" 
                label="Alamat Toko" 
                value="{{ old('store_address', $settings['store_address'] ?? '') }}"
                rows="3"
                required
            />
        </div>

        <!-- Store Description -->
        <div>
            <x-form.textarea 
                name="store_description" 
                label="Deskripsi Toko" 
                value="{{ old('store_description', $settings['store_description'] ?? '') }}"
                rows="2"
            />
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg">
                💾 Simpan Pengaturan
            </button>
            <a href="{{ route('admin.super.settings.index') }}" class="btn-secondary px-8 py-3 rounded-lg">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection