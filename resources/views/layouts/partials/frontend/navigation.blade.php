<!-- Navigation Links -->
<nav class="hidden md:flex items-center space-x-8">
    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary transition font-medium @if(Route::is('home')) text-primary border-b-2 border-primary @endif">
        Home
    </a>
    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-primary transition font-medium @if(Route::is('products.*')) text-primary border-b-2 border-primary @endif">
        Produk
    </a>
    <a href="{{ route('collections.index') }}" class="text-gray-700 hover:text-primary transition font-medium @if(Route::is('collections.*')) text-primary border-b-2 border-primary @endif">
        Koleksi
    </a>
    <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-primary transition font-medium @if(Route::is('gallery')) text-primary border-b-2 border-primary @endif">
        Galeri
    </a>
    <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary transition font-medium @if(Route::is('about')) text-primary border-b-2 border-primary @endif">
        Tentang
    </a>
    <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-primary transition font-medium @if(Route::is('contact.*')) text-primary border-b-2 border-primary @endif">
        Kontak
    </a>
</nav>