<!-- Header -->
<header
    x-data="{ isMobileMenuOpen: false, isScrolled: false }"
    @scroll.window="isScrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-white shadow-md py-2': isScrolled, 'bg-white/80 backdrop-blur-md py-4': !isScrolled }"
    class="sticky top-0 z-50 border-b border-gray-100 transition-all duration-300"
>
    <nav class="container-custom">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center group-hover:rotate-6 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-display font-bold tracking-tight text-gray-900">
<header class="bg-white sticky top-0 z-50 border-b border-gray-100">
    <nav class="container-custom">
        <div class="flex items-center justify-between h-16 md:h-20">
            <!-- Logo -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-xl md:text-2xl font-display font-bold tracking-tight text-gray-900">
                        {{ config('app.name', 'Fashion') }}
                    </span>
                </a>
            </div>
            
            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <!-- Home -->
                <a href="{{ route('home') }}"
                   class="text-sm font-bold transition-all duration-300 relative group {{ Route::is('home') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
            <div class="hidden md:flex items-center space-x-10">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('home')) !text-gray-900 font-semibold @endif">
                    Home
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('home') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <!-- Produk -->
                <a href="{{ route('products.index') }}"
                   class="text-sm font-bold transition-all duration-300 relative group {{ Route::is('products.*') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('products.*')) !text-gray-900 font-semibold @endif">
                    Produk
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('products.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <!-- Koleksi -->
                <a href="{{ route('collections.index') }}"
                   class="text-sm font-bold transition-all duration-300 relative group {{ Route::is('collections.*') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                <a href="{{ route('collections.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('collections.*')) !text-gray-900 font-semibold @endif">
                    Koleksi
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('collections.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <!-- Galeri -->
                <a href="{{ route('gallery') }}"
                   class="text-sm font-bold transition-all duration-300 relative group {{ Route::is('gallery') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                <a href="{{ route('gallery') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('gallery')) !text-gray-900 font-semibold @endif">
                    Galeri
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('gallery') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <!-- Tentang -->
                <a href="{{ route('about') }}"
                   class="text-sm font-bold transition-all duration-300 relative group {{ Route::is('about') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('about')) !text-gray-900 font-semibold @endif">
                    Tentang
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('about') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <!-- Kontak -->
                <a href="{{ route('contact.index') }}"
                   class="text-sm font-bold transition-all duration-300 relative group {{ Route::is('contact.*') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">

                <a href="{{ route('contact.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('contact.*')) !text-gray-900 font-semibold @endif">
                    Kontak
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('contact.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>
            </div>
            
            <!-- Right Side -->
            <div class="flex items-center space-x-3">
            <!-- Right Side Actions -->
            <div class="flex items-center space-x-5">
                @auth
                    @if(auth()->user()->role === 'customer')
                        <!-- Mini Cart -->
                        @include('layouts.partials.frontend.mini-cart')
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none p-1 rounded-full hover:bg-gray-100 transition">
                                <div class="w-8 h-8 rounded-full bg-primary-light text-primary flex items-center justify-center text-sm font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <svg class="w-4 h-4 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <button @click="open = !open" class="flex items-center group focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-xs font-bold text-gray-700 group-hover:bg-gray-200 transition">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <svg class="w-4 h-4 ml-1.5 text-gray-400 group-hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                @click.away="open = false"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-2 border border-gray-100 z-50"
                            >
                                <div class="px-4 py-2 border-b border-gray-50 mb-1">
                                    <p class="text-xs text-gray-500">Masuk sebagai</p>
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                </div>
                                <a href="{{ route('customer.orders') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-secondary transition">
                                    <span class="mr-3">📦</span> Pesanan Saya
                                </a>
                                <a href="{{ route('customer.profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-secondary transition">
                                    <span class="mr-3">👤</span> Profil Saya
                                </a>
                                <div class="border-t border-gray-50 mt-1"></div>
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                        <span class="mr-3">🚪</span> Logout
                            <div x-show="open" @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 z-50 border border-gray-100">
                                <a href="{{ route('customer.orders') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                    📦 Pesanan Saya
                                </a>
                                <a href="{{ route('customer.profile.edit') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                    👤 Profil
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-gray-50">
                                        🚪 Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Admin Menu -->
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-secondary hover:underline">
                            Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline ml-4">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-gray-600 hover:text-red-600">
                                Logout
                            </button>
                        </form>
                    @endif
                @else
                    <!-- Guest Menu -->
                    <div class="hidden sm:flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-secondary px-4 py-2 transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary text-sm !py-2 !px-5 shadow-lg shadow-primary/20">
                            Daftar
                        </a>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none">
                    <svg x-show="!isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-secondary">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">Logout</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary !py-2 !px-5 !text-sm">Daftar</a>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-toggle" class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div
            x-show="isMobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden mt-4 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden"
        >
            <div class="flex flex-col p-4 space-y-1">
                <a href="{{ route('home') }}" class="px-4 py-3 rounded-xl text-base font-bold transition {{ Route::is('home') ? 'bg-secondary/5 text-secondary' : 'text-gray-600 hover:bg-gray-50' }}">
                    Home
                </a>
                <a href="{{ route('products.index') }}" class="px-4 py-3 rounded-xl text-base font-bold transition {{ Route::is('products.*') ? 'bg-secondary/5 text-secondary' : 'text-gray-600 hover:bg-gray-50' }}">
                    Produk
                </a>
                <a href="{{ route('collections.index') }}" class="px-4 py-3 rounded-xl text-base font-bold transition {{ Route::is('collections.*') ? 'bg-secondary/5 text-secondary' : 'text-gray-600 hover:bg-gray-50' }}">
                    Koleksi
                </a>
                <a href="{{ route('gallery') }}" class="px-4 py-3 rounded-xl text-base font-bold transition {{ Route::is('gallery') ? 'bg-secondary/5 text-secondary' : 'text-gray-600 hover:bg-gray-50' }}">
                    Galeri
                </a>
                <a href="{{ route('about') }}" class="px-4 py-3 rounded-xl text-base font-bold transition {{ Route::is('about') ? 'bg-secondary/5 text-secondary' : 'text-gray-600 hover:bg-gray-50' }}">
                    Tentang
                </a>
                <a href="{{ route('contact.index') }}" class="px-4 py-3 rounded-xl text-base font-bold transition {{ Route::is('contact.*') ? 'bg-secondary/5 text-secondary' : 'text-gray-600 hover:bg-gray-50' }}">
                    Kontak
                </a>
                @guest
                    <hr class="my-2 border-gray-100">
                    <div class="grid grid-cols-2 gap-3 p-2">
                        <a href="{{ route('login') }}" class="btn-secondary text-center text-sm py-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary text-center text-sm py-2">Daftar</a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</header>
        <div id="mobile-menu" class="hidden md:hidden pb-6 animate-fade-in">
            <div class="flex flex-col space-y-4 pt-2 border-t border-gray-100">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 @if(Route::is('home')) !text-secondary @endif">Home</a>
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 @if(Route::is('products.*')) !text-secondary @endif">Produk</a>
                <a href="{{ route('collections.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 @if(Route::is('collections.*')) !text-secondary @endif">Koleksi</a>
                <a href="{{ route('gallery') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 @if(Route::is('gallery')) !text-secondary @endif">Galeri</a>
                <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 @if(Route::is('about')) !text-secondary @endif">Tentang</a>
                <a href="{{ route('contact.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 @if(Route::is('contact.*')) !text-secondary @endif">Kontak</a>
            </div>
        </div>
    </nav>
</header>
