<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Fashion Pre-Order'))</title>
    
    <!-- SEO Meta -->
    <meta name="description" content="@yield('meta_description', 'Fashion pre-order terbaik dengan custom size dan model sesuai keinginan Anda.')">
    <meta name="keywords" content="@yield('meta_keywords', 'fashion, pre-order, custom fashion, baju, kaos, kemeja, jaket')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 text-slate-900">
    <div class="min-h-screen flex flex-col bg-gray-50">
        <!-- Header -->
        @include('layouts.partials.frontend.header')
        
        <!-- Breadcrumb -->
        @if(!Route::is('home'))
            @include('layouts.partials.frontend.breadcrumb')
        @endif
        
        <!-- Alerts -->
        @include('layouts.partials.frontend.alerts')
        
        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('layouts.partials.frontend.footer')
        
        <!-- WhatsApp Button -->
        @include('layouts.partials.frontend.whatsapp-button')
        
        <!-- Scripts -->
        @include('layouts.partials.frontend.scripts')
        @stack('scripts')
    </div>
</body>
</html>