@props([
    'count' => 500,
])

<section class="py-20 bg-white overflow-hidden">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
            <!-- Satisfied Customers -->
            <div class="group p-8 rounded-3xl bg-gray-50 border border-transparent hover:border-primary/10 hover:bg-white hover:shadow-xl transition-all duration-500 text-center">
                <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-2">
                    {{ $count }}+
                </h3>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-widest">
                    Pelanggan Puas
                </p>
            </div>

            <!-- Rating -->
            <div class="group p-8 rounded-3xl bg-gray-50 border border-transparent hover:border-primary/10 hover:bg-white hover:shadow-xl transition-all duration-500 text-center">
                <div class="w-16 h-16 bg-yellow-50 text-yellow-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <h3 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-2">
                    4.9/5
                </h3>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-widest">
                    Rating Pelanggan
                </p>
            </div>

            <!-- Orders Delivered -->
            <div class="group p-8 rounded-3xl bg-gray-50 border border-transparent hover:border-primary/10 hover:bg-white hover:shadow-xl transition-all duration-500 text-center">
                <div class="w-16 h-16 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h3 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-2">
                    1000+
                </h3>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-widest">
                    Pesanan Terkirim
                </p>
            </div>
        </div>
    </div>
</section>
