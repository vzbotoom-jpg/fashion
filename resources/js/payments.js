/**
 * Payment JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // ===== PAYMENT VERIFICATION =====
    document.querySelectorAll('[data-payment-verify]').forEach(button => {
        button.addEventListener('click', function() {
            const paymentId = this.dataset.payment;
            const orderId = this.dataset.order;

            if (!paymentId) return;

            if (confirm('Verifikasi pembayaran ini?')) {
                verifyPayment(paymentId, orderId);
            }
        });
    });

    // ===== PAYMENT REFUND =====
    document.querySelectorAll('[data-payment-refund]').forEach(button => {
        button.addEventListener('click', function() {
            const paymentId = this.dataset.payment;
            const orderId = this.dataset.order;

            if (!paymentId) return;

            if (confirm('Yakin ingin refund pembayaran ini?')) {
                refundPayment(paymentId, orderId);
            }
        });
    });

    // ===== UPLOAD PAYMENT PROOF =====
    document.getElementById('payment-proof')?.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            showToast('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
            this.value = '';
            return;
        }

        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            showToast('Format file tidak didukung. Gunakan JPG atau PNG.', 'error');
            this.value = '';
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('proof-preview');
            if (preview) {
                preview.innerHTML = `
                    <div class="relative inline-block">
                        <img src="${e.target.result}" alt="Payment proof" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                        <button onclick="removeProof()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                `;
            }
        };
        reader.readAsDataURL(file);
    });

    // ===== MIDTRANS PAYMENT =====
    if (window.midtrans && window.midtransEnabled) {
        // Setup Midtrans
        window.midtransConfig = {
            snap: window.midtransSnapUrl || 'https://app.midtrans.com/snap/snap.js',
            clientKey: window.midtransClientKey || ''
        };

        // Load Midtrans script
        const script = document.createElement('script');
        script.src = window.midtransConfig.snap;
        script.setAttribute('data-client-key', window.midtransConfig.clientKey);
        document.head.appendChild(script);
    }
});

// ===== VERIFY PAYMENT =====
window.verifyPayment = function(paymentId, orderId) {
    fetch(`/admin/payments/${paymentId}/verify`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1500);
        } else {
            showToast(data.message || 'Gagal verifikasi pembayaran', 'error');
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
        console.error('Error:', error);
    });
};

// ===== REFUND PAYMENT =====
window.refundPayment = function(paymentId, orderId) {
    fetch(`/admin/payments/${paymentId}/refund`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1500);
        } else {
            showToast(data.message || 'Gagal refund pembayaran', 'error');
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
        console.error('Error:', error);
    });
};

// ===== REMOVE PROOF =====
window.removeProof = function() {
    document.getElementById('payment-proof').value = '';
    document.getElementById('proof-preview').innerHTML = '';
};

// ===== MIDTRANS PAYMENT PROCESS =====
window.processMidtransPayment = function(orderId, amount) {
    if (!window.snap) {
        showToast('Gateway pembayaran sedang dimuat, silahkan coba lagi', 'error');
        return;
    }

    const options = {
        transaction_details: {
            order_id: `ORD-${orderId}-${Date.now()}`,
            gross_amount: amount
        },
        customer_details: {
            first_name: window.userName || 'Customer',
            email: window.userEmail || '',
            phone: window.userPhone || ''
        },
        callbacks: {
            onSuccess: function(result) {
                showToast('Pembayaran berhasil!', 'success');
                window.location.href = `/orders/${orderId}/success`;
            },
            onPending: function(result) {
                showToast('Menunggu pembayaran', 'warning');
                window.location.href = `/orders/${orderId}/pending`;
            },
            onError: function(result) {
                showToast('Pembayaran gagal', 'error');
                window.location.href = `/orders/${orderId}/error`;
            },
            onClose: function() {
                showToast('Pembayaran dibatalkan', 'warning');
            }
        }
    };

    window.snap.pay(options);
};