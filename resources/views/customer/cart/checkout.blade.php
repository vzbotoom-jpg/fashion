@extends('layouts.app')

@section('title', 'Checkout - ' . config('app.name'))

@section('content')
<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header -->
        <div class="mb-16 text-center max-w-3xl mx-auto">
            <h1 class="section-title">Konfirmasi Checkout</h1>
            <p class="section-subtitle">Lengkapi detail pengiriman dan selesaikan pembayaran untuk memproses pesanan Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="p-0">
                    <form action="{{ route('customer.checkout.store') }}" method="POST" class="space-y-12">
                        @csrf

                        <!-- Shipping Address -->
                        <div class="bg-gray-50/50 p-8 rounded-2xl border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Alamat Pengiriman
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="shipping_address" value="{{ old('shipping_address', $user->address ?? '') }}"
                                           class="form-input" placeholder="Masukkan alamat lengkap pengiriman" required>
                                </div>
                                <div>
                                    <label class="form-label">Kota</label>
                                    <input type="text" name="city" value="{{ old('city', $user->city ?? '') }}"
                                           class="form-input" placeholder="Kota" required>
                                </div>
                                <div>
                                    <label class="form-label">Provinsi</label>
                                    <input type="text" name="province" value="{{ old('province', $user->province ?? '') }}"
                                           class="form-input" placeholder="Provinsi" required>
                                </div>
                                <div>
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code ?? '') }}"
                                           class="form-input" placeholder="Kode Pos" required>
                                </div>
                                <div>
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                           class="form-input" placeholder="Contoh: 081234567890" required>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        <!-- Payment Method -->
                        <div class="bg-gray-50/50 p-8 rounded-2xl border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Metode Pembayaran
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                <label class="relative block cursor-pointer group">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="peer sr-only" checked>
                                    <div class="p-5 border border-gray-200 rounded-2xl hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-primary/5 transition-all text-center">
                                        <span class="text-3xl mb-3 block">🏦</span>
                                        <span class="font-bold text-gray-900 text-sm">Transfer Bank</span>
                                    </div>
                                </label>
                                <label class="relative block cursor-pointer group">
                                    <input type="radio" name="payment_method" value="credit_card" class="peer sr-only">
                                    <div class="p-5 border border-gray-200 rounded-2xl hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-primary/5 transition-all text-center">
                                        <span class="text-3xl mb-3 block">💳</span>
                                        <span class="font-bold text-gray-900 text-sm">Kartu Kredit</span>
                                    </div>
                                </label>
                                <label class="relative block cursor-pointer group">
                                    <input type="radio" name="payment_method" value="e_wallet" class="peer sr-only">
                                    <div class="p-5 border border-gray-200 rounded-2xl hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-primary/5 transition-all text-center">
                                        <span class="text-3xl mb-3 block">📱</span>
                                        <span class="font-bold text-gray-900 text-sm">E-Wallet</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="form-label">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" rows="4" class="form-input" placeholder="Berikan instruksi khusus untuk pesanan atau pengiriman Anda jika ada">{{ old('notes') }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="pt-4">
                            <button type="submit" class="w-full btn-primary !py-5 text-lg flex items-center justify-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Selesaikan Pembayaran
                            </button>
                            <p class="text-center text-xs text-gray-500 mt-4">
                                Dengan menekan tombol di atas, Anda menyetujui <a href="#" class="underline">Syarat & Ketentuan</a> kami.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 space-y-6">
                    <x-sections.checkout-summary
                        :cart="$cart"
                        :subtotal="$cartTotal"
                        :shipping="0"
                        :tax="0"
                        :grandTotal="$cartTotal"
                        :showActions="false"
                    />

                    <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100 flex gap-4">
                        <div class="text-blue-500 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            <strong>Informasi Penting:</strong> Pesanan Anda akan diproses segera setelah pembayaran dikonfirmasi oleh sistem kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
