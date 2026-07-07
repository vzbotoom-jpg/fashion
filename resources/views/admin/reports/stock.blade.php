@extends('layouts.admin')

@section('title', 'Laporan Stok - Admin Panel')
@section('page_title', 'Laporan Stok')
@section('page_subtitle', 'Monitoring stok produk')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Total produk: {{ $products->total() }}</p>
            <p class="text-sm text-red-500 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                Stok rendah: {{ $lowStockProducts->count() }}
            </p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
            Kelola Stok
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</div>

<!-- Low Stock Alert -->
@if($lowStockProducts->isNotEmpty())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
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
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
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