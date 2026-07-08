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
                        <div class="bg-gray-50/50 p-5 md:p-8 rounded-2xl border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Alamat Pengiriman
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="form-label">Alamat Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="shipping_address" value="{{ old('shipping_address', $user->address ?? '') }}"
                                           class="form-input" placeholder="Masukkan alamat lengkap pengiriman" required>
                                    @error('shipping_address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Kota <span class="text-red-500">*</span></label>
                                    <input type="text" name="city" value="{{ old('city', $user->city ?? '') }}"
                                           class="form-input" placeholder="Kota" required>
                                    @error('city')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Provinsi <span class="text-red-500">*</span></label>
                                    <input type="text" name="province" value="{{ old('province', $user->province ?? '') }}"
                                           class="form-input" placeholder="Provinsi" required>
                                    @error('province')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Kode Pos <span class="text-red-500">*</span></label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code ?? '') }}"
                                           class="form-input" placeholder="Kode Pos" required>
                                    @error('postal_code')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Nomor Telepon <span class="text-red-500">*</span></label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                           class="form-input" placeholder="Contoh: 081234567890" required>
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        <!-- Shipping Method -->
                        <div class="bg-gray-50/50 p-5 md:p-8 rounded-2xl border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                Metode Pengiriman
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                @foreach($shippingMethods ?? ['standard'] as $method)
                                    @php
                                        $cost = $shippingCosts[$method] ?? 0;
                                        $isFree = $isFreeShipping ?? false;
                                        $displayCost = $isFree ? 'GRATIS' : 'Rp ' . number_format($cost, 0, ',', '.');
                                        $label = $method == 'standard' ? 'Standar' : ($method == 'express' ? 'Express' : 'Same Day');
                                    @endphp
                                    <label class="relative block cursor-pointer group">
                                        <input type="radio" name="shipping_method" value="{{ $method }}" class="peer sr-only" @if($loop->first) checked @endif>
                                        <div class="p-4 md:p-5 border border-gray-200 rounded-2xl hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-primary/5 transition-all text-center">
                                            <span class="text-2xl md:text-3xl mb-2 md:mb-3 block">
                                                @if($method == 'standard')
                                                    <svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                                    </svg>
                                                @elseif($method == 'express')
                                                    <svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                @endif
                                            </span>
                                            <span class="font-bold text-gray-900 text-xs md:text-sm">{{ $label }}</span>
                                            <span class="block text-xs text-gray-500 mt-1">
                                                @if($isFree)
                                                    <span class="text-green-600 font-bold">{{ $displayCost }}</span>
                                                @else
                                                    {{ $displayCost }}
                                                @endif
                                            </span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @if($isFreeShipping ?? false)
                                <p class="text-sm text-green-600 mt-4 text-center flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                    </svg>
                                    Gratis ongkir! Belanja Anda sudah mencapai minimal {{ number_format($freeShippingThreshold ?? 0, 0, ',', '.') }}
                                </p>
                            @endif
                        </div>

                        <hr class="border-gray-100">

                        <!-- Payment Method -->
                        <div class="bg-gray-50/50 p-5 md:p-8 rounded-2xl border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Metode Pembayaran
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                @foreach($paymentMethods ?? ['bank_transfer'] as $method)
                                    @php
                                        $label = $method == 'bank_transfer' ? 'Transfer Bank' : ($method == 'credit_card' ? 'Kartu Kredit' : 'E-Wallet');
                                    @endphp
                                    <label class="relative block cursor-pointer group">
                                        <input type="radio" name="payment_method" value="{{ $method }}" class="peer sr-only" @if($loop->first) checked @endif>
                                        <div class="p-4 md:p-5 border border-gray-200 rounded-2xl hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-primary/5 transition-all text-center">
                                            <span class="text-2xl md:text-3xl mb-2 md:mb-3 block">
                                                @if($method == 'bank_transfer')
                                                    <svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                @elseif($method == 'credit_card')
                                                    <svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-8 h-8 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                @endif
                                            </span>
                                            <span class="font-bold text-gray-900 text-xs md:text-sm">{{ $label }}</span>
                                        </div>
                                    </label>
                                @endforeach
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
                                Dengan menekan tombol di atas, Anda menyetujui <a href="{{ route('terms') }}" class="underline hover:text-primary">Syarat & Ketentuan</a> kami.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 space-y-6">
                    <!-- Cart Summary -->
                    <div class="bg-gray-50/50 p-6 md:p-8 rounded-2xl border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Ringkasan Pesanan
                        </h3>
                        
                        <div class="space-y-4 max-h-80 overflow-y-auto">
                            @foreach($cart->items as $item)
                                <div class="flex items-start gap-4 pb-4 border-b border-gray-100 last:border-0">
                                    <div class="w-14 h-14 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden">
                                        @if($item->product->images->first())
                                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $item->size->name }} x {{ $item->quantity }}</p>
                                        <p class="text-sm font-semibold text-primary">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="font-medium">Rp {{ number_format($cartTotal ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Ongkos Kirim</span>
                                <span class="font-medium">
                                    @if($isFreeShipping ?? false)
                                        <span class="text-green-600 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            GRATIS
                                        </span>
                                    @else
                                        Rp {{ number_format($shippingCosts[array_key_first($shippingCosts ?? [])] ?? 0, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Pajak (11%)</span>
                                <span class="font-medium">Rp {{ number_format($cartTotal * 0.11, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-2 mt-2">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-gray-800">Total</span>
                                    <span class="text-xl font-bold text-primary">
                                        Rp {{ number_format($cartTotal + ($shippingCosts[array_key_first($shippingCosts ?? [])] ?? 0) + ($cartTotal * 0.11), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Store Info -->
                    <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100 flex gap-4">
                        <div class="text-blue-500 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-blue-700 font-medium">Informasi Penting</p>
                            <p class="text-xs text-blue-600 leading-relaxed mt-1">
                                Pesanan Anda akan diproses segera setelah pembayaran dikonfirmasi oleh sistem kami.
                            </p>
                            @if(isset($storeInfo['phone']) && $storeInfo['phone'])
                                <p class="text-xs text-blue-600 mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    Butuh bantuan? Hubungi {{ $storeInfo['phone'] }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection