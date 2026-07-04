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
            <h3 class="font-semibold text-gray-800 mb-4">🚚 Metode Pengiriman</h3>
            <div class="space-y-3">
                @php
                    $shippingMethods = old('shipping_methods', isset($settings['shipping_methods']) ? explode(',', $settings['shipping_methods']) : []);
                @endphp
                <x-form.checkbox 
                    name="shipping_methods[]" 
                    label="📦 Standar" 
                    value="standard"
                    checked="{{ in_array('standard', $shippingMethods) }}"
                />
                <x-form.checkbox 
                    name="shipping_methods[]" 
                    label="🚀 Express" 
                    value="express"
                    checked="{{ in_array('express', $shippingMethods) }}"
                />
                <x-form.checkbox 
                    name="shipping_methods[]" 
                    label="🏃 Same Day" 
                    value="same_day"
                    checked="{{ in_array('same_day', $shippingMethods) }}"
                />
            </div>
        </div>

        <!-- Shipping Costs -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="font-semibold text-gray-800 mb-4">💰 Biaya Pengiriman</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form.input 
                    type="number"
                    name="shipping_cost_standard" 
                    label="Biaya Standar" 
                    value="{{ old('shipping_cost_standard', $settings['shipping_cost_standard'] ?? 20000) }}"
                    required
                    icon="💰"
                />
                <x-form.input 
                    type="number"
                    name="shipping_cost_express" 
                    label="Biaya Express" 
                    value="{{ old('shipping_cost_express', $settings['shipping_cost_express'] ?? 50000) }}"
                    required
                    icon="💰"
                />
                <x-form.input 
                    type="number"
                    name="shipping_cost_same_day" 
                    label="Biaya Same Day" 
                    value="{{ old('shipping_cost_same_day', $settings['shipping_cost_same_day'] ?? 100000) }}"
                    required
                    icon="💰"
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
                    icon="🎁"
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