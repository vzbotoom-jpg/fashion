@extends('layouts.admin')

@section('title', 'Manajemen Custom Order - Admin Panel')
@section('page_title', 'Custom Order')
@section('page_subtitle', 'Kelola semua custom order')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: {{ $customOrders->total() }} custom order</p>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <form action="{{ route('admin.custom-orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
            <option value="">Semua Status</option>
            @foreach($statuses ?? [] as $status)
                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        <input type="text" name="search" placeholder="Cari order number..." value="{{ request('search') }}" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
        <button type="submit" class="btn-primary px-4 py-2 rounded-lg">🔍 Filter</button>
    </form>
</div>

<!-- Custom Orders Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($customOrders as $customOrder)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">{{ $customOrder->order_number }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $customOrder->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                            {{ Str::limit($customOrder->custom_description, 50) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $customOrder->status === 'completed' ? 'badge-success' : ($customOrder->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                {{ $customOrder->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $customOrder->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.custom-orders.show', $customOrder->id) }}" class="text-primary hover:underline text-sm">
                                Detail →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <span class="text-4xl block mb-2">🎨</span>
                            Belum ada custom order
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $customOrders->links() }}
    </div>
</div>

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
    .badge-danger {
        @apply bg-red-100 text-red-800;
    }
</style>
@endsection