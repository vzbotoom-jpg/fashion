@extends('layouts.app')

@section('title', 'Pembayaran - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                <!-- Header -->
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-display font-bold text-gray-800">Selesaikan Pembayaran</h1>
                    <p class="text-gray-500 mt-1">Order #{{ $payment->order->order_number }}</p>
                    <p class="text-sm text-gray-500">
                        Total: <span class="font-bold text-primary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                    </p>
                </div>

                <!-- Payment Status -->
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-yellow-700 font-medium">Menunggu Pembayaran</p>
                            <p class="text-xs text-yellow-600 mt-1">
                                Silakan selesaikan pembayaran Anda melalui halaman berikut. 
                                Anda akan diarahkan ke halaman pembayaran Midtrans.
                            </p>
                            <p class="text-xs text-yellow-600 mt-1">
                                ⏱️ Batas waktu: {{ $payment->expired_at ? $payment->expired_at->format('d M Y H:i') : '24 jam' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Midtrans Snap Container -->
                <div id="snap-container" class="min-h-[400px] flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-300 animate-spin mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <p class="text-gray-500 mt-4">Memuat halaman pembayaran...</p>
                        <p class="text-xs text-gray-400 mt-1">Jika tidak muncul dalam beberapa detik, klik tombol di bawah</p>
                    </div>
                </div>

                <!-- Fallback Button -->
                <div class="text-center mt-6">
                    <button id="pay-now-btn" class="btn-primary px-8 py-3 rounded-lg inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Bayar Sekarang
                    </button>
                </div>

                <!-- Back Button -->
                <div class="mt-6 text-center">
                    <a href="{{ route('customer.orders.show', $payment->order_id) }}" class="text-sm text-gray-500 hover:text-gray-700 transition flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Detail Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<!-- Midtrans Snap JS -->
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const snapToken = '{{ $payment->snap_token }}';
        const payBtn = document.getElementById('pay-now-btn');
        const container = document.getElementById('snap-container');

        function openPayment() {
            if (typeof snap !== 'undefined' && snapToken) {
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        window.location.href = '{{ route("payment.midtrans.success") }}?order_id=' + result.order_id;
                    },
                    onPending: function(result) {
                        window.location.href = '{{ route("payment.midtrans.pending") }}?order_id=' + result.order_id;
                    },
                    onError: function(result) {
                        window.location.href = '{{ route("payment.midtrans.error") }}?order_id=' + result.order_id;
                    },
                    onClose: function() {
                        // Optional: handle when user closes popup
                        console.log('Payment popup closed');
                    }
                });
            } else {
                alert('Halaman pembayaran tidak tersedia. Silakan coba lagi.');
            }
        }

        // Auto open payment
        setTimeout(function() {
            // Remove loading spinner
            container.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-primary mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-600">Klik tombol "Bayar Sekarang" untuk melanjutkan</p>
                </div>
            `;
        }, 5000);

        // Pay button click
        payBtn.addEventListener('click', openPayment);
    });
</script>
@endpush
@endsection