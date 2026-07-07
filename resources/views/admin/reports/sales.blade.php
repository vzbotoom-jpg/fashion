@extends('layouts.admin')

@section('title', 'Laporan Penjualan - Admin Panel')
@section('page_title', 'Laporan Penjualan')
@section('page_subtitle', 'Analisis penjualan bulanan')

@section('content')
<!-- Month Filter -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <form action="{{ route('admin.reports.sales') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
            <select name="year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
                @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                    <option value="{{ $i }}" {{ ($year ?? date('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
            <select name="month" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ ($month ?? date('m')) == $i ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn-primary px-6 py-2 rounded-lg w-full flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Tampilkan Laporan
            </button>
        </div>
    </form>
</div>

<!-- Charts: Revenue & Quantity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            Grafik Pendapatan
        </h3>
        <canvas id="salesChart" height="200"></canvas>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Grafik Jumlah Terjual
        </h3>
        <canvas id="quantityChart" height="200"></canvas>
    </div>
</div>

<!-- Summary -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-4">
        <p class="text-sm text-gray-500">Total Pesanan</p>
        <p class="text-2xl font-bold text-gray-800">{{ $salesData['total_orders'] ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4">
        <p class="text-sm text-gray-500">Total Revenue</p>
        <p class="text-2xl font-bold text-primary">Rp {{ number_format($salesData['total_revenue'] ?? 0, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4">
        <p class="text-sm text-gray-500">Rata-rata Order</p>
        <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($salesData['average_order_value'] ?? 0, 0, ',', '.') }}</p>
    </div>
</div>

<!-- Top Products -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            Produk Terlaris
        </h3>
        <div class="space-y-3">
            @forelse($topProducts ?? [] as $product)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-800">{{ $product->product->name ?? $product->name }}</p>
                        <p class="text-sm text-gray-500">{{ $product->total_quantity ?? 0 }} terjual</p>
                    </div>
                    <p class="font-semibold text-primary">Rp {{ number_format($product->total_revenue ?? 0, 0, ',', '.') }}</p>
                </div>
            @empty
                <p class="text-center text-gray-500 py-4">Belum ada data</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
            </svg>
            Penjualan per Kategori
        </h3>
        <div class="space-y-3">
            @forelse($salesByCategory ?? [] as $category)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-800">{{ $category->name }}</p>
                        <p class="text-sm text-gray-500">{{ $category->total_quantity ?? 0 }} terjual</p>
                    </div>
                    <p class="font-semibold text-primary">Rp {{ number_format($category->total_revenue ?? 0, 0, ',', '.') }}</p>
                </div>
            @empty
                <p class="text-center text-gray-500 py-4">Belum ada data</p>
            @endforelse
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

        // 1. Sales Chart (Pendapatan)
        const ctx = document.getElementById('salesChart').getContext('2d');
        const dailyData = @json($salesData['daily'] ?? []);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(dailyData),
                datasets: [{
                    label: 'Pendapatan',
                    data: Object.values(dailyData).map(d => d.total),
                    backgroundColor: 'rgba(92, 106, 196, 0.6)',
                    borderColor: '#5c6ac4',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
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
                        ticks: {
                            callback: function(value) {
                                return formatCurrency(value);
                            }
                        }
                    }
                }
            }
        });

        // 2. Quantity Chart (Jumlah Barang Terjual)
        const quantityCtx = document.getElementById('quantityChart').getContext('2d');
        const quantityData = @json($salesData['quantity_sold'] ?? []);

        new Chart(quantityCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(quantityData),
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: Object.values(quantityData).map(d => d.total),
                    backgroundColor: 'rgba(0, 128, 96, 0.6)',
                    borderColor: '#008060',
                    borderWidth: 2,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
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
                        ticks: {
                            callback: function(value) {
                                return formatQuantity(value);
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection