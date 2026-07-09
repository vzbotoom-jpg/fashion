<footer class="site-footer bg-gray-50 border-t border-gray-100">
    <div class="container-custom py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-12">
            <!-- Brand -->
            <div class="space-y-6">
                <h3 class="text-xl font-display font-bold text-gray-900">
                    {{ config('app.name', 'Fashion') }}
                </h3>
                <p class="text-sm leading-relaxed text-gray-600 max-w-xs">
                    Fashion custom sesuai keinginan Anda. Pre-order dengan ukuran yang pas dan model yang Anda inginkan untuk gaya yang lebih personal.
                </p>
                <div class="flex items-center space-x-4">
                    <!-- Twitter -->
                    <a href="#" class="text-gray-400 hover:text-gray-900 transition" aria-label="Twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="text-gray-400 hover:text-gray-900 transition" aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.163 6.163 0 100 12.326 6.163 6.163 0 000-12.326zm0 10.162a3.999 3.999 0 110-7.998 3.999 3.999 0 010 7.998zm6.406-10.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <!-- Facebook -->
                    <a href="#" class="text-gray-400 hover:text-gray-900 transition" aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <!-- YouTube -->
                    <a href="#" class="text-gray-400 hover:text-gray-900 transition" aria-label="YouTube">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Shop -->
            <div>
                <h4 class="text-gray-900 font-bold text-sm mb-6 uppercase tracking-wider">Toko</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Semua Produk</a></li>
                    <li><a href="{{ route('collections.index') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Koleksi Terbaru</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Galeri Inspirasi</a></li>
                </ul>
            </div>

            <!-- Information -->
            <div>
                <h4 class="text-gray-900 font-bold text-sm mb-6 uppercase tracking-wider">Informasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('about') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Kontak Kami</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('terms') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <!-- Contact & Account -->
            <div>
                <h4 class="text-gray-900 font-bold text-sm mb-6 uppercase tracking-wider">Akun & Dukungan</h4>
                <ul class="space-y-4">
                    @auth
                        @if(auth()->user()->role === 'customer')
                            <li><a href="{{ route('customer.orders.index') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Pesanan Saya</a></li>
                            <li><a href="{{ route('customer.profile.edit') }}" class="text-sm text-gray-600 hover:text-secondary transition-colors">Profil Saya</a></li>
                        @endif
                    @endauth
                    <li class="flex items-center space-x-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>0812-3456-7890</span>
                    </li>
                    <li class="flex items-center space-x-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>hello@fashion.id</span>
                    </li>
                    <li class="flex items-center space-x-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        <span>Senin - Sabtu, 09:00 - 21:00</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Newsletter Section (Tambahan) -->
        <div class="py-8 border-t border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Subscribe Newsletter</h4>
                    <p class="text-sm text-gray-600 mt-1">Dapatkan promo dan info terbaru</p>
                </div>
                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <input type="email" placeholder="Masukkan email Anda" class="form-input !py-2.5 !text-sm w-full sm:w-64" required>
                    <button type="submit" class="btn-primary !py-2.5 !px-6 !text-sm whitespace-nowrap">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-6 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
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