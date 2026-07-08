@extends('layouts.admin')

@section('title', 'Update Stok - Admin Panel')
@section('page_title', 'Update Stok')
@section('page_subtitle', 'Kelola stok semua produk secara terpusat')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $product->sku }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $product->total_stock > 0 ? 'badge-success' : 'badge-danger' }}">
                                {{ $product->total_stock }} unit
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">
                                {{ $product->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.products.stock.edit', $product->id) }}" 
                               class="btn-primary !py-1.5 !px-4 !text-xs rounded-lg inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Update Stok
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Belum ada produk
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