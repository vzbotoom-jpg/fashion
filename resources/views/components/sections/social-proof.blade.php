@props([
    'count' => 500,
    'icon' => '🌟',
])

<div class="social-proof">
    <div class="container-custom">
        <div class="flex flex-wrap items-center justify-center gap-8 text-center">
            <div class="social-proof-item">
                <!-- Star Icon -->
                <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <div>
                    <p class="social-proof-value">{{ $count }}+</p>
                    <p class="social-proof-label">Pelanggan Puas</p>
                </div>
            </div>
            
            <div class="hidden sm:block w-px h-12 bg-white/10"></div>
            
            <div class="social-proof-item">
                <!-- Star Rating Icon -->
                <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <div>
                    <p class="social-proof-value">4.9/5</p>
                    <p class="social-proof-label">Rating Pelanggan</p>
                </div>
            </div>
            
            <div class="hidden sm:block w-px h-12 bg-white/10"></div>
            
            <div class="social-proof-item">
                <!-- Package Icon -->
                <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <div>
                    <p class="social-proof-value">1000+</p>
                    <p class="social-proof-label">Pesanan Terkirim</p>
                </div>
            </div>
        </div>
    </div>
</div>