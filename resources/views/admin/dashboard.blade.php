@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Welcome to admin dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pesanan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_orders'] ?? 0 }}</p>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Revenue</p>
                <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($stats['revenue_this_month'] ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-green-500/10 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Pre-Order Pending</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['pending_pre_orders'] ?? 0 }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-500/10 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pelanggan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] ?? 0 }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Sales Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4">📊 Penjualan 30 Hari Terakhir</h3>
        <canvas id="salesChart" height="250"></canvas>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4">📦 Pesanan Terbaru</h3>
        <div class="space-y-3 max-h-80 overflow-y-auto">
            @forelse($recentOrders ?? [] as $order)
                <div class="flex items-center justify-between text-sm py-2 border-b border-gray-100">
                    <div>
                        <p class="font-medium text-gray-800">#{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-500">{{ $order->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-primary">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                        <span class="badge {{ $order->status === 'completed' ? 'badge-success' : 'badge-warning' }}">
                            {{ $order->status_label }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-4">Belum ada pesanan</p>
            @endforelse
        </div>
        <a href="{{ route('admin.orders.index') }}" class="block text-center text-primary hover:underline text-sm mt-4">
            Lihat Semua →
        </a>
    </div>
</div>

<!-- Top Products -->
<div class="mt-6 bg-white rounded-xl shadow-sm p-6">
    <h3 class="font-semibold text-gray-800 mb-4">🏆 Produk Terlaris</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        @forelse($topProducts ?? [] as $product)
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="font-medium text-gray-800">{{ $product->name }}</p>
                <p class="text-sm text-gray-500">{{ $product->total_sold ?? 0 }} terjual</p>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 py-4">Belum ada data</p>
        @endforelse
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($salesData['labels'] ?? []),
                datasets: [{
                    label: 'Revenue',
                    data: @json($salesData['revenue'] ?? []),
                    borderColor: '#5c6ac4',
                    backgroundColor: 'rgba(92, 106, 196, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush

<style>
    .badge {
        @apply px-2 py-0.5 rounded-full text-xs font-medium;
    }
    .badge-success {
        @apply bg-green-100 text-green-800;
    }
    .badge-warning {
        @apply bg-yellow-100 text-yellow-800;
    }
</style>
@endsection