<!-- Hero Section -->
<section class="hero-section py-16 md:py-32">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="animate-fade-in">
                <span class="eyebrow">Eksklusif & Berkualitas</span>
                <h1 class="hero-title mb-6">
                    Fashion Custom <br>
                    <span class="text-secondary">Sesuai Keinginan</span> Anda
                </h1>
                <p class="hero-subtitle mb-10">
                    Dapatkan fashion dengan ukuran yang pas dan model yang Anda inginkan. 
                    Pre-order atau custom order sekarang untuk gaya yang lebih personal.
                </p>
                <div class="hero-cta-group">
                    <a href="{{ route('products.index') }}" class="hero-cta-primary">
                        Lihat Koleksi
                    </a>
                    <a href="{{ route('customer.custom-order.create') }}" class="hero-cta-secondary">
                        Custom Order
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
            </div>
        </div>
    </div>
</section>