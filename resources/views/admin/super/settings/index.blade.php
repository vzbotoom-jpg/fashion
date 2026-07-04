@extends('layouts.admin')

@section('title', 'Pengaturan - Super Admin')
@section('page_title', 'Pengaturan')
@section('page_subtitle', 'Kelola pengaturan sistem')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- General Settings -->
    <a href="{{ route('admin.super.settings.general') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition group">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-4xl block mb-3">⚙️</span>
                <h3 class="font-semibold text-gray-800 group-hover:text-primary transition">Pengaturan Umum</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi toko, kontak, dan waktu</p>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </a>

    <!-- Payment Settings -->
    <a href="{{ route('admin.super.settings.payment') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition group">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-4xl block mb-3">💳</span>
                <h3 class="font-semibold text-gray-800 group-hover:text-primary transition">Pengaturan Pembayaran</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola metode dan konfigurasi pembayaran</p>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </a>

    <!-- Shipping Settings -->
    <a href="{{ route('admin.super.settings.shipping') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition group">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-4xl block mb-3">🚚</span>
                <h3 class="font-semibold text-gray-800 group-hover:text-primary transition">Pengaturan Pengiriman</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola metode dan biaya pengiriman</p>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </a>
</div>
@endsection