@extends('layouts.admin')

@section('title', 'Detail Pembayaran - Admin Panel')
@section('page_title', 'Detail Pembayaran')
@section('page_subtitle', 'Order #' . $payment->order->order_number)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Payment Info -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Informasi Pembayaran
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="font-medium text-gray-800">{{ $payment->order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="badge {{ $payment->status === 'completed' ? 'badge-success' : ($payment->status === 'failed' || $payment->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                        {{ $payment->status_label }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Metode Pembayaran</p>
                    <p class="font-medium text-gray-800">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kode Pembayaran</p>
                    <p class="font-medium text-gray-800">{{ $payment->payment_code ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jumlah</p>
                    <p class="text-xl font-bold text-primary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal</p>
                    <p class="font-medium text-gray-800">{{ $payment->created_at->format('d M Y H:i') }}</p>
                </div>
                @if($payment->paid_at)
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Bayar</p>
                        <p class="font-medium text-gray-800">{{ $payment->paid_at->format('d M Y H:i') }}</p>
                    </div>
                @endif
                @if($payment->expired_at)
                    <div>
                        <p class="text-sm text-gray-500">Kadaluarsa</p>
                        <p class="font-medium text-gray-800">{{ $payment->expired_at->format('d M Y H:i') }}</p>
                    </div>
                @endif
            </div>
            @if($payment->notes)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500">Catatan</p>
                    <p class="text-gray-700">{{ $payment->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Order Info -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Informasi Order
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Pelanggan</p>
                    <p class="font-medium text-gray-800">{{ $payment->order->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-800">{{ $payment->order->user->email }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-sm text-gray-500">Alamat Pengiriman</p>
                    <p class="font-medium text-gray-800">{{ $payment->order->shipping_address }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="space-y-4">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h4 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                </svg>
                Aksi
            </h4>
            <div class="space-y-3">
                @if($payment->status === 'pending')
                    <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Verifikasi Pembayaran
                        </button>
                    </form>
                @endif

                @if($payment->status === 'completed')
                    <form action="{{ route('admin.payments.refund', $payment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin refund pembayaran ini?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2z"/>
                            </svg>
                            Refund Pembayaran
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <a href="{{ route('admin.payments.index') }}" class="block text-center btn-secondary py-3 rounded-lg flex items-center justify-center gap-2">
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