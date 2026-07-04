@extends('layouts.auth')

@section('title', 'Login - ' . config('app.name'))
@section('subtitle', 'Masuk ke akun Anda')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-6">
    @csrf

    <!-- Email -->
    <x-form.input 
        type="email"
        name="email" 
        label="Alamat Email" 
        value="{{ old('email') }}"
        placeholder="Masukkan email Anda"
        required
        autofocus
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'/>
            </svg>
        "
    />

    <!-- Password -->
    <x-form.input 
        type="password"
        name="password" 
        label="Password" 
        placeholder="Masukkan password Anda"
        required
        icon="
            <svg class='w-5 h-5 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'/>
            </svg>
        "
    />

    <!-- Remember Me -->
    <div class="flex items-center justify-between">
        <x-form.checkbox 
            name="remember" 
            label="Ingat saya" 
        />
        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
            Lupa password?
        </a>
    </div>

    <!-- Submit -->
    <x-ui.button type="submit" variant="primary" full>
        Masuk
    </x-ui.button>

    <!-- Register Link -->
    <div class="text-center text-sm text-gray-500">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-primary hover:underline font-medium">
            Daftar Sekarang
        </a>
    </div>
</form>
@endsection