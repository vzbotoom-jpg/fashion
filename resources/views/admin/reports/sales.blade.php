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
            <button type="submit" class="btn-primary px-6 py-2 rounded-lg w-full">
                📊 Tampilkan Laporan
            </button>
        </div>
    </form>
</div>

<!-- Sales Chart -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <h3 class="font-semibold text-gray-800 mb-4">📈 Grafik Penjualan Harian</h3>
    <canvas id="salesChart" height="200"></canvas>
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
        <h3 class="font-semibold text-gray-800 mb-4">🏆 Produk Terlaris</h3>
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
        <h3 class="font-semibold text-gray-800 mb-4">📊 Penjualan per Kategori</h3>
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
        const ctx = document.getElementById('salesChart').getContext('2d');
        const dailyData = @json($salesData['daily'] ?? []);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(dailyData),
                datasets: [{
                    label: 'Revenue',
                    data: Object.values(dailyData).map(d => d.total),
                    backgroundColor: 'rgba(92, 106, 196, 0.6)',
                    borderColor: '#5c6ac4',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
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
@endsection