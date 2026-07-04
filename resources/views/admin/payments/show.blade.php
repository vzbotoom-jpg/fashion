@extends('layouts.admin')

@section('title', 'Detail Pembayaran - Admin Panel')
@section('page_title', 'Detail Pembayaran')
@section('page_subtitle', 'Order #' . $payment->order->order_number)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Payment Info -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">💳 Informasi Pembayaran</h3>
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
            <h3 class="font-semibold text-gray-800 mb-4">📦 Informasi Order</h3>
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
            <h4 class="font-semibold text-gray-800 mb-4">⚙️ Aksi</h4>
            <div class="space-y-3">
                @if($payment->status === 'pending')
                    <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition">
                            ✅ Verifikasi Pembayaran
                        </button>
                    </form>
                @endif

                @if($payment->status === 'completed')
                    <form action="{{ route('admin.payments.refund', $payment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin refund pembayaran ini?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg transition">
                            ↩️ Refund Pembayaran
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <a href="{{ route('admin.payments.index') }}" class="block text-center btn-secondary py-3 rounded-lg">
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