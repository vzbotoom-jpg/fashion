@extends('layouts.admin')

@section('title', 'Edit User - Super Admin')
@section('page_title', 'Edit User')
@section('page_subtitle', 'Update informasi user')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.super.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-form.input 
                    name="name" 
                    label="Nama Lengkap" 
                    value="{{ old('name', $user->name) }}"
                    required
                />
            </div>

            <!-- Email -->
            <div>
                <x-form.input 
                    type="email"
                    name="email" 
                    label="Email" 
                    value="{{ old('email', $user->email) }}"
                    required
                />
            </div>

            <!-- Password -->
            <div>
                <x-form.input 
                    type="password"
                    name="password" 
                    label="Password (Kosongkan jika tidak diubah)" 
                    placeholder="Minimal 8 karakter"
                />
            </div>

            <!-- Password Confirmation -->
            <div>
                <x-form.input 
                    type="password"
                    name="password_confirmation" 
                    label="Konfirmasi Password" 
                    placeholder="Ulangi password"
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
                    value="{{ old('role', $user->role) }}"
                    required
                />
            </div>

            <!-- Phone -->
            <div>
                <x-form.input 
                    name="phone" 
                    label="Telepon" 
                    value="{{ old('phone', $user->phone) }}"
                    placeholder="Masukkan nomor telepon"
                />
            </div>
        </div>

        <!-- Status -->
        <div>
            <x-form.checkbox 
                name="is_active" 
                label="Aktif" 
                checked="{{ old('is_active', $user->is_active) }}"
            />
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Update User
            </button>
            <a href="{{ route('admin.super.users.index') }}" class="btn-secondary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection