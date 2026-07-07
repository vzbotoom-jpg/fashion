@extends('layouts.admin')

@section('title', 'Pengaturan Pengiriman - Super Admin')
@section('page_title', 'Pengaturan Pengiriman')
@section('page_subtitle', 'Kelola metode dan biaya pengiriman')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.super.settings.shipping') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Shipping Methods -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                Metode Pengiriman
            </h3>
            <div class="space-y-3">
                @php
                    $shippingMethods = old('shipping_methods', isset($settings['shipping_methods']) ? explode(',', $settings['shipping_methods']) : []);
                @endphp
                <x-form.checkbox 
                    name="shipping_methods[]" 
                    label="Standar" 
                    value="standard"
                    checked="{{ in_array('standard', $shippingMethods) }}"
                />
                <x-form.checkbox 
                    name="shipping_methods[]" 
                    label="Express" 
                    value="express"
                    checked="{{ in_array('express', $shippingMethods) }}"
                />
                <x-form.checkbox 
                    name="shipping_methods[]" 
                    label="Same Day" 
                    value="same_day"
                    checked="{{ in_array('same_day', $shippingMethods) }}"
                />
            </div>
        </div>

        <!-- Shipping Costs -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Biaya Pengiriman
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form.input 
                    type="number"
                    name="shipping_cost_standard" 
                    label="Biaya Standar" 
                    value="{{ old('shipping_cost_standard', $settings['shipping_cost_standard'] ?? 20000) }}"
                    required
                />
                <x-form.input 
                    type="number"
                    name="shipping_cost_express" 
                    label="Biaya Express" 
                    value="{{ old('shipping_cost_express', $settings['shipping_cost_express'] ?? 50000) }}"
                    required
                />
                <x-form.input 
                    type="number"
                    name="shipping_cost_same_day" 
                    label="Biaya Same Day" 
                    value="{{ old('shipping_cost_same_day', $settings['shipping_cost_same_day'] ?? 100000) }}"
                    required
                />
            </div>
        </div>

        <!-- Free Shipping & Zone -->
        <div class="border-t border-gray-200 pt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input 
                    type="number"
                    name="free_shipping_threshold" 
                    label="Minimal Belanja Gratis Ongkir" 
                    value="{{ old('free_shipping_threshold', $settings['free_shipping_threshold'] ?? 500000) }}"
                />
                <x-form.input 
                    name="shipping_zone" 
                    label="Zona Pengiriman" 
                    value="{{ old('shipping_zone', $settings['shipping_zone'] ?? 'Indonesia') }}"
                    placeholder="Contoh: Indonesia, Asia, Global"
                />
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