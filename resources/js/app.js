/**
 * Main Application JavaScript
 */

import Alpine from 'alpinejs';
import './bootstrap';
import './frontend';

// ===== ALPINE.JS =====
window.Alpine = Alpine;

// Global Alpine Store
Alpine.store('app', {
    cartCount: 0,
    isMobileMenuOpen: false,
    isSearchOpen: false,

    init() {
        this.updateCartCount();
    },

    toggleMobileMenu() {
        this.isMobileMenuOpen = !this.isMobileMenuOpen;
    },

    closeMobileMenu() {
        this.isMobileMenuOpen = false;
    },

    toggleSearch() {
        this.isSearchOpen = !this.isSearchOpen;
    },

    updateCartCount() {
        fetch('/api/cart/count', {
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                this.cartCount = data.count || 0;
            })
            .catch(error => {
                console.error('Error fetching cart count:', error);
            });
    },

    addToCart(productId, sizeId, quantity = 1) {
        fetch('/api/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId, size_id: sizeId, quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.cartCount = data.cart_count;
                showToast(data.message, 'success');
            } else {
                showToast(data.message || 'Gagal menambahkan ke keranjang', 'error');
            }
        })
        .catch(error => {
            showToast('Terjadi kesalahan', 'error');
            console.error('Error:', error);
        });
    }
});

// ===== TOAST SYSTEM =====
window.showToast = function(message, type = 'success') {
    const colors = {
        success: 'bg-green-50 border-green-500 text-green-700',
        error: 'bg-red-50 border-red-500 text-red-700',
        warning: 'bg-yellow-50 border-yellow-500 text-yellow-700',
        info: 'bg-blue-50 border-blue-500 text-blue-700'
    };

    const icons = {
        success: `<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                 </svg>`,
        error: `<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                 </svg>`,
        warning: `<svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                 </svg>`,
        info: `<svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                 </svg>`
    };

    const toast = document.createElement('div');
    toast.className = `fixed top-20 right-4 z-50 max-w-sm w-full border-l-4 rounded-lg shadow-lg ${colors[type] || colors.success} animate-fade-in`;
    toast.innerHTML = `
        <div class="flex items-center p-4">
            <div class="flex-shrink-0">${icons[type] || icons.success}</div>
            <p class="text-sm font-medium flex-1 ml-3">${message}</p>
            <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 ml-3 text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    `;

    document.body.appendChild(toast);

    // Auto dismiss after 5 seconds
    setTimeout(() => {
        toast.style.transition = 'opacity 0.5s';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
    }, 5000);
};

// ===== MOBILE MENU =====
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('mobile-menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        });
    }

    // ===== LAZY LOADING IMAGES =====
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

    // ===== AUTO-DISMISS ALERTS =====
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});

// ===== CSRF TOKEN =====
window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

// ===== START ALPINE =====
Alpine.start();

// ===== EXPOSE FOR DEBUGGING =====
if (window.development) {
    window.app = Alpine.store('app');
}