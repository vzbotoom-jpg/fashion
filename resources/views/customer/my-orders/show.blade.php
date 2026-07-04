@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number . ' - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="{{ route('customer.orders') }}" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition mb-6">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Pesanan
            </a>

            <!-- Order Header -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl font-display font-bold text-gray-800">#{{ $order->order_number }}</h1>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="mt-2 md:mt-0 flex items-center gap-3">
                        <span class="badge {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                            {{ $order->status_label }}
                        </span>
                        <span class="badge {{ $order->payment_status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                            {{ $order->payment_status_label }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <!-- Shopping Bag Icon -->
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Produk
                </h3>
                <div class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <div class="flex items-center py-4 first:pt-0 last:pb-0">
                            <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                                @if($item->product->images->first())
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <!-- Shirt Icon -->
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 ml-4">
                                <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-500">Ukuran: {{ $item->size->name }} x {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-primary">Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-400">Rp {{ number_format($item->price, 0, ',', '.') }} / pcs</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <!-- Chart Icon -->
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Ringkasan
                </h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="font-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Ongkos Kirim</span>
                        <span class="font-medium">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Pajak (11%)</span>
                        <span class="font-medium">Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-2 mt-2">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-primary">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <!-- Location Icon -->
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Informasi Pengiriman
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="text-gray-800">{{ $order->shipping_address }}</p>
                        <p class="text-gray-800">{{ $order->city }}, {{ $order->province }}</p>
                        <p class="text-gray-800">Kode Pos: {{ $order->postal_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kontak</p>
                        <p class="text-gray-800">{{ $order->phone }}</p>
                        <p class="text-sm text-gray-500 mt-2">Metode Pembayaran</p>
                        <p class="text-gray-800">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    </div>
                </div>
                @if($order->notes)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-500">Catatan</p>
                        <p class="text-gray-800">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

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
</style>
@endsection