@extends('layouts.app')

@section('title', 'Pre-Order Berhasil - ' . config('app.name'))

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <!-- Success Icon -->
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <h1 class="text-3xl font-display font-bold text-gray-800 mb-2 flex items-center justify-center gap-2">
                    <!-- Party Popper Icon -->
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                    </svg>
                    Pre-Order Berhasil!
                </h1>
                <p class="text-gray-500 mb-6">Pre-order Anda telah berhasil dibuat. Tim kami akan segera memprosesnya.</p>

                <!-- Order Info -->
                <div class="bg-gray-50 rounded-lg p-6 text-left mb-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nomor Order</p>
                            <p class="font-semibold text-gray-800">{{ $preOrder->order_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="font-semibold text-yellow-600">Menunggu Konfirmasi</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Produk</p>
                            <p class="font-semibold text-gray-800">{{ $preOrder->product->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Ukuran</p>
                            <p class="font-semibold text-gray-800">{{ $preOrder->size->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah</p>
                            <p class="font-semibold text-gray-800">{{ $preOrder->quantity }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Estimasi Selesai</p>
                            <p class="font-semibold text-gray-800">{{ $preOrder->estimated_completion_date ? $preOrder->estimated_completion_date->format('d M Y') : 'Menunggu' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('customer.orders.index') }}" class="btn-primary px-6 py-3 rounded-lg inline-block flex items-center justify-center gap-2">
                        <!-- Package Icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Lihat Pesanan Saya
                    </a>
                    <a href="{{ route('products.index') }}" class="btn-secondary px-6 py-3 rounded-lg inline-block flex items-center justify-center gap-2">
                        <!-- Shopping Bag Icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Lanjut Belanja
                    </a>
                </div>

                <!-- WhatsApp Contact -->
                <div class="mt-6 p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-gray-600 flex items-center justify-center gap-2">
                        <!-- Phone Icon -->
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Ada pertanyaan? Hubungi kami via 
                        <a href="#" class="text-green-600 font-medium hover:underline">WhatsApp</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection