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
                <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
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
                <div class="w-12 h-12 bg-green-50 text-green-500 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
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
                <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
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