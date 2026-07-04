<!-- Footer -->
<footer class="bg-secondary text-white pt-20 pb-10">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Brand -->
            <div class="space-y-6">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-display font-bold tracking-tight text-white">
                        {{ config('app.name', 'Fashion') }}
                    </span>
                </a>
                <p class="text-gray-400 leading-relaxed">
                    Wujudkan pakaian impian Anda dengan kualitas premium dan ukuran yang presisi. Kami bangga menjadi bagian dari perjalanan fashion Anda.
                </p>
                <!-- Social Media -->
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center hover:bg-primary transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center hover:bg-primary transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
                        </svg>
=======
<footer class="site-footer">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-16">
            <!-- Brand -->
            <div class="space-y-6">
                <h3 class="text-xl font-display font-bold text-gray-900">
                    {{ config('app.name', 'Fashion') }}
                </h3>
                <p class="text-sm leading-relaxed text-gray-600 max-w-xs">
                    Fashion custom sesuai keinginan Anda. Pre-order dengan ukuran yang pas dan model yang Anda inginkan untuk gaya yang lebih personal.
                </p>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gray-900 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Shop -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6 uppercase tracking-wider">Toko</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-primary transition-colors">Semua Produk</a></li>
                    <li><a href="{{ route('collections.index') }}" class="text-gray-400 hover:text-primary transition-colors">Koleksi Terbaru</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-gray-400 hover:text-primary transition-colors">Galeri Inspirasi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Paling Laris</a></li>
                </ul>
            </div>

            <!-- Information -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6 uppercase tracking-wider">Informasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-primary transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-gray-400 hover:text-primary transition-colors">Kontak Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Cara Pemesanan</a></li>
                </ul>
            </div>

            <!-- Contact Us -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6 uppercase tracking-wider">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-primary/20 text-primary rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-gray-400">Jl. Fashion No. 123, Jakarta Selatan, 12345</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-primary/20 text-primary rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <span class="text-gray-400">0812-3456-7890</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-primary/20 text-primary rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-gray-400">hello@fashion.id</span>
=======
                <h4>Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Produk</a></li>
                    <li><a href="{{ route('collections.index') }}">Koleksi</a></li>
                    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Support Links -->
            <div>
                <h4>Dukungan</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('contact.index') }}">Kontak Kami</a></li>
                    <li><a href="#">Cara Pre-Order</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4>Kontak</h4>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>0812-3456-7890</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>hello@fashion.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-6">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Fashion') }}. Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-6">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="h-4 opacity-50 hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-4 opacity-50 hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-6 opacity-50 hover:opacity-100 transition-opacity">
=======
        <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p class="text-xs text-gray-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'Fashion') }}. All rights reserved.
            </p>
            <div class="flex items-center space-x-6">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="h-4 opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-3 opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-4 opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition">
            </div>
        </div>
    </div>
</footer>
