/**
 * Pre-Order JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // ===== PRE-ORDER FORM =====
    const preOrderForm = document.getElementById('pre-order-form');
    if (preOrderForm) {
        // ===== SIZE SELECTION =====
        const sizeOptions = preOrderForm.querySelectorAll('[data-size-option]');
        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                const sizeId = this.dataset.size;
                const hiddenInput = document.getElementById('selected-size');
                if (hiddenInput) {
                    hiddenInput.value = sizeId;
                }

                // Update UI
                sizeOptions.forEach(btn => {
                    btn.classList.remove('border-primary', 'bg-primary/5', 'ring-2', 'ring-primary');
                    btn.querySelector('span').classList.remove('text-primary');
                });
                this.classList.add('border-primary', 'bg-primary/5', 'ring-2', 'ring-primary');
                this.querySelector('span').classList.add('text-primary');
            });
        });

        // ===== QUANTITY CONTROLS =====
        const qtyInput = document.getElementById('quantity');
        const qtyMinus = document.getElementById('qty-minus');
        const qtyPlus = document.getElementById('qty-plus');

        if (qtyInput && qtyMinus && qtyPlus) {
            qtyMinus.addEventListener('click', function() {
                let val = parseInt(qtyInput.value) || 1;
                if (val > 1) {
                    qtyInput.value = val - 1;
                    updateTotal();
                }
            });

            qtyPlus.addEventListener('click', function() {
                let val = parseInt(qtyInput.value) || 1;
                const max = parseInt(qtyInput.max) || 10;
                if (val < max) {
                    qtyInput.value = val + 1;
                    updateTotal();
                }
            });

            qtyInput.addEventListener('change', function() {
                let val = parseInt(this.value) || 1;
                const min = parseInt(this.min) || 1;
                const max = parseInt(this.max) || 10;
                if (val < min) this.value = min;
                if (val > max) this.value = max;
                updateTotal();
            });
        }

        // ===== UPDATE TOTAL =====
        function updateTotal() {
            const priceElement = document.getElementById('product-price');
            const totalElement = document.getElementById('total-price');
            const qty = parseInt(document.getElementById('quantity')?.value) || 1;
            
            if (priceElement && totalElement) {
                const price = parseInt(priceElement.dataset.price) || 0;
                const total = price * qty;
                totalElement.textContent = formatCurrency(total);
            }
        }

        // ===== FORM VALIDATION =====
        preOrderForm.addEventListener('submit', function(e) {
            const size = document.getElementById('selected-size')?.value;
            if (!size) {
                e.preventDefault();
                showToast('Silahkan pilih ukuran terlebih dahulu', 'warning');
                return;
            }

            const phone = this.querySelector('[name="phone"]')?.value;
            if (phone && !isValidPhone(phone)) {
                e.preventDefault();
                showToast('Nomor telepon tidak valid', 'error');
                return;
            }
        });
    }

    // ===== SHIPPING ADDRESS AUTO-FILL =====
    const shippingAddress = document.getElementById('shipping-address');
    const useProfileAddress = document.getElementById('use-profile-address');
    
    if (useProfileAddress && shippingAddress) {
        useProfileAddress.addEventListener('change', function() {
            if (this.checked) {
                const profileAddress = this.dataset.profileAddress;
                if (profileAddress) {
                    shippingAddress.value = profileAddress;
                }
            }
        });
    }
});

// ===== HELPER FUNCTIONS =====
function formatCurrency(amount) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
}

function isValidPhone(phone) {
    // Simple phone validation
    const phoneRegex = /^[0-9+\-\s()]{10,15}$/;
    return phoneRegex.test(phone);
}