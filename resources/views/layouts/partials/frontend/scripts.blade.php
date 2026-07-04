<!-- Frontend Scripts -->
<script>
    /**
     * Alpine.js initialization
     * Handles global app state and mobile menu
     */
    document.addEventListener('alpine:init', () => {
        // Global Alpine store
        Alpine.store('app', {
            cartCount: {{ auth()->check() ? \App\Services\CartService::getCartCount(auth()->id()) : 0 }},
            isMobileMenuOpen: false,
            
            toggleMobileMenu() {
                this.isMobileMenuOpen = !this.isMobileMenuOpen;
            },
            
            closeMobileMenu() {
                this.isMobileMenuOpen = false;
            },
            
            updateCartCount(count) {
                this.cartCount = count;
            }
        });
    });
</script>

<!-- Global JavaScript -->
<script>
    // Global configuration
    window.appConfig = {
        appName: '{{ config('app.name') }}',
        appUrl: '{{ config('app.url') }}',
        currency: '{{ config('app.currency', 'IDR') }}',
        csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    
    /**
     * Toast notification helper
     * Displays a temporary message to the user
     */
    window.showToast = function(message, type = 'success') {
        const colors = {
            success: 'bg-primary',
            error: 'bg-danger',
            warning: 'bg-warning',
            info: 'bg-info'
        };
        
        const toast = document.createElement('div');
        toast.className = `fixed top-24 right-4 z-[100] ${colors[type] || colors.info} text-white px-6 py-4 rounded-xl shadow-2xl transition-all duration-500 transform translate-x-[150%] border border-white/20 backdrop-blur-sm flex items-center gap-3`;

        // Icon based on type
        let icon = '';
        if (type === 'success') icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
        else if (type === 'error') icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';

        toast.innerHTML = `${icon}<span class="font-bold">${message}</span>`;
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-[150%]');
        }, 100);
        
        // Animate out and remove
        setTimeout(() => {
            toast.classList.add('translate-x-[150%]');
            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 4000);
    };

    /**
     * Add to Cart helper
     * Sends a POST request to add a product to the cart
     */
    window.addToCart = function(productId, sizeId = null) {
        if (!sizeId) {
            // Check if there is a size selector in the DOM for this product
            const sizeSelect = document.querySelector(`#size-${productId}`);
            if (sizeSelect) sizeId = sizeSelect.value;
        }

        fetch('{{ route("customer.cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.appConfig.csrfToken
            },
            body: JSON.stringify({
                product_id: productId,
                size_id: sizeId,
                quantity: 1
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.showToast(data.message, 'success');
                // Update cart count in Alpine store
                if (window.Alpine) {
                    Alpine.store('app').updateCartCount(data.cart_count);
                }
            } else {
                window.showToast(data.message || 'Gagal menambahkan ke keranjang', 'error');
            }
        })
        .catch(error => {
            window.showToast('Terjadi kesalahan sistem', 'error');
            console.error('Add to Cart Error:', error);
        });
    };
    
    /**
     * Image Lazy Loading initialization
     */
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    });
</script>

<!-- Page specific scripts -->
@stack('scripts')
