@extends('layouts.app')

@section('title', 'Pesanan Saya - ' . config('app.name'))

@section('content')
<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header -->
        <div class="mb-16">
            <h1 class="section-title">Pesanan Saya</h1>
            <p class="section-subtitle">Pantau status pesanan, pre-order, dan custom order Anda di satu tempat.</p>
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden mb-12 shadow-xs">
            <div class="flex overflow-x-auto border-b border-gray-200 bg-gray-50/50">
                <button onclick="switchTab('orders')" class="tab-btn px-8 py-5 text-sm font-bold text-primary border-b-2 border-primary transition-all whitespace-nowrap" data-tab="orders">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Pesanan Reguler
                    </span>
                </button>
                <button onclick="switchTab('preorders')" class="tab-btn px-8 py-5 text-sm font-bold text-gray-400 hover:text-gray-900 border-b-2 border-transparent transition-all whitespace-nowrap" data-tab="preorders">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Pre-Order
                    </span>
                </button>
                <button onclick="switchTab('customorders')" class="tab-btn px-8 py-5 text-sm font-bold text-gray-400 hover:text-gray-900 border-b-2 border-transparent transition-all whitespace-nowrap" data-tab="customorders">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Custom Order
                    </span>
                </button>
            </div>

            <!-- Orders Tab -->
            <div id="tab-orders" class="tab-content">
                @if($orders->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">No. Pesanan</th>
                                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Tanggal</th>
                                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Total</th>
                                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-8 py-6">
                                            <span class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</span>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</span>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="badge {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                                {{ $order->status_label }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <a href="{{ route('customer.orders.show', $order->id) }}" class="text-primary hover:text-primary-dark text-sm font-bold transition">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 border-t border-gray-100">
                        {{ $orders->links() }}
                    </div>
                @else
                    <div class="text-center py-20 px-6">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada pesanan</h3>
                        <p class="text-gray-500 mb-8 max-w-xs mx-auto">Anda belum melakukan pesanan reguler apa pun sejauh ini.</p>
                        <a href="{{ route('products.index') }}" class="btn-primary btn-sm">Mulai Belanja</a>
                    </div>
                @endif
            </div>

            <!-- Pre-Orders Tab -->
            <div id="tab-preorders" class="tab-content hidden">
                @if($preOrders->isNotEmpty())
                    <div class="divide-y divide-gray-100">
                        @foreach($preOrders as $preOrder)
                            <div class="p-6 md:p-8 hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-bold text-gray-900">#{{ $preOrder->order_number }}</span>
                                            <span class="badge {{ $preOrder->status === 'completed' ? 'badge-success' : ($preOrder->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                                {{ $preOrder->status_label }}
                                            </span>
                                        </div>
                                        <p class="text-xs font-medium text-gray-700">{{ $preOrder->product->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $preOrder->size->name }} x {{ $preOrder->quantity }} • {{ $preOrder->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="#" class="btn-secondary btn-sm">Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20 px-6">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada pre-order</h3>
                        <p class="text-gray-500 mb-8 max-w-xs mx-auto">Anda belum memesan produk pre-order dengan ukuran kustom.</p>
                        <a href="{{ route('products.index') }}" class="btn-primary btn-sm">Lihat Produk</a>
                    </div>
                @endif
            </div>

            <!-- Custom Orders Tab -->
            <div id="tab-customorders" class="tab-content hidden">
                @if($customOrders->isNotEmpty())
                    <div class="divide-y divide-gray-100">
                        @foreach($customOrders as $customOrder)
                            <div class="p-6 md:p-8 hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-bold text-gray-900">#{{ $customOrder->order_number }}</span>
                                            <span class="badge {{ $customOrder->status === 'completed' ? 'badge-success' : ($customOrder->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                                {{ $customOrder->status_label }}
                                            </span>
                                        </div>
                                        <p class="text-xs font-medium text-gray-700">
                                            @if($customOrder->product)
                                                {{ $customOrder->product->name }}
                                            @else
                                                Custom Design Order
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $customOrder->size->name }} x {{ $customOrder->quantity }} • {{ $customOrder->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="#" class="btn-secondary btn-sm">Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20 px-6">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada custom order</h3>
                        <p class="text-gray-500 mb-8 max-w-xs mx-auto">Wujudkan desain pakaian impian Anda melalui layanan custom order kami.</p>
                        <a href="{{ route('customer.custom-order.create') }}" class="btn-primary btn-sm">Buat Custom Order</a>
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
            btn.classList.remove('text-primary', 'border-primary');
            btn.classList.add('text-gray-400', 'border-transparent');
            if (btn.dataset.tab === tab) {
                btn.classList.remove('text-gray-400', 'border-transparent');
                btn.classList.add('text-primary', 'border-primary');
            }
        });

        // Update content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById(`tab-${tab}`).classList.remove('hidden');
    }
</script>
@endsection
