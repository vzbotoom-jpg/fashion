@extends('layouts.admin')

@section('title', 'Pengaturan Pembayaran - Super Admin')
@section('page_title', 'Pengaturan Pembayaran')
@section('page_subtitle', 'Kelola metode dan konfigurasi pembayaran')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.super.settings.payment') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

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
                />
                <x-form.input 
                    name="bank_transfer_number" 
                    label="Nomor Rekening" 
                    value="{{ old('bank_transfer_number', $settings['bank_transfer_number'] ?? '') }}"
                />
                <x-form.input 
                    name="bank_transfer_name" 
                    label="Nama Pemilik" 
                    value="{{ old('bank_transfer_name', $settings['bank_transfer_name'] ?? '') }}"
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
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input 
                    name="midtrans_server_key" 
                    label="Server Key" 
                    value="{{ old('midtrans_server_key', $settings['midtrans_server_key'] ?? '') }}"
                />
                <x-form.input 
                    name="midtrans_client_key" 
                    label="Client Key" 
                    value="{{ old('midtrans_client_key', $settings['midtrans_client_key'] ?? '') }}"
                />
                <div>
                    <x-form.checkbox 
                        name="midtrans_enabled" 
                        label="Aktifkan Midtrans" 
                        checked="{{ old('midtrans_enabled', $settings['midtrans_enabled'] ?? false) }}"
                    />
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex gap-3">
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