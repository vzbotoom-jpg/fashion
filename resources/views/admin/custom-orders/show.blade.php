@extends('layouts.admin')

@section('title', 'Detail Custom Order - Admin Panel')
@section('page_title', 'Detail Custom Order')
@section('page_subtitle', '#' . $customOrder->order_number)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Info -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Informasi Custom Order
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="font-medium text-gray-800">{{ $customOrder->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="badge {{ $customOrder->status === 'completed' ? 'badge-success' : ($customOrder->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                        {{ $customOrder->status_label }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pelanggan</p>
                    <p class="font-medium text-gray-800">{{ $customOrder->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Order</p>
                    <p class="font-medium text-gray-800">{{ $customOrder->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Ukuran</p>
                    <p class="font-medium text-gray-800">{{ $customOrder->size->name }} ({{ $customOrder->size->code }})</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jumlah</p>
                    <p class="font-medium text-gray-800">{{ $customOrder->quantity }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Estimasi Selesai</p>
                    <p class="font-medium text-gray-800">{{ $customOrder->estimated_completion_date ? $customOrder->estimated_completion_date->format('d M Y') : 'Menunggu' }}</p>
                </div>
                @if($customOrder->price_quote)
                    <div>
                        <p class="text-sm text-gray-500">Harga Quote</p>
                        <p class="font-medium text-primary">Rp {{ number_format($customOrder->price_quote, 0, ',', '.') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Custom Description -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                Deskripsi Custom
            </h3>
            <p class="text-gray-700">{{ $customOrder->custom_description }}</p>
            @if($customOrder->custom_image)
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-2">Gambar Referensi</p>
                    <a href="{{ asset('storage/' . $customOrder->custom_image) }}" target="_blank" class="inline-block">
                        <img src="{{ asset('storage/' . $customOrder->custom_image) }}" 
                             alt="Custom image" 
                             class="w-48 h-48 object-cover rounded-lg border border-gray-200">
                    </a>
                </div>
            @endif
        </div>

        <!-- Shipping Info -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                Alamat Pengiriman
            </h3>
            <p class="text-gray-700">{{ $customOrder->shipping_address }}</p>
            <p class="text-gray-700 mt-1 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                {{ $customOrder->phone }}
            </p>
            @if($customOrder->notes)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500">Catatan Pelanggan</p>
                    <p class="text-gray-700">{{ $customOrder->notes }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="space-y-6">
        <!-- Status Update -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                </svg>
                Update Status
            </h3>
            <form action="{{ route('admin.custom-orders.process', $customOrder->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <x-form.select 
                        name="status" 
                        label="Status" 
                        :options="[
                            ['id' => 'pending', 'name' => 'Menunggu'],
                            ['id' => 'review', 'name' => 'Review'],
                            ['id' => 'design', 'name' => 'Desain'],
                            ['id' => 'production', 'name' => 'Produksi'],
                            ['id' => 'shipped', 'name' => 'Dikirim'],
                            ['id' => 'completed', 'name' => 'Selesai'],
                            ['id' => 'cancelled', 'name' => 'Dibatalkan'],
                        ]"
                        optionValue="id"
                        optionLabel="name"
                        value="{{ $customOrder->status }}"
                        required
                    />
                    <x-form.input 
                        type="number"
                        name="price_quote" 
                        label="Harga Quote" 
                        value="{{ $customOrder->price_quote }}"
                        placeholder="Masukkan harga quote"
                    />
                    <x-form.textarea 
                        name="notes" 
                        label="Catatan Admin" 
                        placeholder="Tambahkan catatan jika ada"
                        rows="2"
                    />
                    <button type="submit" class="w-full btn-primary py-2 rounded-lg flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Update Status
                    </button>
                </div>
            </form>
        </div>

        <!-- Back -->
        <a href="{{ route('admin.custom-orders.index') }}" class="block text-center btn-secondary py-3 rounded-lg flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar
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