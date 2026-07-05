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

    <!-- Remember Me & Forgot Password -->
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
</form>

<!-- Divider: OR -->
<div class="relative my-6">
    <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-gray-300"></div>
    </div>
    <div class="relative flex justify-center text-sm">
        <span class="px-4 bg-white text-gray-500">OR</span>
    </div>
</div>

<!-- Social Login Buttons -->
<div class="space-y-3">
    <!-- Google Login -->
    <a href="{{ route('login.google') }}" 
       class="flex items-center justify-center gap-3 w-full px-4 py-3 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow-md">
        <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
        </svg>
        <span class="text-sm font-medium text-gray-700">Continue with Google</span>
    </a>

    <!-- GitHub Login -->
    <a href="{{ route('login.github') }}" 
       class="flex items-center justify-center gap-3 w-full px-4 py-3 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow-md">
        <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.15 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.62.24 2.85.12 3.15.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z" fill="#333"/>
        </svg>
        <span class="text-sm font-medium text-gray-700">Continue with GitHub</span>
    </a>
</div>

<!-- Register Link -->
<div class="mt-6 text-center text-sm text-gray-500">
    Don't have an account?
    <a href="{{ route('register') }}" class="text-primary hover:underline font-medium">
        Sign up
    </a>
</div>
@endsection