@props([
    'product' => null,
    'sizes' => [],
    'selectedSize' => null,
    'name' => 'size_id',
    'required' => true,
    'showStock' => true,
    'showPrice' => true,
])

<div class="space-y-3">
    <label class="form-label">
        Pilih Ukuran
        @if($required)
            <span class="text-red-400">*</span>
        @endif
    </label>

    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2">
        @foreach($sizes as $size)
            @php
                $isSelected = $selectedSize == $size->id;
                $stock = $product ? $product->getStockForSize($size->id) : 0;
                $isAvailable = $stock > 0;
                $price = $product ? $product->getPriceForSize($size->id) : null;
            @endphp

            <button
                type="button"
                onclick="selectSize('{{ $size->id }}', '{{ $name }}')"
                data-size-id="{{ $size->id }}"
                data-stock="{{ $stock }}"
                class="size-option {{ $isSelected ? 'size-option-selected' : 'size-option-default' }} {{ !$isAvailable ? 'size-option-disabled' : '' }}"
                {{ !$isAvailable ? 'disabled' : '' }}
            >
                <span class="block text-sm font-medium">
                    {{ $size->name }}
                </span>

                @if($showStock)
                    <span class="text-xs {{ $isAvailable ? 'text-secondary' : 'text-red-400' }}">
                        {{ $isAvailable ? $stock . ' stok' : 'Habis' }}
                    </span>
                @endif

                @if($showPrice && $price)
                    <span class="text-xs text-gray-500 block mt-1">
                        Rp {{ number_format($price, 0, ',', '.') }}
                    </span>
                @endif

                <!-- Checkmark when selected -->
                @if($isSelected)
                    <div class="size-option-checkmark">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                @endif
            </button>
        @endforeach
    </div>

    <!-- Hidden input for form submission -->
    <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $selectedSize }}">

    <!-- Size Guide -->
    <div class="mt-2">
        <button type="button" onclick="showSizeGuide()" class="text-sm text-gray-400 hover:text-white transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Panduan Ukuran
        </button>
    </div>
</div>

@push('scripts')
<script>
    function selectSize(sizeId, name) {
        // Update hidden input
        document.getElementById(name).value = sizeId;

        // Update UI
        document.querySelectorAll('.size-option').forEach(btn => {
            const btnSizeId = btn.dataset.sizeId;
            btn.classList.remove('size-option-selected');
            btn.classList.add('size-option-default');

            if (btnSizeId === sizeId) {
                btn.classList.remove('size-option-default');
                btn.classList.add('size-option-selected');
            }
        });
    }

    function showSizeGuide() {
        // Simple size guide modal
        const sizes = @json($sizes);
        const guide = sizes.map(s => `${s.name} (${s.code})`).join(', ');
        alert('Ukuran tersedia: ' + guide);
    }
</script>
@endpush