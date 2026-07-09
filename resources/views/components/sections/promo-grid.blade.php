@props([
    'promos' => [],
])

<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="eyebrow">Promo Spesial</span>
            <h2 class="section-title">Penawaran Terbatas</h2>
            <p class="section-subtitle">Jangan lewatkan promo menarik yang hanya tersedia untuk waktu terbatas</p>
        </div>

        <!-- Promo Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($promos as $promo)
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 hover:-translate-y-2">
                    <!-- Gambar Promo -->
                    <div class="relative h-48 overflow-hidden">
                        @if($promo['image'] ?? false)
                            <img src="{{ asset('storage/' . $promo['image']) }}" 
                                 alt="{{ $promo['title'] ?? 'Promo' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                                <span class="text-6xl">🎉</span>
                            </div>
                        @endif
                        
                        <!-- Badge Diskon -->
                        @if($promo['badge'] ?? false)
                            <span class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-lg">
                                {{ $promo['badge'] }}
                            </span>
                        @endif
                    </div>

                    <!-- Konten -->
                    <div class="p-6">
                        @if($promo['icon'] ?? false)
                            <span class="text-2xl">{{ $promo['icon'] }}</span>
                        @endif
                        
                        <h3 class="text-lg font-bold text-gray-900 mt-2 group-hover:text-primary transition">
                            {{ $promo['title'] ?? 'Promo Spesial' }}
                        </h3>
                        
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                            {{ $promo['description'] ?? '' }}
                        </p>

                        <!-- CTA -->
                        <div class="mt-4 flex items-center justify-between">
                            @if($promo['price'] ?? false)
                                <div>
                                    <span class="text-xs text-gray-400 line-through">
                                        Rp {{ number_format($promo['original_price'] ?? 0, 0, ',', '.') }}
                                    </span>
                                    <span class="text-lg font-bold text-primary ml-2">
                                        Rp {{ number_format($promo['price'], 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif
                            <a href="{{ $promo['link'] ?? '#' }}" 
                               class="btn-primary !py-2 !px-5 !text-sm rounded-lg flex items-center gap-2 group">
                                {{ $promo['link_text'] ?? 'Lihat Promo' }}
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Countdown Timer (Opsional) -->
                        @if($promo['expires_at'] ?? false)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Berakhir: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($promo['expires_at'])->format('d M Y') }}</span></span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Default Promo -->
                <div class="col-span-full">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Promo 1 -->
                        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl p-8 text-center border border-primary/10">
                            <span class="text-5xl block mb-4">🛍️</span>
                            <h3 class="text-xl font-bold text-gray-800">Diskon 20%</h3>
                            <p class="text-gray-500 text-sm mt-2">Untuk pembelian pertama Anda</p>
                            <a href="{{ route('products.index') }}" class="btn-primary mt-4 inline-block text-sm">Belanja Sekarang</a>
                        </div>
                        <!-- Promo 2 -->
                        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl p-8 text-center border border-primary/10">
                            <span class="text-5xl block mb-4">🚚</span>
                            <h3 class="text-xl font-bold text-gray-800">Gratis Ongkir</h3>
                            <p class="text-gray-500 text-sm mt-2">Minimal belanja Rp 500.000</p>
                            <a href="{{ route('products.index') }}" class="btn-primary mt-4 inline-block text-sm">Belanja Sekarang</a>
                        </div>
                        <!-- Promo 3 -->
                        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl p-8 text-center border border-primary/10">
                            <span class="text-5xl block mb-4">🎁</span>
                            <h3 class="text-xl font-bold text-gray-800">Hadiah Spesial</h3>
                            <p class="text-gray-500 text-sm mt-2">Untuk setiap pembelian di atas Rp 1.000.000</p>
                            <a href="{{ route('products.index') }}" class="btn-primary mt-4 inline-block text-sm">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>