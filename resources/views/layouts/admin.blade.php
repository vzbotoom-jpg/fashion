<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - ' . config('app.name'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/admin.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('layouts.partials.admin.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">
            <!-- Admin Header -->
            @include('layouts.partials.admin.header')
            
            <!-- Main Content Area -->
            <main class="flex-1 p-6">
                @include('layouts.partials.frontend.alerts')
                @yield('content')
            </main>
            
            <!-- Admin Footer -->
            @include('layouts.partials.admin.footer')
        </div>
    </div>
    
    <!-- Scripts -->
    @include('layouts.partials.admin.scripts')
    @stack('scripts')
</body>
</html>