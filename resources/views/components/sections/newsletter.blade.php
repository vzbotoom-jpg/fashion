<section class="newsletter-section">
    <div class="container-custom text-center">
        <h2 class="newsletter-title flex items-center justify-center gap-3">
            <!-- Envelope Icon -->
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Newsletter
        </h2>
        <p class="newsletter-subtitle">
            Dapatkan informasi produk terbaru dan promo menarik dari kami!
        </p>
        <form action="#" method="POST" class="newsletter-form">
            @csrf
            <input type="email" name="email" placeholder="Masukkan email Anda" required
                   class="newsletter-input">
            <button type="submit" class="newsletter-btn flex items-center justify-center gap-2">
                <!-- Send Icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Subscribe
            </button>
        </form>
    </div>
</section>