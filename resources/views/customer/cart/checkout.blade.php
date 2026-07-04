@extends('layouts.app')

@section('title', 'Checkout - ' . config('app.name'))

@section('content')
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <!-- Judul Langsung - TANPA BREADCRUMB -->
        <div class="mb-12">
            <span class="eyebrow">Langkah Terakhir</span>
            <h1 class="section-title">Checkout</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                    <form action="{{ route('customer.checkout.store') }}" method="POST" class="space-y-10">
                        @csrf

                        <!-- Shipping Address -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                Alamat Pengiriman
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="shipping_address" value="{{ old('shipping_address', $user->address ?? '') }}"
                                           class="form-input" placeholder="Masukkan alamat lengkap" required>
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
                                           class="form-input" placeholder="Nomor telepon aktif" required>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        <!-- Payment Method -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                Metode Pembayaran
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <label class="relative block cursor-pointer group">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="peer sr-only" checked>
                                    <div class="p-4 border-2 border-gray-100 rounded-xl hover:bg-gray-50 peer-checked:border-secondary peer-checked:bg-secondary/5 transition-all text-center">
                                        <span class="text-2xl mb-2 block">🏦</span>
                                        <span class="font-bold text-gray-900 text-sm">Transfer Bank</span>
                                    </div>
                                </label>
                                <label class="relative block cursor-pointer group">
                                    <input type="radio" name="payment_method" value="credit_card" class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-100 rounded-xl hover:bg-gray-50 peer-checked:border-secondary peer-checked:bg-secondary/5 transition-all text-center">
                                        <span class="text-2xl mb-2 block">💳</span>
                                        <span class="font-bold text-gray-900 text-sm">Kartu Kredit</span>
                                    </div>
                                </label>
                                <label class="relative block cursor-pointer group">
                                    <input type="radio" name="payment_method" value="e_wallet" class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-100 rounded-xl hover:bg-gray-50 peer-checked:border-secondary peer-checked:bg-secondary/5 transition-all text-center">
                                        <span class="text-2xl mb-2 block">📱</span>
                                        <span class="font-bold text-gray-900 text-sm">E-Wallet</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea name="notes" rows="3" class="form-input" placeholder="Tambahkan catatan untuk pesanan Anda">{{ old('notes') }}</textarea>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="w-full btn-primary !py-4 text-lg shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Selesaikan Pembayaran
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <x-sections.checkout-summary 
                    :cart="$cart"
                    :subtotal="$cartTotal"
                    :shipping="0"
                    :tax="0"
                    :grandTotal="$cartTotal"
                    :showActions="false"
                />

                <div class="mt-8 p-6 bg-blue-50 rounded-2xl border border-blue-100">
                    <div class="flex gap-4">
                        <div class="text-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-blue-700 leading-relaxed">
                            Pesanan Anda akan diproses setelah pembayaran dikonfirmasi. Pastikan alamat pengiriman sudah benar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
