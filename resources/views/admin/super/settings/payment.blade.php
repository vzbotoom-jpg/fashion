@extends('layouts.admin')

@section('title', 'Pengaturan Pembayaran - Super Admin')
@section('page_title', 'Pengaturan Pembayaran')
@section('page_subtitle', 'Kelola metode dan konfigurasi pembayaran')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.super.settings.payment') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm text-blue-700 font-medium">Informasi Metode Pembayaran</p>
                    <p class="text-xs text-blue-600 mt-1">
                        Metode pembayaran yang dipilih akan ditampilkan di halaman checkout pelanggan.
                        Pastikan metode yang diaktifkan sesuai dengan layanan yang tersedia.
                    </p>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Metode Pembayaran
            </h3>
            <div class="space-y-3">
                @php
                    $paymentMethods = old('payment_methods', isset($settings['payment_methods']) ? explode(',', $settings['payment_methods']) : []);
                @endphp
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <x-form.checkbox 
                        name="payment_methods[]" 
                        label="Transfer Bank" 
                        value="bank_transfer"
                        checked="{{ in_array('bank_transfer', $paymentMethods) }}"
                    />
                    <x-form.checkbox 
                        name="payment_methods[]" 
                        label="Kartu Kredit" 
                        value="credit_card"
                        checked="{{ in_array('credit_card', $paymentMethods) }}"
                    />
                    <x-form.checkbox 
                        name="payment_methods[]" 
                        label="E-Wallet" 
                        value="e_wallet"
                        checked="{{ in_array('e_wallet', $paymentMethods) }}"
                    />
                    <x-form.checkbox 
                        name="payment_methods[]" 
                        label="QRIS" 
                        value="qris"
                        checked="{{ in_array('qris', $paymentMethods) }}"
                    />
                    <x-form.checkbox 
                        name="payment_methods[]" 
                        label="Virtual Account" 
                        value="virtual_account"
                        checked="{{ in_array('virtual_account', $paymentMethods) }}"
                    />
                    <x-form.checkbox 
                        name="payment_methods[]" 
                        label="COD (Cash on Delivery)" 
                        value="cod"
                        checked="{{ in_array('cod', $paymentMethods) }}"
                    />
                </div>
            </div>
        </div>

        <!-- Bank Transfer Details -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Detail Transfer Bank
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form.input 
                    name="bank_transfer_account" 
                    label="Nama Bank" 
                    value="{{ old('bank_transfer_account', $settings['bank_transfer_account'] ?? '') }}"
                    placeholder="Contoh: BCA"
                />
                <x-form.input 
                    name="bank_transfer_number" 
                    label="Nomor Rekening" 
                    value="{{ old('bank_transfer_number', $settings['bank_transfer_number'] ?? '') }}"
                    placeholder="Contoh: 1234567890"
                />
                <x-form.input 
                    name="bank_transfer_name" 
                    label="Nama Pemilik" 
                    value="{{ old('bank_transfer_name', $settings['bank_transfer_name'] ?? '') }}"
                    placeholder="Contoh: PT Fashion Indonesia"
                />
            </div>
        </div>

        <!-- Midtrans Configuration -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Midtrans (Opsional)
                <span class="text-xs text-gray-400 font-normal">Payment Gateway Otomatis</span>
            </h3>
            
            <!-- Midtrans Info -->
            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                <p class="text-sm text-gray-600 flex items-start gap-2">
                    <svg class="w-5 h-5 text-yellow-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>
                        <span class="font-medium">Apa itu Midtrans?</span>
                        Midtrans adalah payment gateway yang memungkinkan pelanggan membayar secara otomatis via 
                        kartu kredit, virtual account, e-wallet, QRIS, dan lainnya.
                    </span>
                </p>
                <p class="text-sm text-gray-600 mt-2 flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    <span>
                        <span class="font-medium">Cara Mendapatkan:</span>
                        Daftar di 
                        <a href="https://dashboard.midtrans.com" target="_blank" class="text-primary hover:underline">
                            dashboard.midtrans.com
                        </a> 
                        dan dapatkan Server Key & Client Key dari dashboard.
                    </span>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input 
                    name="midtrans_server_key" 
                    label="Server Key" 
                    value="{{ old('midtrans_server_key', $settings['midtrans_server_key'] ?? '') }}"
                    placeholder="Masukkan Server Key Midtrans"
                />
                <x-form.input 
                    name="midtrans_client_key" 
                    label="Client Key" 
                    value="{{ old('midtrans_client_key', $settings['midtrans_client_key'] ?? '') }}"
                    placeholder="Masukkan Client Key Midtrans"
                />
                <div>
                    <x-form.checkbox 
                        name="midtrans_enabled" 
                        label="Aktifkan Midtrans" 
                        checked="{{ old('midtrans_enabled', $settings['midtrans_enabled'] ?? false) }}"
                    />
                    <p class="text-xs text-gray-400 mt-1">
                        Centang untuk mengaktifkan pembayaran otomatis via Midtrans
                    </p>
                </div>
                <div>
                    <x-form.checkbox 
                        name="midtrans_sandbox" 
                        label="Mode Sandbox (Testing)" 
                        checked="{{ old('midtrans_sandbox', $settings['midtrans_sandbox'] ?? true) }}"
                    />
                    <p class="text-xs text-gray-400 mt-1">
                        Aktifkan untuk mode testing (tidak memproses uang asli)
                    </p>
                </div>
            </div>
        </div>

        <!-- Minimum Order -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Minimum Order per Metode
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form.input 
                    type="number"
                    name="min_order_bank_transfer" 
                    label="Transfer Bank (Min. Order)" 
                    value="{{ old('min_order_bank_transfer', $settings['min_order_bank_transfer'] ?? 0) }}"
                    placeholder="0"
                />
                <x-form.input 
                    type="number"
                    name="min_order_credit_card" 
                    label="Kartu Kredit (Min. Order)" 
                    value="{{ old('min_order_credit_card', $settings['min_order_credit_card'] ?? 0) }}"
                    placeholder="0"
                />
                <x-form.input 
                    type="number"
                    name="min_order_e_wallet" 
                    label="E-Wallet (Min. Order)" 
                    value="{{ old('min_order_e_wallet', $settings['min_order_e_wallet'] ?? 0) }}"
                    placeholder="0"
                />
            </div>
            <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Kosongkan atau isi 0 untuk tidak menerapkan minimum order
            </p>
        </div>

        <!-- Submit -->
        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan Pengaturan
            </button>
            <a href="{{ route('admin.super.settings.index') }}" class="btn-secondary px-8 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection