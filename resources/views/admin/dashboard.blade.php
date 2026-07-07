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

<!-- Charts: Revenue & Quantity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-900">Grafik Penjualan (Rp)</h3>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">30 Hari Terakhir</span>
        </div>
        <div class="chart-container" style="position: relative; height:250px; width:100%;">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-900">Jumlah Barang Terjual</h3>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">30 Hari Terakhir</span>
        </div>
        <div class="chart-container" style="position: relative; height:250px; width:100%;">
            <canvas id="quantityChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
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

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-900 mb-4">Produk Terlaris</h3>
        <div class="space-y-4">
            @forelse($topProducts ?? [] as $product)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">{{ number_format($product->total_sold ?? 0, 0, ',', '.') }} terjual</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 py-8 text-sm">Belum ada data penjualan</p>
            @endforelse
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 text-center">
            <a href="{{ route('admin.reports.sales') }}" class="text-xs font-bold text-primary hover:underline">Lihat Detail Laporan</a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format untuk jumlah barang (tanpa Rp)
        function formatQuantity(value) {
            if (value >= 1000000) {
                return (value / 1000000).toFixed(1) + ' JT';
            } else if (value >= 1000) {
                return (value / 1000).toFixed(0) + ' RB';
            } else {
                return value.toFixed(0);
            }
        }

        // Format untuk uang/pendapatan (dengan Rp)
        function formatCurrency(value) {
            if (value >= 1000000000) {
                return 'Rp ' + (value / 1000000000).toFixed(1) + ' M';
            } else if (value >= 1000000) {
                return 'Rp ' + (value / 1000000).toFixed(1) + ' JT';
            } else if (value >= 1000) {
                return 'Rp ' + (value / 1000).toFixed(0) + ' RB';
            } else {
                return 'Rp ' + value.toFixed(0);
            }
        }

        const salesData = @json($salesData ?? []);
        const labels = salesData.labels ?? [];
        const revenueData = salesData.revenue ?? [];
        const quantityData = salesData.quantity ?? [];

        // 1. Sales Chart (Pendapatan)
        const ctx = document.getElementById('salesChart');
        if (ctx) {
            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 250);
            gradient.addColorStop(0, 'rgba(0, 128, 96, 0.2)');
            gradient.addColorStop(1, 'rgba(0, 128, 96, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan',
                        data: revenueData,
                        borderColor: '#008060',
                        borderWidth: 2,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#008060',
                        pointBorderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1a1a1a',
                            titleFont: { size: 11, weight: 'bold' },
                            bodyFont: { size: 11 },
                            padding: 10,
                            cornerRadius: 6,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Pendapatan: ' + formatCurrency(context.parsed.y);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6' },
                            ticks: {
                                font: { size: 9 },
                                color: '#9ca3af',
                                maxTicksLimit: 8,
                                callback: function(value) {
                                    return formatCurrency(value);
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { size: 9 },
                                color: '#9ca3af',
                                maxTicksLimit: 12,
                                maxRotation: 45,
                                minRotation: 0
                            }
                        }
                    }
                }
            });
        }

        // 2. Quantity Chart (Jumlah Barang Terjual)
        const quantityCtx = document.getElementById('quantityChart');
        if (quantityCtx) {
            new Chart(quantityCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Terjual',
                        data: quantityData,
                        backgroundColor: 'rgba(0, 128, 96, 0.6)',
                        borderColor: '#008060',
                        borderWidth: 2,
                        borderRadius: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1a1a1a',
                            titleFont: { size: 11, weight: 'bold' },
                            bodyFont: { size: 11 },
                            padding: 10,
                            cornerRadius: 6,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Jumlah: ' + formatQuantity(context.parsed.y);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6' },
                            ticks: {
                                font: { size: 9 },
                                color: '#9ca3af',
                                maxTicksLimit: 8,
                                callback: function(value) {
                                    return formatQuantity(value);
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { size: 9 },
                                color: '#9ca3af',
                                maxTicksLimit: 12,
                                maxRotation: 45,
                                minRotation: 0
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection