<section class="section-padding bg-gray-50 overflow-hidden">
    <div class="container-custom">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 items-center">
                <!-- Left Column: Content & Form -->
                <div class="p-8 md:p-16 lg:p-20">
                    <div class="max-w-md">
                        <span class="eyebrow">Newsletter</span>
                        <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-4 leading-tight">
                            Dapatkan Koleksi Terbaru
                        </h2>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Daftar sekarang untuk mendapatkan informasi produk terbaru, koleksi eksklusif, dan penawaran menarik langsung di email Anda.
                        </p>

                        <form action="#" method="POST" class="space-y-4">
                            @csrf
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-grow">
                                    <input type="email" name="email" placeholder="Alamat email Anda" required
                                           class="w-full px-4 py-3 bg-white border border-gray-200 rounded-[4px] focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all placeholder-gray-400">
                                </div>
                                <button type="submit" class="bg-[#008060] hover:bg-[#004c3f] text-white px-8 py-3 rounded-[4px] font-bold text-sm uppercase tracking-wider transition-colors duration-300 shadow-sm">
                                    Berlangganan
                                </button>
                            </div>
                            <p class="text-[11px] text-gray-400">
                                Dengan mendaftar, Anda menyetujui Kebijakan Privasi kami. Berhenti berlangganan kapan saja.
                            </p>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Illustration -->
                <div class="hidden lg:block bg-gray-100/50 h-full relative p-20">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full opacity-80">
                        <path fill="#008060" d="M44.7,-76.4C58.1,-69.2,69.2,-58.1,76.4,-44.7C83.7,-31.3,87,-15.7,85.2,-0.9C83.5,13.8,76.7,27.7,68.1,40.1C59.5,52.5,49.1,63.5,36.5,70.9C23.9,78.3,9.1,82.1,-5,81.4C-19.1,80.7,-32.5,75.4,-44.8,67.6C-57.1,59.8,-68.3,49.4,-75.7,36.8C-83.1,24.2,-86.7,9.3,-84.9,-5.1C-83.2,-19.5,-76.2,-33.4,-66.4,-44.6C-56.7,-55.8,-44.2,-64.3,-30.9,-71.5C-17.6,-78.7,-3.5,-84.6,10.6,-83.1C24.7,-81.6,31.3,-83.6,44.7,-76.4Z" transform="translate(100 100)" opacity="0.1" />
                        <rect x="60" y="60" width="80" height="60" rx="4" fill="white" shadow="sm" />
                        <path d="M60 70 L100 95 L140 70" stroke="#008060" stroke-width="2" fill="none" />
                        <circle cx="150" cy="50" r="10" fill="#008060" opacity="0.2" />
                        <circle cx="40" cy="150" r="15" fill="#008060" opacity="0.1" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
