<!-- Hero Section -->
<section class="relative bg-white overflow-hidden">
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
                        Fashion <span class="text-primary italic">Custom</span> Sesuai Gaya Anda
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
                
                <!-- Trust Badges -->
                <div class="flex flex-wrap items-center gap-6 pt-8 border-t border-gray-100">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Premium Quality</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Pengerjaan Cepat</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Garansi Ukuran</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Content (Product Showcase) -->
            <div class="hidden lg:block relative">
                <div class="relative z-10 grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden shadow-2xl transform -rotate-3 hover:rotate-0 transition-transform duration-500">
                            <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fashion 1" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-square rounded-2xl overflow-hidden shadow-xl transform rotate-2 hover:rotate-0 transition-transform duration-500">
                            <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fashion 2" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="space-y-4 pt-12">
                        <div class="aspect-square rounded-2xl overflow-hidden shadow-xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                            <img src="https://images.unsplash.com/photo-1496747611176-843222e1e57c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fashion 3" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden shadow-2xl transform -rotate-2 hover:rotate-0 transition-transform duration-500">
                            <img src="https://images.unsplash.com/photo-1550614000-4895a10e1bfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fashion 4" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Floating Info Card -->
                <div class="absolute -bottom-6 -left-10 z-20 bg-white p-6 rounded-2xl shadow-2xl border border-gray-100 animate-bounce-slow">
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
