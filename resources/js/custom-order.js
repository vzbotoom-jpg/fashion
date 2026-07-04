/**
 * Custom Order JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // ===== CUSTOM ORDER FORM =====
    const customOrderForm = document.getElementById('custom-order-form');
    if (customOrderForm) {
        // ===== SIZE SELECTION =====
        const sizeOptions = customOrderForm.querySelectorAll('[data-size-option]');
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

        // ===== IMAGE PREVIEW =====
        const imageInput = document.getElementById('custom-image');
        const imagePreview = document.getElementById('image-preview');
        
        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) {
                    imagePreview.innerHTML = '';
                    return;
                }

                // Validate file size
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    showToast('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
                    this.value = '';
                    imagePreview.innerHTML = '';
                    return;
                }

                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    showToast('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.', 'error');
                    this.value = '';
                    imagePreview.innerHTML = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `
                        <div class="relative inline-block">
                            <img src="${e.target.result}" alt="Custom image preview" class="w-32 h-32 object-cover rounded-lg border-2 border-primary">
                            <button onclick="removeCustomImage()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                ×
                            </button>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            });
        }

        // ===== QUANTITY CONTROLS =====
        const qtyInput = document.getElementById('quantity');
        const qtyMinus = document.getElementById('qty-minus');
        const qtyPlus = document.getElementById('qty-plus');

        if (qtyInput && qtyMinus && qtyPlus) {
            qtyMinus.addEventListener('click', function() {
                let val = parseInt(qtyInput.value) || 1;
                if (val > 1) {
                    qtyInput.value = val - 1;
                }
            });

            qtyPlus.addEventListener('click', function() {
                let val = parseInt(qtyInput.value) || 1;
                const max = parseInt(qtyInput.max) || 10;
                if (val < max) {
                    qtyInput.value = val + 1;
                }
            });
        }

        // ===== CHARACTER COUNTER =====
        const descriptionInput = document.getElementById('custom-description');
        const charCounter = document.getElementById('char-counter');

        if (descriptionInput && charCounter) {
            descriptionInput.addEventListener('input', function() {
                const max = parseInt(this.maxLength) || 1000;
                const current = this.value.length;
                charCounter.textContent = `${current}/${max}`;
                
                if (current > max * 0.9) {
                    charCounter.classList.add('text-red-500');
                } else {
                    charCounter.classList.remove('text-red-500');
                }
            });
        }

        // ===== FORM VALIDATION =====
        customOrderForm.addEventListener('submit', function(e) {
            const size = document.getElementById('selected-size')?.value;
            if (!size) {
                e.preventDefault();
                showToast('Silahkan pilih ukuran terlebih dahulu', 'warning');
                return;
            }

            const description = document.getElementById('custom-description')?.value;
            if (!description || description.trim().length < 10) {
                e.preventDefault();
                showToast('Deskripsi custom minimal 10 karakter', 'warning');
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
});

// ===== REMOVE CUSTOM IMAGE =====
window.removeCustomImage = function() {
    const imageInput = document.getElementById('custom-image');
    const imagePreview = document.getElementById('image-preview');
    if (imageInput) {
        imageInput.value = '';
    }
    if (imagePreview) {
        imagePreview.innerHTML = '';
    }
};

// ===== HELPER FUNCTIONS =====
function isValidPhone(phone) {
    const phoneRegex = /^[0-9+\-\s()]{10,15}$/;
    return phoneRegex.test(phone);
}