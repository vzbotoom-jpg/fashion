<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-200/70">
    <nav class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-display font-bold text-primary">
                        {{ config('app.name', 'Fashion') }}
                    </span>
                </a>
            </div>
            
            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary transition @if(Route::is('home')) text-primary font-semibold @endif">
                    Home
                </a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-primary transition @if(Route::is('products.*')) text-primary font-semibold @endif">
                    Produk
                </a>
                <a href="{{ route('collections.index') }}" class="text-gray-700 hover:text-primary transition @if(Route::is('collections.*')) text-primary font-semibold @endif">
                    Koleksi
                </a>
                <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-primary transition @if(Route::is('gallery')) text-primary font-semibold @endif">
                    Galeri
                </a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary transition @if(Route::is('about')) text-primary font-semibold @endif">
                    Tentang
                </a>
                <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-primary transition @if(Route::is('contact.*')) text-primary font-semibold @endif">
                    Kontak
                </a>
            </div>
            
            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Customer Menu -->
                    @if(auth()->user()->role === 'customer')
                        <!-- Mini Cart -->
                        @include('layouts.partials.frontend.mini-cart')
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-semibold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm text-gray-700 hidden md:block">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50">
                                <a href="{{ route('customer.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    📦 Pesanan Saya
                                </a>
                                <a href="{{ route('customer.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    👤 Profil
                                </a>
                                <hr class="my-1">
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        🚪 Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Admin Menu -->
                        <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 hover:text-primary">
                            Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                Logout
                            </button>
                        </form>
                    @endif
                @else
                    <!-- Guest Menu -->
                    <a href="{{ route('login') }}" class="btn-secondary text-sm px-4 py-2">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm px-4 py-2">
                        Daftar
                    </a>
                @endauth
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-toggle" class="md:hidden text-gray-700 hover:text-primary">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-3 pt-3 border-t border-gray-200">
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-primary @if(Route::is('home')) text-primary font-semibold @endif">
                Home
            </a>
            <a href="{{ route('products.index') }}" class="block py-2 text-gray-700 hover:text-primary @if(Route::is('products.*')) text-primary font-semibold @endif">
                Produk
            </a>
            <a href="{{ route('collections.index') }}" class="block py-2 text-gray-700 hover:text-primary @if(Route::is('collections.*')) text-primary font-semibold @endif">
                Koleksi
            </a>
            <a href="{{ route('gallery') }}" class="block py-2 text-gray-700 hover:text-primary @if(Route::is('gallery')) text-primary font-semibold @endif">
                Galeri
            </a>
            <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-primary @if(Route::is('about')) text-primary font-semibold @endif">
                Tentang
            </a>
            <a href="{{ route('contact.index') }}" class="block py-2 text-gray-700 hover:text-primary @if(Route::is('contact.*')) text-primary font-semibold @endif">
                Kontak
            </a>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>