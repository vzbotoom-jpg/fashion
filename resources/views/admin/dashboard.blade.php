@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Selamat datang di panel admin ' . config('app.name'))

@section('content')
<!-- Stats Cards - 6 Column Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
    <!-- Total Pesanan -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
        <div class="flex flex-col">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500 mb-1">Total Pesanan</p>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_orders'] ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Revenue -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
        <div class="flex flex-col">
            <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500 mb-1">Revenue</p>
            <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['revenue_this_month'] ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Pre-Order Pending -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
        <div class="flex flex-col">
            <div class="w-10 h-10 bg-yellow-50 text-yellow-600 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500 mb-1">P.O Pending</p>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['pending_pre_orders'] ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Total Produk -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
        <div class="flex flex-col">
            <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500 mb-1">Total Produk</p>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_products'] ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Total Pelanggan -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
        <div class="flex flex-col">
            <div class="w-10 h-10 bg-pink-50 text-pink-600 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500 mb-1">Pelanggan</p>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_users'] ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Pesanan Selesai -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
        <div class="flex flex-col">
            <div class="w-10 h-10 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500 mb-1">Selesai</p>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['completed_orders'] ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<!-- Charts & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Sales Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-gray-900">Grafik Penjualan</h3>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">30 Hari Terakhir</span>
        </div>
        <canvas id="salesChart" height="280"></canvas>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
        <div class="p-6 border-b border-gray-50">
            <h3 class="font-bold text-gray-900">Pesanan Terbaru</h3>
        </div>
        <div class="flex-grow overflow-y-auto max-h-[400px]">
            @forelse($recentOrders ?? [] as $order)
                <div class="px-6 py-4 border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center justify-between mb-1">
                        <p class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</p>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $order->status_label }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-gray-500">
                            <p class="font-medium text-gray-700">{{ $order->user->name }}</p>
                            <p>{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <p class="text-sm font-bold text-primary">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <p class="text-sm text-gray-400">Belum ada pesanan</p>
                </div>
            @endforelse
        </div>
        <div class="p-4 bg-gray-50 text-center">
            <a href="{{ route('admin.reports.orders') }}" class="text-sm font-bold text-primary hover:text-primary-dark transition-colors inline-flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Top Products -->
<div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="font-bold text-gray-900">Produk Terlaris</h3>
        <a href="{{ route('admin.reports.sales') }}" class="text-xs font-bold text-primary hover:underline">Detail Laporan</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        @forelse($topProducts ?? [] as $product)
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 hover:bg-white hover:shadow-md transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-gray-900 line-clamp-1 mb-1">{{ $product->name }}</p>
                    <p class="text-xs font-bold text-primary">{{ number_format($product->total_sold ?? 0, 0, ',', '.') }} Terjual</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-sm text-gray-400 font-medium">Belum ada data penjualan produk</p>
            </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(0, 128, 96, 0.2)');
        gradient.addColorStop(1, 'rgba(0, 128, 96, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($salesData['labels'] ?? []),
                datasets: [{
                    label: 'Revenue',
                    data: @json($salesData['revenue'] ?? []),
                    borderColor: '#008060',
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#008060',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1a1a1a',
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        },
                        ticks: {
                            font: { size: 10 },
                            color: '#9ca3af',
                            callback: function(value) {
                                if (value >= 1000000) return 'Rp ' + (value/1000000) + 'jt';
                                if (value >= 1000) return 'Rp ' + (value/1000) + 'rb';
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 10 },
                            color: '#9ca3af'
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection