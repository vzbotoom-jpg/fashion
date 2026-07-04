@props([
    'item' => null,
    'showActions' => true,
])

<div {{ $attributes->merge(['class' => 'cart-item']) }}>
    <!-- Product Image -->
    <div class="cart-item-image">
        @if($item->product->images->first())
            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                 alt="{{ $item->product->name }}" 
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <!-- Shirt Icon -->
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        @endif
    </div>

    <!-- Product Info -->
    <div class="cart-item-info">
        <div class="flex items-start justify-between">
            <div>
                <a href="{{ route('products.show', $item->product->slug) }}" class="cart-item-name">
                    {{ $item->product->name }}
                </a>
                <p class="cart-item-meta mt-0.5">
                    Ukuran: {{ $item->size->name }} ({{ $item->size->code }})
                </p>
                <p class="cart-item-meta">
                    Jumlah: {{ $item->quantity }}
                </p>
            </div>
            <div class="text-right">
                <p class="cart-item-price">
                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-500">
                    Rp {{ number_format($item->price, 0, ',', '.') }} / pcs
                </p>
            </div>
        </div>

        <!-- Actions -->
        @if($showActions)
            <div class="cart-item-actions">
                <!-- Quantity Controls -->
                <div class="cart-item-quantity">
                    <button onclick="updateQuantity({{ $item->id }}, -1)" 
                            class="cart-item-quantity-btn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                    </button>
                    <span class="cart-item-quantity-value" id="qty-{{ $item->id }}">
                        {{ $item->quantity }}
                    </span>
                    <button onclick="updateQuantity({{ $item->id }}, 1)" 
                            class="cart-item-quantity-btn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                </div>

                <!-- Remove Button -->
                <button onclick="removeItem({{ $item->id }})" 
                        class="text-red-400 hover:text-red-300 text-sm font-medium transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function updateQuantity(itemId, change) {
        const qtyElement = document.getElementById(`qty-${itemId}`);
        let currentQty = parseInt(qtyElement.textContent);
        let newQty = currentQty + change;

        if (newQty < 1) return;

        fetch(`/cart/update/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: newQty })
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
    }

    function removeItem(itemId) {
        if (confirm('Hapus item dari keranjang?')) {
            fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
        }
    }
</script>
@endpush