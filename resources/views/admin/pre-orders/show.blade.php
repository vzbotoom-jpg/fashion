@extends('layouts.admin')

@section('title', 'Detail Pre-Order - Admin Panel')
@section('page_title', 'Detail Pre-Order')
@section('page_subtitle', '#' . $preOrder->order_number)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Info -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">📋 Informasi Pre-Order</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="font-medium text-gray-800">{{ $preOrder->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="badge {{ $preOrder->status === 'completed' ? 'badge-success' : ($preOrder->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                        {{ $preOrder->status_label }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pelanggan</p>
                    <p class="font-medium text-gray-800">{{ $preOrder->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Order</p>
                    <p class="font-medium text-gray-800">{{ $preOrder->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Produk</p>
                    <p class="font-medium text-gray-800">{{ $preOrder->product->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Ukuran</p>
                    <p class="font-medium text-gray-800">{{ $preOrder->size->name }} ({{ $preOrder->size->code }})</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jumlah</p>
                    <p class="font-medium text-gray-800">{{ $preOrder->quantity }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Estimasi Selesai</p>
                    <p class="font-medium text-gray-800">{{ $preOrder->estimated_completion_date ? $preOrder->estimated_completion_date->format('d M Y') : 'Menunggu' }}</p>
                </div>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">📍 Alamat Pengiriman</h3>
            <p class="text-gray-700">{{ $preOrder->shipping_address }}</p>
            <p class="text-gray-700 mt-1">📞 {{ $preOrder->phone }}</p>
            @if($preOrder->notes)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500">Catatan Pelanggan</p>
                    <p class="text-gray-700">{{ $preOrder->notes }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="space-y-6">
        <!-- Status Update -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">⚙️ Update Status</h3>
            <form action="{{ route('admin.pre-orders.process', $preOrder->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <x-form.select 
                        name="status" 
                        label="Status" 
                        :options="[
                            ['id' => 'pending', 'name' => 'Menunggu'],
                            ['id' => 'processing', 'name' => 'Diproses'],
                            ['id' => 'production', 'name' => 'Produksi'],
                            ['id' => 'shipped', 'name' => 'Dikirim'],
                            ['id' => 'completed', 'name' => 'Selesai'],
                            ['id' => 'cancelled', 'name' => 'Dibatalkan'],
                        ]"
                        optionValue="id"
                        optionLabel="name"
                        value="{{ $preOrder->status }}"
                        required
                    />
                    <x-form.textarea 
                        name="notes" 
                        label="Catatan Admin" 
                        placeholder="Tambahkan catatan jika ada"
                        rows="2"
                    />
                    <button type="submit" class="w-full btn-primary py-2 rounded-lg">
                        💾 Update Status
                    </button>
                </div>
            </form>
        </div>

        <!-- Back -->
        <a href="{{ route('admin.pre-orders.index') }}" class="block text-center btn-secondary py-3 rounded-lg">
            ← Kembali ke Daftar
        </a>
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