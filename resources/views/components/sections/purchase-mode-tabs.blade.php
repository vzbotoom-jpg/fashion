@props([
    'product' => null,
])

<div class="border border-white/10 rounded-2xl overflow-hidden">
    <div class="flex divide-x divide-white/10">
        <button onclick="switchTab('buy')" 
                class="tab-btn flex-1 py-3 text-center font-medium bg-white text-gray-950 transition" 
                data-tab="buy">
            <!-- Shopping Bag Icon -->
            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            Beli
        </button>
        <button onclick="switchTab('preorder')" 
                class="tab-btn flex-1 py-3 text-center font-medium text-gray-400 hover:bg-white/5 transition" 
                data-tab="preorder">
            <!-- Package Icon -->
            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Pre-Order
        </button>
        <button onclick="switchTab('custom')" 
                class="tab-btn flex-1 py-3 text-center font-medium text-gray-400 hover:bg-white/5 transition" 
                data-tab="custom">
            <!-- Paint Brush Icon -->
            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
            </svg>
            Custom
        </button>
    </div>
    
    <div class="p-4 bg-white/5">
        <!-- Buy Tab -->
        <div id="tab-buy" class="tab-content">
            <p class="text-sm text-gray-400 flex items-center gap-2">
                Beli langsung produk dengan ukuran yang tersedia.
                @if($product && $product->isInStock())
                    <span class="text-secondary font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Stok tersedia
                    </span>
                @else
                    <span class="text-red-400 font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Stok habis
                    </span>
                @endif
            </p>
            @if($product && $product->isInStock())
                <p class="text-xs text-gray-500 mt-1">Stok: {{ $product->total_stock }} unit</p>
            @endif
        </div>
        
        <!-- Pre-Order Tab -->
        <div id="tab-preorder" class="tab-content hidden">
            <p class="text-sm text-gray-400 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Pre-order produk dengan ukuran yang Anda inginkan. Produk akan dibuat setelah pesanan diterima.
            </p>
            <div class="mt-2">
                <a href="{{ $product ? route('customer.pre-order.create', $product->slug) : '#' }}" 
                   class="text-secondary text-sm font-medium hover:underline flex items-center gap-1">
                    Buat Pre-Order
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Custom Tab -->
        <div id="tab-custom" class="tab-content hidden">
            <p class="text-sm text-gray-400 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                Custom order sesuai keinginan Anda. Pilih ukuran, model, dan detail lainnya.
            </p>
            <div class="mt-2">
                <a href="{{ route('customer.custom-order.create', ['product_id' => $product ? $product->id : null]) }}" 
                   class="text-secondary text-sm font-medium hover:underline flex items-center gap-1">
                    Buat Custom Order
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tab) {
        // Update buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-white', 'text-gray-950', 'text-gray-400');
            btn.classList.add('text-gray-400', 'bg-transparent');
            if (btn.dataset.tab === tab) {
                btn.classList.remove('text-gray-400', 'bg-transparent');
                btn.classList.add('bg-white', 'text-gray-950');
            }
        });
        
        // Update content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById(`tab-${tab}`).classList.remove('hidden');
    }
</script>