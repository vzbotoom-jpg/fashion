/**
 * Checkout JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // ===== PAYMENT METHOD SELECTION =====
    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
        input.addEventListener('change', function() {
            const method = this.value;
            const detailsContainer = document.getElementById('payment-details');
            
            if (!detailsContainer) return;

            // Show/hide payment details based on method
            const details = {
                'bank_transfer': `
                    <div class="bg-blue-50 p-4 rounded-lg mt-3">
                        <p class="text-sm font-medium text-blue-800 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Transfer Bank
                        </p>
                        <p class="text-sm text-blue-700 mt-1">
                            Silahkan transfer ke rekening berikut:
                            <br><strong>Bank:</strong> ${window.bankTransferAccount || 'BCA'}
                            <br><strong>No. Rekening:</strong> ${window.bankTransferNumber || '1234567890'}
                            <br><strong>Atas Nama:</strong> ${window.bankTransferName || 'Fashion Pre-Order Store'}
                        </p>
                        <p class="text-xs text-blue-600 mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Transfer sesuai dengan total yang tertera. Upload bukti transfer setelah melakukan pembayaran.
                        </p>
                    </div>
                `,
                'credit_card': `
                    <div class="bg-blue-50 p-4 rounded-lg mt-3">
                        <p class="text-sm font-medium text-blue-800 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Kartu Kredit
                        </p>
                        <p class="text-sm text-blue-700 mt-1">
                            Pembayaran akan diproses melalui gateway pembayaran yang aman.
                        </p>
                    </div>
                `,
                'e_wallet': `
                    <div class="bg-blue-50 p-4 rounded-lg mt-3">
                        <p class="text-sm font-medium text-blue-800 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 10.5h1.5m-1.5 3h1.5m-1.5 3h1.5m2.25-9h6A2.25 2.25 0 0116.5 6.75v9A2.25 2.25 0 0114.25 18h-6A2.25 2.25 0 016 15.75v-9A2.25 2.25 0 018.25 4.5z"/>
                            </svg>
                            E-Wallet
                        </p>
                        <p class="text-sm text-blue-700 mt-1">
                            Pembayaran akan diproses melalui e-wallet pilihan Anda.
                        </p>
                    </div>
                `
            };

            detailsContainer.innerHTML = details[method] || '';
        });
    });

    // ===== FORM VALIDATION =====
    const checkoutForm = document.getElementById('checkout-form');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500', 'ring-2', 'ring-red-500');
                    
                    const errorMsg = document.createElement('p');
                    errorMsg.className = 'text-xs text-red-500 mt-1';
                    errorMsg.textContent = 'Field ini wajib diisi';
                    
                    const parent = field.parentElement;
                    const existingError = parent.querySelector('.text-red-500.text-xs');
                    if (!existingError) {
                        parent.appendChild(errorMsg);
                    }
                } else {
                    field.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
                    const parent = field.parentElement;
                    const existingError = parent.querySelector('.text-red-500.text-xs');
                    if (existingError) {
                        existingError.remove();
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                showToast('Mohon lengkapi semua field yang wajib diisi', 'error');
            }
        });
    }

    // ===== COUPON CODE =====
    document.getElementById('apply-coupon')?.addEventListener('click', function() {
        const couponInput = document.getElementById('coupon-code');
        if (!couponInput) return;

        const code = couponInput.value.trim();
        if (!code) {
            showToast('Masukkan kode kupon', 'warning');
            return;
        }

        fetch('/checkout/apply-coupon', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ code })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                window.location.reload();
            } else {
                showToast(data.message || 'Kode kupon tidak valid', 'error');
            }
        })
        .catch(error => {
            showToast('Terjadi kesalahan', 'error');
            console.error('Error:', error);
        });
    });
});