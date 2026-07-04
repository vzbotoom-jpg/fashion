@extends('layouts.auth')

@section('title', 'Daftar - ' . config('app.name'))
@section('subtitle', 'Buat akun baru untuk mulai berbelanja')

@section('content')
<form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf

    <!-- Name -->
    <x-form.input 
        name="name" 
        label="Nama Lengkap" 
        value="{{ old('name') }}"
        placeholder="Masukkan nama lengkap Anda"
        required
        autofocus
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'/>
            </svg>
        "
    />

    <!-- Email -->
    <x-form.input 
        type="email"
        name="email" 
        label="Alamat Email" 
        value="{{ old('email') }}"
        placeholder="Masukkan email Anda"
        required
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'/>
            </svg>
        "
    />

    <!-- Phone -->
    <x-form.input 
        name="phone" 
        label="Nomor Telepon" 
        value="{{ old('phone') }}"
        placeholder="Masukkan nomor telepon"
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'/>
            </svg>
        "
    />

    <!-- Password -->
    <x-form.input 
        type="password"
        name="password" 
        label="Password" 
        placeholder="Minimal 8 karakter"
        required
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'/>
            </svg>
        "
    />

    <!-- Password Confirmation -->
    <x-form.input 
        type="password"
        name="password_confirmation" 
        label="Konfirmasi Password" 
        placeholder="Ulangi password Anda"
        required
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'/>
            </svg>
        "
    />

    <!-- Terms -->
    <x-form.checkbox 
        name="terms" 
        label="Saya setuju dengan Syarat & Ketentuan" 
        required
    />

    <!-- Submit -->
    <x-ui.button type="submit" variant="primary" full>
        Daftar
    </x-ui.button>

    <!-- Login Link -->
    <div class="text-center text-sm text-gray-500">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-primary hover:underline font-medium">
            Masuk Sekarang
        </a>
    </div>
</form>
@endsection