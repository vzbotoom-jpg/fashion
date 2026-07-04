<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Authentication - ' . config('app.name'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gradient-to-br from-primary/10 via-white to-secondary/10 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4 py-8">
        <!-- Logo / Brand -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <h1 class="text-3xl font-display font-bold text-primary">
                    {{ config('app.name', 'Fashion Pre-Order') }}
                </h1>
            </a>
            <p class="text-gray-500 text-sm mt-2">@yield('subtitle', 'Fashion custom sesuai keinginan Anda')</p>
        </div>
        
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            @include('layouts.partials.frontend.alerts')
            @yield('content')
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-6 text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>