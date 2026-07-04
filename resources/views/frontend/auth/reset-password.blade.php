@extends('layouts.auth')

@section('title', 'Reset Password - ' . config('app.name'))
@section('subtitle', 'Buat password baru untuk akun Anda')

@section('content')
<form method="POST" action="{{ route('password.update') }}" class="space-y-6">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email -->
    <x-form.input 
        type="email"
        name="email" 
        label="Alamat Email" 
        value="{{ $email ?? old('email') }}"
        placeholder="Masukkan email Anda"
        required
        autofocus
        readonly
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'/>
            </svg>
        "
    />

    <!-- New Password -->
    <x-form.input 
        type="password"
        name="password" 
        label="Password Baru" 
        placeholder="Minimal 8 karakter"
        required
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'/>
            </svg>
        "
    />

    <!-- Confirm Password -->
    <x-form.input 
        type="password"
        name="password_confirmation" 
        label="Konfirmasi Password Baru" 
        placeholder="Ulangi password baru Anda"
        required
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'/>
            </svg>
        "
    />

    <!-- Submit -->
    <x-ui.button type="submit" variant="primary" full>
        Reset Password
    </x-ui.button>

    <!-- Back to Login -->
    <div class="text-center text-sm text-gray-500">
        <a href="{{ route('login') }}" class="text-primary hover:underline flex items-center justify-center gap-1">
            <!-- Arrow Left Icon -->
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Login
        </a>
    </div>
</form>
@endsection