@extends('layouts.auth')

@section('title', 'Lupa Password - ' . config('app.name'))
@section('subtitle', 'Kirim link reset password ke email Anda')

@section('content')
@if(session('status'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6">
        <p class="text-sm text-green-700">{{ session('status') }}</p>
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}" class="space-y-6">
    @csrf

    <!-- Info -->
    <div class="text-sm text-gray-500 bg-blue-50 p-4 rounded-lg">
        <p class="flex items-start">
            <!-- Lightbulb Icon -->
            <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.
        </p>
    </div>

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

    <!-- Submit -->
    <x-ui.button type="submit" variant="primary" full>
        Kirim Link Reset Password
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