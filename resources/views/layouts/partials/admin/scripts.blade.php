<!-- Admin Scripts -->
<!-- Alpine.js CDN (harus di-load sebelum alpine:init) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

<!-- Alpine.js initialization -->
<script>
    document.addEventListener('alpine:init', () => {
        // Global Alpine store for admin
        Alpine.store('admin', {
            sidebarOpen: window.innerWidth > 1024,
            theme: localStorage.getItem('admin_theme') || 'light',
            
            toggleSidebar() {
                this.sidebarOpen = !this.sidebarOpen;
            },
            
            toggleTheme() {
                this.theme = this.theme === 'light' ? 'dark' : 'light';
                localStorage.setItem('admin_theme', this.theme);
                document.documentElement.classList.toggle('dark');
            }
        });
    });
</script>

<!-- Chart.js for analytics -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<!-- Admin JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
        
        // Tooltip initialization
        document.querySelectorAll('[data-tooltip]').forEach(el => {
            el.addEventListener('mouseenter', function() {
                const tooltip = document.createElement('div');
                tooltip.className = 'absolute z-50 bg-gray-800 text-white text-xs px-2 py-1 rounded pointer-events-none';
                tooltip.textContent = this.dataset.tooltip;
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + rect.width / 2 - tooltip.offsetWidth / 2 + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
                
                this._tooltip = tooltip;
            });
            
            el.addEventListener('mouseleave', function() {
                if (this._tooltip) {
                    this._tooltip.remove();
                    this._tooltip = null;
                }
            });
        });
    });
</script>

<!-- DataTable initialization -->
@stack('datatable')

<!-- Page specific scripts -->
@stack('scripts')