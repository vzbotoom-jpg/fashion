<script>
    window.appConfig = {
        name: "{{ config('app.name') }}",
        url: "{{ config('app.url') }}",
        csrfToken: "{{ csrf_token() }}",
        user: @json(auth()->user()),
        currency: "Rp",
        cartCount: {{ auth()->check() ? app(\App\Services\CartService::class)->getCartCount(auth()->id()) : 0 }},
    };

    // Global Alpine.js Data
    document.addEventListener('alpine:init', () => {
        Alpine.data('miniCart', () => ({
            isOpen: false,
            count: window.appConfig.cartCount,

            toggle() {
                this.isOpen = !this.isOpen;
            },
            close() {
                this.isOpen = false;
            },
            updateCart() {
                fetch("{{ route('api.cart.count') }}")
                    .then(response => response.json())
                    .then(data => {
                        this.count = data.count;
                        window.appConfig.cartCount = data.count;
                    });
            }
        }));
    });
</script>
