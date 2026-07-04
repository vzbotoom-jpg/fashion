<section class="section-padding bg-primary relative overflow-hidden">
    <!-- Decorative Shapes -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary/10 rounded-full translate-x-1/3 translate-y-1/3"></div>

    <div class="container-custom relative z-10">
        <div class="max-w-4xl mx-auto bg-white p-8 md:p-16 rounded-[2rem] shadow-2xl">
            <div class="text-center space-y-6">
                <div class="w-20 h-20 bg-primary/10 text-primary rounded-3xl flex items-center justify-center mx-auto mb-8 animate-bounce-slow">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="section-title !text-gray-900">Bergabung dengan Newsletter Kami</h2>
                <p class="section-subtitle !text-gray-500 !mt-2 max-w-2xl mx-auto">
                    Dapatkan update koleksi terbaru, tips fashion mingguan, dan diskon eksklusif 10% untuk pesanan pertama Anda.
                </p>

                <form action="#" method="POST" class="mt-10">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                        <input type="email" name="email" placeholder="Alamat email Anda" required
                               class="flex-grow px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        <button type="submit" class="btn-primary !rounded-xl !py-4 px-8 whitespace-nowrap shadow-xl hover:shadow-primary/20">
                            Berlangganan
                        </button>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-4">
                        Dengan mendaftar, Anda menyetujui Kebijakan Privasi dan Syarat & Ketentuan kami.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
