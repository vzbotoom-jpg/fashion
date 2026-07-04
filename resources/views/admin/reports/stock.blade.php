@extends('layouts.admin')

@section('title', 'Laporan Stok - Admin Panel')
@section('page_title', 'Laporan Stok')
@section('page_subtitle', 'Monitoring stok produk')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Total produk: {{ $products->total() }}</p>
            <p class="text-sm text-red-500">⚠️ Stok rendah: {{ $lowStockProducts->count() }}</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-primary hover:underline text-sm">
            Kelola Stok →
        </a>
    </div>
</div>

<!-- Low Stock Alert -->
@if($lowStockProducts->isNotEmpty())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
        <div class="flex items-start">
            <span class="text-red-500 mr-3">⚠️</span>
            <div>
                <h4 class="font-medium text-red-800">Stok Rendah!</h4>
                <p class="text-sm text-red-700">Berikut produk yang stoknya di bawah minimum:</p>
                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                    @foreach($lowStockProducts->take(5) as $item)
                        <li>{{ $item->name }} - Stok: {{ $item->stock }} (Min: {{ $item->min_stock }})</li>
                    @endforeach
                    @if($lowStockProducts->count() > 5)
                        <li>... dan {{ $lowStockProducts->count() - 5 }} produk lainnya</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif

<!-- Stock Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ukuran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">{{ $item->name }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->sku }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            @php
                                $size = \App\Models\Size::find($item->size_id);
                            @endphp
                            {{ $size ? $size->name : '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                            {{ $item->stock }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->min_stock }}</td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $item->stock > $item->min_stock ? 'badge-success' : 'badge-danger' }}">
                                {{ $item->stock > $item->min_stock ? 'Aman' : 'Rendah' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <span class="text-4xl block mb-2">📦</span>
                            Tidak ada data stok
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $products->links() }}
    </div>
</div>

<style>
    .badge {
        @apply px-2 py-0.5 rounded-full text-xs font-medium;
    }
    .badge-success {
        @apply bg-green-100 text-green-800;
    }
    .badge-danger {
        @apply bg-red-100 text-red-800;
    }
</style>
@endsection