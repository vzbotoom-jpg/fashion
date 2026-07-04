/**
 * Admin Dashboard JavaScript
 */

import Chart from 'chart.js/auto';

// ===== SIDEBAR TOGGLE =====
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            const sidebar = document.querySelector('aside');
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
            }
        });
    }

    // ===== SIDEBAR COLLAPSE ON MOBILE =====
    if (window.innerWidth < 1024) {
        const sidebar = document.querySelector('aside');
        if (sidebar) {
            sidebar.classList.add('-translate-x-full');
        }
    }

    // ===== AUTO-DISMISS ALERTS =====
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // ===== TOOLTIPS =====
    document.querySelectorAll('[data-tooltip]').forEach(el => {
        let tooltipElement = null;

        el.addEventListener('mouseenter', function() {
            tooltipElement = document.createElement('div');
            tooltipElement.className = 'fixed z-50 bg-gray-800 text-white text-xs px-2 py-1 rounded pointer-events-none';
            tooltipElement.textContent = this.dataset.tooltip;
            document.body.appendChild(tooltipElement);

            const rect = this.getBoundingClientRect();
            tooltipElement.style.left = rect.left + rect.width / 2 - tooltipElement.offsetWidth / 2 + 'px';
            tooltipElement.style.top = rect.top - tooltipElement.offsetHeight - 5 + 'px';
        });

        el.addEventListener('mouseleave', function() {
            if (tooltipElement) {
                tooltipElement.remove();
                tooltipElement = null;
            }
        });
    });
});

// ===== CHART INSTANCES =====
let chartInstances = {};

window.initChart = function(elementId, config) {
    const ctx = document.getElementById(elementId);
    if (!ctx) return null;

    // Destroy existing chart instance
    if (chartInstances[elementId]) {
        chartInstances[elementId].destroy();
    }

    const chart = new Chart(ctx, config);
    chartInstances[elementId] = chart;
    return chart;
};

// ===== DATA TABLE INITIALIZATION =====
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-table]').forEach(table => {
        // Simple table search
        const searchInput = table.querySelector('[data-table-search]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = table.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }

        // Table sorting
        table.querySelectorAll('[data-sort]').forEach(header => {
            header.addEventListener('click', function() {
                const sortKey = this.dataset.sort;
                const isAsc = this.dataset.sortOrder === 'asc';
                const rows = Array.from(table.querySelectorAll('tbody tr'));

                rows.sort((a, b) => {
                    const aVal = a.querySelector(`[data-sort-value="${sortKey}"]`)?.textContent || '';
                    const bVal = b.querySelector(`[data-sort-value="${sortKey}"]`)?.textContent || '';
                    return isAsc ? aVal.localeCompare(bVal) : bVal.localeCompare(aVal);
                });

                rows.forEach(row => table.querySelector('tbody').appendChild(row));
                this.dataset.sortOrder = isAsc ? 'desc' : 'asc';
            });
        });
    });
});

// ===== EXPORT FUNCTIONS =====
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

    setTimeout(() => {
        toast.style.transition = 'opacity 0.5s';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
    }, 5000);
};

window.confirmAction = function(message, callback) {
    if (confirm(message)) {
        callback();
    }
};