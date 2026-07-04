<!-- Frontend Scripts -->
<script>
    // Alpine.js initialization (if using Alpine)
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
    // CSRF Token setup for AJAX
    window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Global configuration
    window.config = {
        appName: '{{ config('app.name') }}',
        appUrl: '{{ config('app.url') }}',
        currency: '{{ config('app.currency', 'IDR') }}',
    };
    
    // Toast notification helper
    window.showToast = function(message, type = 'success') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500',
            info: 'bg-blue-500'
        };
        
        const toast = document.createElement('div');
        toast.className = `fixed top-20 right-4 z-50 ${colors[type] || colors.info} text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);
        
        // Animate out and remove
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    };
    
    // Lazy loading images
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