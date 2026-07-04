@extends('layouts.admin')

@section('title', 'Tambah User - Super Admin')
@section('page_title', 'Tambah User')
@section('page_subtitle', 'Buat user baru di sistem')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.super.users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-form.input 
                    name="name" 
                    label="Nama Lengkap" 
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    required
                />
            </div>

            <!-- Email -->
            <div>
                <x-form.input 
                    type="email"
                    name="email" 
                    label="Email" 
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                />
            </div>

            <!-- Password -->
            <div>
                <x-form.input 
                    type="password"
                    name="password" 
                    label="Password" 
                    placeholder="Minimal 8 karakter"
                    required
                />
            </div>

            <!-- Password Confirmation -->
            <div>
                <x-form.input 
                    type="password"
                    name="password_confirmation" 
                    label="Konfirmasi Password" 
                    placeholder="Ulangi password"
                    required
                />
            </div>

            <!-- Role -->
            <div>
                <x-form.select 
                    name="role" 
                    label="Role" 
                    :options="$roles ?? []"
                    optionValue="id"
                    optionLabel="name"
                    value="{{ old('role') }}"
                    required
                />
            </div>

            <!-- Phone -->
            <div>
                <x-form.input 
                    name="phone" 
                    label="Telepon" 
                    value="{{ old('phone') }}"
                    placeholder="Masukkan nomor telepon"
                />
            </div>
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
                💾 Simpan User
            </button>
            <a href="{{ route('admin.super.users.index') }}" class="btn-secondary px-8 py-3 rounded-lg">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection