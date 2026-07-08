@extends('layouts.app')

@section('title', 'Tracking Pesanan #' . $order->order_number . ' - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="{{ route('customer.orders.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition mb-6">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Pesanan
            </a>

            <!-- Order Header -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl font-display font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Tracking Pesanan #{{ $order->order_number }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">Status: <span class="font-medium text-gray-700">{{ $order->status_label }}</span></p>
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
                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Tanggal Order</p>
                        <p class="font-medium text-gray-800">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Total</p>
                        <p class="font-medium text-primary">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Metode Pembayaran</p>
                        <p class="font-medium text-gray-800">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Status Pembayaran</p>
                        <span class="badge {{ $order->payment_status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                            {{ $order->payment_status_label }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tracking Timeline -->
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8 mb-6">
                <h3 class="font-bold text-gray-900 text-lg mb-8 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Status Pesanan
                </h3>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-[19px] top-2 bottom-2 w-0.5 bg-gray-200"></div>

                    @php
                        $statuses = [
                            'pending' => ['label' => 'Menunggu Konfirmasi', 'icon' => '⏳', 'color' => 'bg-yellow-500'],
                            'processing' => ['label' => 'Sedang Diproses', 'icon' => '🔄', 'color' => 'bg-blue-500'],
                            'shipped' => ['label' => 'Dikirim', 'icon' => '🚚', 'color' => 'bg-indigo-500'],
                            'delivered' => ['label' => 'Telah Diterima', 'icon' => '📦', 'color' => 'bg-green-500'],
                            'completed' => ['label' => 'Selesai', 'icon' => '✅', 'color' => 'bg-primary'],
                            'cancelled' => ['label' => 'Dibatalkan', 'icon' => '❌', 'color' => 'bg-red-500'],
                        ];
                        $currentStatus = $order->status;
                        $statusKeys = array_keys($statuses);
                        $currentIndex = array_search($currentStatus, $statusKeys);
                    @endphp

                    @foreach($statuses as $key => $status)
                        @php
                            $isActive = in_array($key, array_slice($statusKeys, 0, $currentIndex + 1));
                            $isCompleted = $key === $currentStatus && $currentStatus !== 'cancelled';
                            $isCancelled = $currentStatus === 'cancelled' && $key === 'cancelled';
                            $isPending = $key === 'pending' && $currentStatus === 'pending';
                        @endphp
                        <div class="relative flex items-start gap-4 pb-8 last:pb-0">
                            <!-- Timeline Icon -->
                            <div class="relative z-10 flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $isActive ? ($isCancelled ? 'bg-red-500' : 'bg-primary') : 'bg-gray-200' }} {{ $isCompleted ? 'ring-4 ring-primary/20' : '' }}">
                                @if($isActive)
                                    @if($isCancelled)
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    @elseif($isCompleted || $isPending)
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @else
                                        <span class="text-white">{{ substr($status['label'], 0, 1) }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-xs">{{ $loop->iteration }}</span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1 pt-1">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                    <div>
                                        <h4 class="font-semibold {{ $isActive ? 'text-gray-900' : 'text-gray-400' }}">
                                            {{ $status['label'] }}
                                            @if($isCompleted && !$isCancelled)
                                                <span class="text-xs text-primary font-bold ml-2">● Aktif</span>
                                            @endif
                                            @if($isCancelled)
                                                <span class="text-xs text-red-500 font-bold ml-2">● Dibatalkan</span>
                                            @endif
                                        </h4>
                                        @if($isActive && isset($trackingStatus))
                                            @foreach($trackingStatus as $track)
                                                @if($track['status'] === $key)
                                                    <p class="text-sm text-gray-500">{{ $track['description'] ?? 'Status diperbarui' }}</p>
                                                    <p class="text-xs text-gray-400">{{ $track['date'] ?? '' }}</p>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    @if($isActive)
                                        <span class="text-xs font-medium px-2 py-1 rounded-full {{ $isCancelled ? 'bg-red-100 text-red-700' : 'bg-primary/10 text-primary' }}">
                                            {{ $isCancelled ? 'Dibatalkan' : ($isCompleted ? 'Selesai' : 'Proses') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Order Items -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Item Pesanan
                    </h3>
                    <div class="divide-y divide-gray-100">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 py-3 first:pt-0 last:pb-0">
                                <div class="w-12 h-12 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                                    @if($item->product->images->first())
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">{{ $item->product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->size->name }} x {{ $item->quantity }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-primary">Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Alamat Pengiriman
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-500">Alamat</p>
                            <p class="font-medium text-gray-800">{{ $order->shipping_address }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Kota / Provinsi</p>
                            <p class="font-medium text-gray-800">{{ $order->city }}, {{ $order->province }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Kode Pos</p>
                            <p class="font-medium text-gray-800">{{ $order->postal_code }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Nomor Telepon</p>
                            <p class="font-medium text-gray-800">{{ $order->phone }}</p>
                        </div>
                        @if($order->notes)
                            <div>
                                <p class="text-gray-500">Catatan</p>
                                <p class="font-medium text-gray-800">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
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