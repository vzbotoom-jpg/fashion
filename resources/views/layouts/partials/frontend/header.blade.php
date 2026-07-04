<header
    class="bg-white sticky top-0 z-50 border-b border-gray-100 transition-all duration-300"
    x-data="{
        isMobileMenuOpen: false,
        isScrolled: false
    }"
    x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 10 })"
    :class="{ 'py-0 shadow-sm': isScrolled, 'py-1 md:py-2': !isScrolled }"
>
    <nav class="container-custom">
        <div class="flex items-center justify-between h-16 md:h-20 transition-all duration-300" :class="{ 'h-14 md:h-16': isScrolled, 'h-16 md:h-20': !isScrolled }">
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
                <a href="{{ route('home') }}" class="text-sm font-medium transition-all duration-300 relative group {{ Route::is('home') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                    Home
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('home') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <a href="{{ route('products.index') }}" class="text-sm font-medium transition-all duration-300 relative group {{ Route::is('products.*') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                    Produk
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('products.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <a href="{{ route('collections.index') }}" class="text-sm font-medium transition-all duration-300 relative group {{ Route::is('collections.*') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                    Koleksi
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('collections.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <a href="{{ route('gallery') }}" class="text-sm font-medium transition-all duration-300 relative group {{ Route::is('gallery') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                    Galeri
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('gallery') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <a href="{{ route('about') }}" class="text-sm font-medium transition-all duration-300 relative group {{ Route::is('about') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                    Tentang
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('about') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <a href="{{ route('contact.index') }}" class="text-sm font-medium transition-all duration-300 relative group {{ Route::is('contact.*') ? 'text-secondary' : 'text-gray-600 hover:text-secondary' }}">
                    Kontak
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary transform transition-transform duration-300 {{ Route::is('contact.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
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
                                
                                <!-- Pesanan Saya - SVG -->
                                <a href="{{ route('customer.orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition" role="menuitem">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    Pesanan Saya
                                </a>

                                <!-- Profil - SVG -->
                                <a href="{{ route('customer.profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profil
                                </a>

                                <div class="border-t border-gray-100 my-1"></div>

                                <!-- Logout - SVG -->
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-gray-50 transition">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Admin Menu -->
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-secondary transition">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700 ml-4">Logout</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary !py-2 !px-5 !text-sm">Daftar</a>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" x-show="isMobileMenuOpen" @click.away="isMobileMenuOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden pb-6">
            <div class="flex flex-col space-y-4 pt-2 border-t border-gray-100">
                <a href="{{ route('home') }}" class="text-sm font-medium {{ Route::is('home') ? 'text-secondary' : 'text-gray-600' }}">Home</a>
                <a href="{{ route('products.index') }}" class="text-sm font-medium {{ Route::is('products.*') ? 'text-secondary' : 'text-gray-600' }}">Produk</a>
                <a href="{{ route('collections.index') }}" class="text-sm font-medium {{ Route::is('collections.*') ? 'text-secondary' : 'text-gray-600' }}">Koleksi</a>
                <a href="{{ route('gallery') }}" class="text-sm font-medium {{ Route::is('gallery') ? 'text-secondary' : 'text-gray-600' }}">Galeri</a>
                <a href="{{ route('about') }}" class="text-sm font-medium {{ Route::is('about') ? 'text-secondary' : 'text-gray-600' }}">Tentang</a>
                <a href="{{ route('contact.index') }}" class="text-sm font-medium {{ Route::is('contact.*') ? 'text-secondary' : 'text-gray-600' }}">Kontak</a>
                @guest
                    <div class="pt-4 border-t border-gray-100 flex flex-col space-y-3">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary !py-2 text-center text-sm">Daftar</a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</header>