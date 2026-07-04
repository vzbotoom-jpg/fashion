<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-[#1a1a1a] to-[#000000] text-white overflow-hidden">
    <div class="container mx-auto px-4 py-20 md:py-32">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="space-y-6">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold leading-tight">
                    Fashion <span class="text-secondary">Custom</span> Sesuai Keinginan Anda
                </h1>
                <p class="text-lg md:text-xl text-white/80 leading-relaxed">
                    Dapatkan fashion dengan ukuran yang pas dan model yang Anda inginkan. 
                    Pre-order atau custom order sesuai kebutuhan Anda.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="btn-primary flex items-center gap-2">
                        <!-- Shopping Bag Icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Lihat Produk
                    </a>
                    <a href="{{ route('customer.custom-order.create') }}" class="btn-outline flex items-center gap-2">
                        <!-- Paint Brush Icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Custom Order
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 pt-8">
                    <div>
                        <p class="text-3xl font-bold">100+</p>
                        <p class="text-sm text-white/70">Produk</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold">500+</p>
                        <p class="text-sm text-white/70">Pelanggan</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold">98%</p>
                        <p class="text-sm text-white/70">Kepuasan</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Content (Image) -->
            <div class="hidden md:block">
                <div class="relative">
                    <div class="absolute -inset-4 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-4">
                                <div class="bg-white/10 rounded-xl p-4 text-center">
                                    <!-- Shirt Icon -->
                                    <svg class="w-10 h-10 mx-auto text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <p class="text-sm mt-2">Kaos</p>
                                </div>
                                <div class="bg-white/10 rounded-xl p-4 text-center">
                                    <!-- Coat/Jacket Icon -->
                                    <svg class="w-10 h-10 mx-auto text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <p class="text-sm mt-2">Jaket</p>
                                </div>
                            </div>
                            <div class="space-y-4 mt-8">
                                <div class="bg-white/10 rounded-xl p-4 text-center">
                                    <!-- Dress Icon -->
                                    <svg class="w-10 h-10 mx-auto text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <p class="text-sm mt-2">Gaun</p>
                                </div>
                                <div class="bg-white/10 rounded-xl p-4 text-center">
                                    <!-- Shoe Icon -->
                                    <svg class="w-10 h-10 mx-auto text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-sm mt-2">Sepatu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-white/5 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-secondary/20 rounded-full blur-3xl"></div>
    <div class="absolute top-20 right-20 w-24 h-24 bg-primary-light/20 rounded-full blur-2xl"></div>
</section>