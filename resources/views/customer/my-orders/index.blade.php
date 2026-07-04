@extends('layouts.app')

@section('title', 'Pesanan Saya - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-display font-bold text-gray-800 mb-8 flex items-center gap-3">
            <!-- Package Icon -->
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Pesanan Saya
        </h1>

        <!-- Tabs -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="flex overflow-x-auto border-b border-gray-200">
                <button onclick="switchTab('orders')" class="tab-btn px-6 py-3 font-medium text-primary border-b-2 border-primary transition" data-tab="orders">
                    <!-- Shopping Bag Icon -->
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Pesanan
                </button>
                <button onclick="switchTab('preorders')" class="tab-btn px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition" data-tab="preorders">
                    <!-- Package Icon -->
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Pre-Order
                </button>
                <button onclick="switchTab('customorders')" class="tab-btn px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition" data-tab="customorders">
                    <!-- Paint Brush Icon -->
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Custom Order
                </button>
            </div>

            <!-- Orders Tab -->
            <div id="tab-orders" class="tab-content p-4">
                @if($orders->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($orders as $order)
                            <div class="bg-gray-50 rounded-lg p-4 hover:shadow transition">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-800">#{{ $order->order_number }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->items->count() }} produk</p>
                                    </div>
                                    <div class="mt-2 md:mt-0 flex flex-wrap items-center gap-3">
                                        <span class="badge {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                            {{ $order->status_label }}
                                        </span>
                                        <span class="font-bold text-primary">
                                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                        </span>
                                        <a href="{{ route('customer.orders.show', $order->id) }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                                            Detail
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                @else
                    <div class="text-center py-8">
                        <!-- Shopping Cart Icon -->
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <p class="text-gray-500">Belum ada pesanan</p>
                        <a href="{{ route('products.index') }}" class="text-primary hover:underline mt-2 inline-block">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>

            <!-- Pre-Orders Tab -->
            <div id="tab-preorders" class="tab-content hidden p-4">
                @if($preOrders->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($preOrders as $preOrder)
                            <div class="bg-gray-50 rounded-lg p-4 hover:shadow transition">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-800">#{{ $preOrder->order_number }}</p>
                                        <p class="text-sm text-gray-500">{{ $preOrder->product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $preOrder->size->name }} x {{ $preOrder->quantity }}</p>
                                    </div>
                                    <div class="mt-2 md:mt-0 flex flex-wrap items-center gap-3">
                                        <span class="badge {{ $preOrder->status === 'completed' ? 'badge-success' : ($preOrder->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                            {{ $preOrder->status_label }}
                                        </span>
                                        <a href="#" class="text-primary hover:underline text-sm flex items-center gap-1">
                                            Detail
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <!-- Package Icon -->
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <p class="text-gray-500">Belum ada pre-order</p>
                        <a href="{{ route('products.index') }}" class="text-primary hover:underline mt-2 inline-block">
                            Lihat Produk
                        </a>
                    </div>
                @endif
            </div>

            <!-- Custom Orders Tab -->
            <div id="tab-customorders" class="tab-content hidden p-4">
                @if($customOrders->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($customOrders as $customOrder)
                            <div class="bg-gray-50 rounded-lg p-4 hover:shadow transition">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-800">#{{ $customOrder->order_number }}</p>
                                        <p class="text-sm text-gray-500">
                                            @if($customOrder->product)
                                                {{ $customOrder->product->name }}
                                            @else
                                                Custom Design
                                            @endif
                                        </p>
                                        <p class="text-sm text-gray-500">{{ $customOrder->size->name }} x {{ $customOrder->quantity }}</p>
                                    </div>
                                    <div class="mt-2 md:mt-0 flex flex-wrap items-center gap-3">
                                        <span class="badge {{ $customOrder->status === 'completed' ? 'badge-success' : ($customOrder->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                            {{ $customOrder->status_label }}
                                        </span>
                                        <a href="#" class="text-primary hover:underline text-sm flex items-center gap-1">
                                            Detail
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <!-- Paint Brush Icon -->
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        <p class="text-gray-500">Belum ada custom order</p>
                        <a href="{{ route('customer.custom-order.create') }}" class="text-primary hover:underline mt-2 inline-block">
                            Buat Custom Order
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    function switchTab(tab) {
        // Update buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-primary', 'border-primary', 'border-b-2');
            btn.classList.add('text-gray-500');
            if (btn.dataset.tab === tab) {
                btn.classList.remove('text-gray-500');
                btn.classList.add('text-primary', 'border-primary', 'border-b-2');
            }
        });

        // Update content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById(`tab-${tab}`).classList.remove('hidden');
    }
</script>

<style>
    .badge {
        @apply px-3 py-1 rounded-full text-xs font-medium;
    }
    .badge-success {
        @apply bg-green-100 text-green-800;
    }
    .badge-warning {
        @apply bg-yellow-100 text-yellow-800;
    }
    .badge-danger {
        @apply bg-red-100 text-red-800;
    }
    .badge-info {
        @apply bg-blue-100 text-blue-800;
    }
</style>
@endsection