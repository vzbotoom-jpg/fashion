/**
 * Product Filter JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // ===== FILTER FORM =====
    const filterForm = document.querySelector('[data-filter-form]');
    if (filterForm) {
        // Auto-submit on change for select and checkbox
        filterForm.querySelectorAll('select, input[type="checkbox"], input[type="radio"]').forEach(input => {
            input.addEventListener('change', function() {
                if (!this.closest('[data-filter-delay]')) {
                    filterForm.submit();
                }
            });
        });

        // Debounced submit for text inputs
        filterForm.querySelectorAll('input[type="text"], input[type="number"]').forEach(input => {
            let timeout = null;
            input.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    filterForm.submit();
                }, 500);
            });
        });

        // ===== RESET FILTERS =====
        filterForm.querySelector('[data-filter-reset]')?.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            form.querySelectorAll('input, select').forEach(input => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = false;
                } else {
                    input.value = '';
                }
            });
            form.submit();
        });
    }

    // ===== PRICE SLIDER =====
    const priceSlider = document.getElementById('price-slider');
    if (priceSlider) {
        const minPrice = document.getElementById('min-price');
        const maxPrice = document.getElementById('max-price');
        const minDisplay = document.getElementById('min-price-display');
        const maxDisplay = document.getElementById('max-price-display');

        if (minPrice && maxPrice && minDisplay && maxDisplay) {
            priceSlider.addEventListener('input', function() {
                const values = this.value.split(',');
                minPrice.value = values[0];
                maxPrice.value = values[1];
                minDisplay.textContent = formatCurrency(values[0]);
                maxDisplay.textContent = formatCurrency(values[1]);
            });
        }
    }

    // ===== FILTER TOGGLE (MOBILE) =====
    document.querySelector('[data-filter-toggle]')?.addEventListener('click', function() {
        const filterContainer = document.querySelector('[data-filter-container]');
        if (filterContainer) {
            filterContainer.classList.toggle('hidden');
            filterContainer.classList.toggle('block');
        }
    });

    // ===== ACTIVE FILTERS =====
    document.querySelectorAll('[data-filter-remove]').forEach(button => {
        button.addEventListener('click', function() {
            const filterName = this.dataset.filter;
            const filterValue = this.dataset.value;
            
            const form = this.closest('form');
            if (!form) return;

            const input = form.querySelector(`[name="${filterName}"]`);
            if (input) {
                if (input.type === 'checkbox') {
                    input.checked = false;
                } else if (input.type === 'radio') {
                    const radio = form.querySelector(`[name="${filterName}"][value="${filterValue}"]`);
                    if (radio) radio.checked = false;
                } else {
                    input.value = '';
                }
                form.submit();
            }
        });
    });
});

// ===== HELPER FUNCTIONS =====
function formatCurrency(value) {
    const num = parseInt(value);
    if (isNaN(num)) return 'Rp 0';
    return 'Rp ' + num.toLocaleString('id-ID');
}

// ===== SORT =====
document.querySelectorAll('[data-sort]').forEach(sortBtn => {
    sortBtn.addEventListener('click', function() {
        const sortBy = this.dataset.sort;
        const currentSort = new URLSearchParams(window.location.search).get('sort');
        const newSort = currentSort === sortBy ? `-${sortBy}` : sortBy;
        
        const url = new URL(window.location.href);
        url.searchParams.set('sort', newSort);
        window.location.href = url.toString();
    });
});