<section class="py-16 md:py-24 bg-white">
    <div class="container-custom">
        <div class="bg-primary rounded-2xl p-8 md:p-16 text-center text-white overflow-hidden relative">
            <!-- Decorative circle -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white/5 rounded-full"></div>

            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="text-secondary text-xs font-bold uppercase tracking-widest mb-4 block">Newsletter</span>
                <h2 class="text-3xl md:text-5xl font-display font-bold mb-6">Dapatkan Koleksi Terbaru</h2>
                <p class="text-gray-400 mb-10 text-lg">
                    Daftar sekarang untuk mendapatkan informasi produk terbaru, koleksi eksklusif, dan penawaran menarik langsung di email Anda.
                </p>

                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
                    @csrf
                    <input type="email" name="email" placeholder="Alamat email Anda" required
                           class="flex-1 px-6 py-4 rounded-md bg-white/10 border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all">
                    <button type="submit" class="bg-secondary hover:bg-secondary-dark text-white px-8 py-4 rounded-md font-bold uppercase tracking-widest text-xs transition-colors duration-300">
                        Berlangganan
                    </button>
                </form>
                <p class="mt-6 text-xs text-gray-500">Kami menghargai privasi Anda. Berhenti berlangganan kapan saja.</p>
            </div>
        </div>
    </div>
</section>