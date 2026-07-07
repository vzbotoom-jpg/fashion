@extends('layouts.admin')

@section('title', 'Analitik - Admin Panel')
@section('page_title', 'Analitik')
@section('page_subtitle', 'Dashboard analitik lengkap')

@section('content')
<!-- Period Filter -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <form action="{{ route('admin.analytics') }}" method="GET" class="flex items-center gap-4">
        <label class="text-sm font-medium text-gray-700">Periode (hari):</label>
        <select name="period" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
            <option value="7" {{ ($period ?? 30) == 7 ? 'selected' : '' }}>7 Hari</option>
            <option value="14" {{ ($period ?? 30) == 14 ? 'selected' : '' }}>14 Hari</option>
            <option value="30" {{ ($period ?? 30) == 30 ? 'selected' : '' }}>30 Hari</option>
            <option value="60" {{ ($period ?? 30) == 60 ? 'selected' : '' }}>60 Hari</option>
            <option value="90" {{ ($period ?? 30) == 90 ? 'selected' : '' }}>90 Hari</option>
        </select>
        <button type="submit" class="btn-primary px-4 py-2 rounded-lg flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Tampilkan
        </button>
    </form>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-4">
        <p class="text-sm text-gray-500">Daily Visitors</p>
        <p class="text-2xl font-bold text-gray-800">
            {{ collect($analytics['daily_visitors'] ?? [])->sum('visitors') }}
        </p>
        <p class="text-xs text-green-500">+12% dari periode sebelumnya</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4">
        <p class="text-sm text-gray-500">Conversion Rate</p>
        <p class="text-2xl font-bold text-gray-800">{{ $analytics['conversion_rate'] ?? 0 }}%</p>
        <p class="text-xs text-green-500">+2.3% dari periode sebelumnya</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4">
        <p class="text-sm text-gray-500">Avg Order Value</p>
        <p class="text-2xl font-bold text-primary">Rp {{ number_format($analytics['average_order_value'] ?? 0, 0, ',', '.') }}</p>
        <p class="text-xs text-green-500">+5.1% dari periode sebelumnya</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4">
        <p class="text-sm text-gray-500">Customer Retention</p>
        <p class="text-2xl font-bold text-gray-800">{{ $analytics['customer_retention'] ?? 0 }}%</p>
        <p class="text-xs text-green-500">+1.8% dari periode sebelumnya</p>
    </div>
</div>

<!-- Charts: Sales Trends & Quantity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            Sales Trends (Pendapatan)
        </h3>
        <canvas id="salesTrendsChart" height="200"></canvas>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Jumlah Barang Terjual
        </h3>
        <canvas id="quantityChart" height="200"></canvas>
    </div>
</div>

<!-- Charts: Category Performance -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
            </svg>
            Category Performance (Pendapatan)
        </h3>
        <canvas id="categoryChart" height="200"></canvas>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            Kategori Terlaris (Jumlah)
        </h3>
        <canvas id="categoryQuantityChart" height="200"></canvas>
    </div>
</div>

<!-- Additional Stats -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            Customer Demographics
        </h3>
        <div class="space-y-3">
            <div>
                <p class="text-sm text-gray-500">Total Customers</p>
                <p class="text-xl font-bold text-gray-800">{{ $analytics['customer_demographics']['total'] ?? 0 }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Top Cities</p>
                @foreach(($analytics['customer_demographics']['by_city'] ?? []) as $city)
                    <div class="flex items-center justify-between text-sm">
                        <span>{{ $city->city ?? '-' }}</span>
                        <span class="font-medium">{{ $city->total ?? 0 }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Order Stats
        </h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Pre-Orders</span>
                <span class="font-medium">{{ $analytics['pre_order_stats']['total'] ?? 0 }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Pending</span>
                <span class="font-medium text-yellow-600">{{ $analytics['pre_order_stats']['pending'] ?? 0 }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Completed</span>
                <span class="font-medium text-green-600">{{ $analytics['pre_order_stats']['completed'] ?? 0 }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Custom Orders</span>
                <span class="font-medium">{{ $analytics['custom_order_stats']['total'] ?? 0 }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Payment Methods
        </h3>
        <div class="space-y-3">
            @foreach(($analytics['payment_method_stats'] ?? []) as $method)
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">{{ ucfirst(str_replace('_', ' ', $method->payment_method ?? 'Unknown')) }}</span>
                    <div class="flex items-center gap-2">
                        <span class="font-medium">{{ $method->total ?? 0 }}</span>
                        <span class="text-xs text-gray-400">(Rp {{ number_format($method->total_amount ?? 0, 0, ',', '.') }})</span>
                    </div>
                </div>
            @endforeach
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

        // 1. Sales Trends Chart (Pendapatan)
        const trendsData = @json($analytics['sales_trends'] ?? []);
        if (document.getElementById('salesTrendsChart')) {
            new Chart(document.getElementById('salesTrendsChart'), {
                type: 'line',
                data: {
                    labels: trendsData.map(d => d.label),
                    datasets: [{
                        label: 'Pendapatan',
                        data: trendsData.map(d => d.revenue),
                        borderColor: '#5c6ac4',
                        backgroundColor: 'rgba(92, 106, 196, 0.1)',
                        fill: true,
                        tension: 0.4
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
        }

        // 2. Quantity Chart (Jumlah Barang Terjual)
        const quantityData = @json($analytics['quantity_sold'] ?? []);
        if (document.getElementById('quantityChart')) {
            new Chart(document.getElementById('quantityChart'), {
                type: 'bar',
                data: {
                    labels: quantityData.map(d => d.label),
                    datasets: [{
                        label: 'Jumlah Terjual',
                        data: quantityData.map(d => d.quantity),
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
        }

        // 3. Category Chart (Pendapatan)
        const categoryData = @json($analytics['category_performance'] ?? []);
        if (document.getElementById('categoryChart')) {
            new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: categoryData.map(d => d.name),
                    datasets: [{
                        data: categoryData.map(d => d.total_revenue),
                        backgroundColor: ['#5c6ac4', '#ff6b6b', '#f39c12', '#2ecc71', '#3498db', '#9b59b6']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { font: { size: 10 } }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + formatCurrency(context.parsed);
                                }
                            }
                        }
                    }
                }
            });
        }

        // 4. Category Quantity Chart (Jumlah per Kategori)
        const categoryQuantityData = @json($analytics['category_quantity'] ?? []);
        if (document.getElementById('categoryQuantityChart')) {
            new Chart(document.getElementById('categoryQuantityChart'), {
                type: 'doughnut',
                data: {
                    labels: categoryQuantityData.map(d => d.name),
                    datasets: [{
                        data: categoryQuantityData.map(d => d.total_quantity),
                        backgroundColor: ['#008060', '#2ecc71', '#f39c12', '#3498db', '#9b59b6', '#e74c3c']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { font: { size: 10 } }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + formatQuantity(context.parsed) + ' unit';
                                }
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