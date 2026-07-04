/**
 * Cart Management JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // ===== UPDATE QUANTITY =====
    document.querySelectorAll('[data-cart-update]').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.cartItem;
            const change = parseInt(this.dataset.cartChange) || 0;
            const qtyElement = document.getElementById(`cart-qty-${itemId}`);
            
            if (!qtyElement) return;
            
            let currentQty = parseInt(qtyElement.textContent);
            let newQty = currentQty + change;
            
            if (newQty < 1) return;
            
            updateCartItem(itemId, newQty);
        });
    });

    // ===== REMOVE ITEM =====
    document.querySelectorAll('[data-cart-remove]').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.cartItem;
            if (confirm('Hapus item dari keranjang?')) {
                removeCartItem(itemId);
            }
        });
    });

    // ===== CLEAR CART =====
    document.querySelector('[data-cart-clear]')?.addEventListener('click', function() {
        if (confirm('Kosongkan semua keranjang?')) {
            clearCart();
        }
    });
});

// ===== UPDATE CART ITEM =====
window.updateCartItem = function(itemId, quantity) {
    fetch(`/cart/update/${itemId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            showToast(data.message || 'Gagal memperbarui keranjang', 'error');
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
        console.error('Error:', error);
    });
};

// ===== REMOVE CART ITEM =====
window.removeCartItem = function(itemId) {
    fetch(`/cart/remove/${itemId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            showToast(data.message || 'Gagal menghapus item', 'error');
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
        console.error('Error:', error);
    });
};

// ===== CLEAR CART =====
window.clearCart = function() {
    fetch('/cart/clear', {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            showToast(data.message || 'Gagal mengosongkan keranjang', 'error');
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
        console.error('Error:', error);
    });
};

// ===== ADD TO CART =====
window.addToCart = function(productId, sizeId, quantity = 1) {
    if (!sizeId) {
        showToast('Silahkan pilih ukuran terlebih dahulu', 'warning');
        return;
    }

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ product_id: productId, size_id: sizeId, quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            // Update cart badge
            const badge = document.getElementById('cart-badge');
            if (badge) {
                badge.textContent = data.cart_count;
            }
        } else {
            showToast(data.message || 'Gagal menambahkan ke keranjang', 'error');
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
        console.error('Error:', error);
    });
};