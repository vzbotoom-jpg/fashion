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
            <h3 class="font-semibold text-gray-800 mb-4">💳 Metode Pembayaran</h3>
            <div class="space-y-3">
                @php
                    $paymentMethods = old('payment_methods', isset($settings['payment_methods']) ? explode(',', $settings['payment_methods']) : []);
                @endphp
                <x-form.checkbox 
                    name="payment_methods[]" 
                    label="🏦 Transfer Bank" 
                    value="bank_transfer"
                    checked="{{ in_array('bank_transfer', $paymentMethods) }}"
                />
                <x-form.checkbox 
                    name="payment_methods[]" 
                    label="💳 Kartu Kredit" 
                    value="credit_card"
                    checked="{{ in_array('credit_card', $paymentMethods) }}"
                />
                <x-form.checkbox 
                    name="payment_methods[]" 
                    label="📱 E-Wallet" 
                    value="e_wallet"
                    checked="{{ in_array('e_wallet', $paymentMethods) }}"
                />
            </div>
        </div>

        <!-- Bank Transfer Details -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="font-semibold text-gray-800 mb-4">🏦 Detail Transfer Bank</h3>
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
            <h3 class="font-semibold text-gray-800 mb-4">🔐 Midtrans (Opsional)</h3>
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
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg">
                💾 Simpan Pengaturan
            </button>
            <a href="{{ route('admin.super.settings.index') }}" class="btn-secondary px-8 py-3 rounded-lg">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection