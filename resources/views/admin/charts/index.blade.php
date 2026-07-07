@extends('layouts.admin')

@section('title', 'Analisis Chart - Admin Panel')
@section('page_title', 'Analisis Chart')
@section('page_subtitle', 'Visualisasi data penjualan lengkap dengan fitur interaktif')

@section('content')
<style>
    .chart-container {
        position: relative;
        height: 500px;
        width: 100%;
    }
    .chart-controls {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }
    .chart-controls select, .chart-controls input {
        padding: 8px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13px;
        background: white;
        outline: none;
        transition: all 0.2s;
    }
    .chart-controls select:focus, .chart-controls input:focus {
        border-color: #008060;
        box-shadow: 0 0 0 3px rgba(0,128,96,0.1);
    }
    .chart-controls label {
        font-size: 13px;
        font-weight: 500;
        color: #374151;
    }
    .btn-chart {
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        background: #008060;
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-chart:hover {
        background: #006e52;
    }
    .btn-chart-outline {
        background: transparent;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    .btn-chart-outline:hover {
        background: #f3f4f6;
    }
    .btn-chart-danger {
        background: #ef4444;
        color: white;
    }
    .btn-chart-danger:hover {
        background: #dc2626;
    }
    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }
    .summary-card {
        background: white;
        padding: 16px 20px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        text-align: center;
    }
    .summary-card .value {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
    }
    .summary-card .label {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }
    .summary-card.revenue .value { color: #008060; }
    .summary-card.quantity .value { color: #3b82f6; }

    .chart-toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 8px 0 16px 0;
        border-bottom: 1px solid #f3f4f6;
        margin-bottom: 16px;
    }
    .chart-toolbar .left {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .chart-toolbar .right {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-icon {
        padding: 6px 10px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        background: white;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-icon:hover {
        background: #f9fafb;
        border-color: #008060;
    }
    .btn-icon.active {
        background: #008060;
        color: white;
        border-color: #008060;
    }
    .btn-icon svg {
        width: 16px;
        height: 16px;
    }
    
    .chart-fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        background: white;
        padding: 30px;
    }
    .chart-fullscreen .chart-container {
        height: calc(100vh - 120px) !important;
    }
</style>

<!-- Summary Cards -->
<div class="summary-cards">
    <div class="summary-card revenue">
        <div class="value">Rp {{ number_format($summary['total_revenue'] ?? 0, 0, ',', '.') }}</div>
        <div class="label">Total Pendapatan</div>
    </div>
    <div class="summary-card quantity">
        <div class="value">{{ number_format($summary['total_quantity'] ?? 0, 0, ',', '.') }}</div>
        <div class="label">Total Barang Terjual</div>
    </div>
    <div class="summary-card">
        <div class="value">Rp {{ number_format($summary['avg_revenue'] ?? 0, 0, ',', '.') }}</div>
        <div class="label">Rata-rata Pendapatan/Hari</div>
    </div>
    <div class="summary-card">
        <div class="value">{{ number_format($summary['avg_quantity'] ?? 0, 0, ',', '.') }}</div>
        <div class="label">Rata-rata Terjual/Hari</div>
    </div>
    <div class="summary-card">
        <div class="value">Rp {{ number_format($summary['highest_revenue'] ?? 0, 0, ',', '.') }}</div>
        <div class="label">Pendapatan Tertinggi</div>
    </div>
    <div class="summary-card">
        <div class="value">{{ number_format($summary['highest_quantity'] ?? 0, 0, ',', '.') }}</div>
        <div class="label">Terjual Tertinggi</div>
    </div>
</div>

<!-- Controls -->
<div class="chart-controls">
    <form action="{{ route('admin.charts') }}" method="GET" class="flex flex-wrap items-center gap-3">
        <label>Tahun:</label>
        <select name="year">
            @foreach($availableYears as $y)
                <option value="{{ $y }}" {{ ($year ?? date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>

        <label>Bulan:</label>
        <select name="month">
            <option value="">Semua Bulan</option>
            @foreach($availableMonths as $m => $name)
                <option value="{{ $m }}" {{ ($month ?? '') == $m ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>

        <label>Periode:</label>
        <select name="period">
            <option value="7" {{ ($period ?? 30) == 7 ? 'selected' : '' }}>7 Hari</option>
            <option value="14" {{ ($period ?? 30) == 14 ? 'selected' : '' }}>14 Hari</option>
            <option value="30" {{ ($period ?? 30) == 30 ? 'selected' : '' }}>30 Hari</option>
            <option value="60" {{ ($period ?? 30) == 60 ? 'selected' : '' }}>60 Hari</option>
            <option value="90" {{ ($period ?? 30) == 90 ? 'selected' : '' }}>90 Hari</option>
            <option value="180" {{ ($period ?? 30) == 180 ? 'selected' : '' }}>180 Hari</option>
            <option value="365" {{ ($period ?? 30) == 365 ? 'selected' : '' }}>1 Tahun</option>
        </select>

        <button type="submit" class="btn-chart">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Tampilkan
        </button>
        <a href="{{ route('admin.charts') }}" class="btn-chart btn-chart-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Reset
        </a>
    </form>
</div>

<!-- Chart Revenue -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="chart-toolbar">
        <div class="left">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-bold text-gray-800">Pendapatan</span>
            <span class="text-xs text-gray-400">(periode {{ $period ?? 30 }} hari)</span>
        </div>
        <div class="right">
            <button class="btn-icon" onclick="toggleFullscreen()" title="Fullscreen">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"/>
                </svg>
            </button>
            <button class="btn-icon" onclick="resetZoom()" title="Reset Zoom">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </button>
            <button class="btn-icon" onclick="exportChart()" title="Export PNG">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="chart-container" id="revenueChartContainer">
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<!-- Chart Quantity -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-6">
    <div class="chart-toolbar">
        <div class="left">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span class="font-bold text-gray-800">Jumlah Barang Terjual</span>
            <span class="text-xs text-gray-400">(periode {{ $period ?? 30 }} hari)</span>
        </div>
        <div class="right">
            <button class="btn-icon" onclick="toggleFullscreenQuantity()" title="Fullscreen">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"/>
                </svg>
            </button>
            <button class="btn-icon" onclick="resetZoomQuantity()" title="Reset Zoom">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </button>
            <button class="btn-icon" onclick="exportQuantityChart()" title="Export PNG">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="chart-container" id="quantityChartContainer">
        <canvas id="quantityChart"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.1/dist/chartjs-plugin-zoom.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function formatQuantity(value) {
        if (value >= 1000000) return (value / 1000000).toFixed(1) + ' JT';
        else if (value >= 1000) return (value / 1000).toFixed(0) + ' RB';
        else return value.toFixed(0);
    }

    function formatCurrency(value) {
        if (value >= 1000000000) return 'Rp ' + (value / 1000000000).toFixed(1) + ' M';
        else if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(1) + ' JT';
        else if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + ' RB';
        else return 'Rp ' + value.toFixed(0);
    }

    const revenueLabels = @json(array_keys($revenueData));
    const revenueValues = @json(array_values($revenueData));
    const quantityValues = @json(array_values($quantityData));

    // REVENUE CHART
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const gradient = revenueCtx.createLinearGradient(0, 0, 0, 500);
    gradient.addColorStop(0, 'rgba(0, 128, 96, 0.3)');
    gradient.addColorStop(0.5, 'rgba(0, 128, 96, 0.1)');
    gradient.addColorStop(1, 'rgba(0, 128, 96, 0)');

    window.revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Pendapatan',
                data: revenueValues,
                borderColor: '#008060',
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#008060',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                backgroundColor: gradient,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a1a1a',
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 12 },
                    padding: 14,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return '💰 ' + formatCurrency(context.parsed.y);
                        }
                    }
                },
                zoom: {
                    pan: { enabled: true, mode: 'x' },
                    zoom: { wheel: { enabled: true, speed: 0.05 }, pinch: { enabled: true }, mode: 'x' },
                    limits: { x: { minRange: 3 } }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    ticks: {
                        font: { size: 11 },
                        color: '#6b7280',
                        callback: function(value) { return formatCurrency(value); }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 10 },
                        color: '#6b7280',
                        maxTicksLimit: 20,
                        maxRotation: 45,
                        minRotation: 0
                    }
                }
            }
        },
        plugins: [ChartZoom]
    });

    // QUANTITY CHART
    const quantityCtx = document.getElementById('quantityChart').getContext('2d');

    window.quantityChart = new Chart(quantityCtx, {
        type: 'bar',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Jumlah Terjual',
                data: quantityValues,
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: '#3b82f6',
                borderWidth: 2,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a1a1a',
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 12 },
                    padding: 14,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return '📦 ' + formatQuantity(context.parsed.y) + ' unit';
                        }
                    }
                },
                zoom: {
                    pan: { enabled: true, mode: 'x' },
                    zoom: { wheel: { enabled: true, speed: 0.05 }, pinch: { enabled: true }, mode: 'x' },
                    limits: { x: { minRange: 3 } }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    ticks: {
                        font: { size: 11 },
                        color: '#6b7280',
                        callback: function(value) { return formatQuantity(value); }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 10 },
                        color: '#6b7280',
                        maxTicksLimit: 20,
                        maxRotation: 45,
                        minRotation: 0
                    }
                }
            }
        },
        plugins: [ChartZoom]
    });
});

// INTERAKSI
function toggleFullscreen() {
    const container = document.getElementById('revenueChartContainer');
    if (!document.fullscreenElement) {
        container.requestFullscreen().catch(() => container.classList.toggle('chart-fullscreen'));
    } else {
        document.exitFullscreen();
        container.classList.remove('chart-fullscreen');
    }
}

function toggleFullscreenQuantity() {
    const container = document.getElementById('quantityChartContainer');
    if (!document.fullscreenElement) {
        container.requestFullscreen().catch(() => container.classList.toggle('chart-fullscreen'));
    } else {
        document.exitFullscreen();
        container.classList.remove('chart-fullscreen');
    }
}

function resetZoom() { if (window.revenueChart) window.revenueChart.resetZoom(); }
function resetZoomQuantity() { if (window.quantityChart) window.quantityChart.resetZoom(); }

function exportChart() {
    const canvas = document.getElementById('revenueChart');
    const link = document.createElement('a');
    link.download = 'chart-pendapatan.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
}

function exportQuantityChart() {
    const canvas = document.getElementById('quantityChart');
    const link = document.createElement('a');
    link.download = 'chart-barang-terjual.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.chart-fullscreen').forEach(el => el.classList.remove('chart-fullscreen'));
    }
});
</script>
@endpush
@endsection