@extends('layouts.app')

@section('title', 'Checkout - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-display font-bold text-gray-800 mb-8 flex items-center gap-3">
            <!-- Clipboard Icon -->
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Checkout
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <form action="{{ route('customer.checkout.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Shipping Address -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <!-- Truck Icon -->
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                Alamat Pengiriman
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <x-form.input 
                                        name="shipping_address" 
                                        label="Alamat Lengkap" 
                                        value="{{ old('shipping_address', $user->address ?? '') }}"
                                        placeholder="Masukkan alamat lengkap"
                                        required
                                    />
                                </div>
                                <x-form.input 
                                    name="city" 
                                    label="Kota" 
                                    value="{{ old('city', $user->city ?? '') }}"
                                    placeholder="Kota"
                                    required
                                />
                                <x-form.input 
                                    name="province" 
                                    label="Provinsi" 
                                    value="{{ old('province', $user->province ?? '') }}"
                                    placeholder="Provinsi"
                                    required
                                />
                                <x-form.input 
                                    name="postal_code" 
                                    label="Kode Pos" 
                                    value="{{ old('postal_code', $user->postal_code ?? '') }}"
                                    placeholder="Kode Pos"
                                    required
                                />
                                <x-form.input 
                                    name="phone" 
                                    label="Nomor Telepon" 
                                    value="{{ old('phone', $user->phone ?? '') }}"
                                    placeholder="Nomor telepon aktif"
                                    required
                                />
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <!-- Credit Card Icon -->
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Metode Pembayaran
                            </h3>
                            <div class="space-y-3">
                                <x-form.radio 
                                    name="payment_method" 
                                    value="bank_transfer" 
                                    label="🏦 Transfer Bank" 
                                    checked="{{ old('payment_method') === 'bank_transfer' || !old('payment_method') }}"
                                    required
                                />
                                <x-form.radio 
                                    name="payment_method" 
                                    value="credit_card" 
                                    label="💳 Kartu Kredit" 
                                    checked="{{ old('payment_method') === 'credit_card' }}"
                                />
                                <x-form.radio 
                                    name="payment_method" 
                                    value="e_wallet" 
                                    label="📱 E-Wallet" 
                                    checked="{{ old('payment_method') === 'e_wallet' }}"
                                />
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <x-form.textarea 
                                name="notes" 
                                label="Catatan (Opsional)" 
                                value="{{ old('notes') }}"
                                placeholder="Tambahkan catatan untuk pesanan Anda"
                                rows="2"
                            />
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="w-full btn-primary py-4 text-lg rounded-xl flex items-center justify-center gap-2">
                            <!-- Check Icon -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Buat Pesanan
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
            </div>
        </div>
    </div>
</section>
@endsection