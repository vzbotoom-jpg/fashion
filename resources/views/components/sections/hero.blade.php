<!-- Hero Section -->
<section class="relative bg-white overflow-hidden hero-section">
    <!-- Background Pattern/Decoration -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[600px] h-[600px] bg-primary-light rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-[400px] h-[400px] bg-primary/10 rounded-full blur-3xl opacity-30"></div>
    </div>

    <div class="container-custom relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-16 md:py-24 lg:py-32">
            <!-- Left Content -->
            <div class="space-y-8 max-w-2xl animate-fade-in">
                <div class="space-y-4">
                    <span class="eyebrow">✨ Koleksi Eksklusif 2025</span>
                    <h1 class="text-4xl md:text-5xl lg:text-7xl font-display font-extrabold text-gray-900 leading-[1.1] tracking-tight">
                        Fashion <span class="text-secondary italic">Custom</span> Sesuai Gaya Anda
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 leading-relaxed max-w-xl">
                        Dapatkan fashion dengan ukuran yang pas dan desain yang benar-benar mewakili diri Anda. Kami hadir untuk mewujudkan pakaian impian Anda.
                    </p>
                </div>

                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('products.index') }}" class="btn-primary btn-lg flex items-center gap-2 group">
                        Lihat Koleksi
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('customer.custom-order.create') }}" class="btn-secondary btn-lg flex items-center gap-2">
                        Mulai Custom Order
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 mt-16 pt-8 border-t border-gray-100">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">100+</p>
                        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Produk</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">500+</p>
                        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Pelanggan</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">98%</p>
                        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Kepuasan</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Content (Visual) -->
            <div class="relative hidden lg:block animate-slide-up">
                <div class="relative z-10 bg-gray-50 rounded-2xl p-4 overflow-hidden border border-gray-100 shadow-xl">
                    <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Fashion Show" class="rounded-xl w-full h-auto object-cover">
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-secondary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-primary/5 rounded-full blur-3xl"></div>

                <!-- Floating Info Card -->
                <div class="absolute -bottom-6 -left-10 z-20 bg-white p-6 rounded-2xl shadow-2xl border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-3">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=1" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=2" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=3" alt="">
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">500+ Pelanggan</p>
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <span class="text-xs text-gray-500 font-medium">Puas dengan hasilnya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
