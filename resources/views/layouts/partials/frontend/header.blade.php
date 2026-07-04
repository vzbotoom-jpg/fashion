<!-- Header -->
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
            <div class="hidden md:flex items-center space-x-10">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('home')) !text-gray-900 font-semibold @endif">
                    Home
                </a>
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('products.*')) !text-gray-900 font-semibold @endif">
                    Produk
                </a>
                <a href="{{ route('collections.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('collections.*')) !text-gray-900 font-semibold @endif">
                    Koleksi
                </a>
                <a href="{{ route('gallery') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('gallery')) !text-gray-900 font-semibold @endif">
                    Galeri
                </a>
                <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('about')) !text-gray-900 font-semibold @endif">
                    Tentang
                </a>
                <a href="{{ route('contact.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition @if(Route::is('contact.*')) !text-gray-900 font-semibold @endif">
                    Kontak
                </a>
            </div>
            
            <!-- Right Side Actions -->
            <div class="flex items-center space-x-5">
                @auth
                    @if(auth()->user()->role === 'customer')
                        <!-- Mini Cart -->
                        @include('layouts.partials.frontend.mini-cart')
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center group focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-xs font-bold text-gray-700 group-hover:bg-gray-200 transition">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <svg class="w-4 h-4 ml-1.5 text-gray-400 group-hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
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