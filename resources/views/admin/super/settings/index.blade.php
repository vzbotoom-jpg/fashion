@extends('layouts.admin')

@section('title', 'Pengaturan - Super Admin')
@section('page_title', 'Pengaturan')
@section('page_subtitle', 'Kelola pengaturan sistem')

@section('content')
<!-- Info Box - Panduan -->
<div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
    <div class="flex items-start">
        <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="text-sm text-blue-700 font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Panduan Penggunaan Dashboard
            </p>
            <p class="text-xs text-blue-600 mt-1">
                Pelajari cara mengelola toko Anda dengan mudah melalui dashboard admin dan super admin.
                <a href="{{ route('admin.super.help') }}" class="text-primary font-medium hover:underline">
                    Klik di sini untuk melihat panduan lengkap →
                </a>
            </p>
        </div>
    </div>
</div>

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

<!-- Additional Info - Panduan Lengkap -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Panduan Admin -->
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-sm">Panduan Admin</h4>
                <p class="text-xs text-gray-500 mt-1">
                    Pelajari cara mengelola produk, pesanan, koleksi, kategori, galeri, testimoni, dan pesan pelanggan.
                </p>
                <a href="{{ route('admin.super.help') }}#admin-guide" class="text-xs text-primary font-medium hover:underline mt-2 inline-block">
                    Lihat Panduan Admin →
                </a>
            </div>
        </div>
    </div>

    <!-- Panduan Super Admin -->
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-sm">Panduan Super Admin</h4>
                <p class="text-xs text-gray-500 mt-1">
                    Pelajari cara mengelola user, pengaturan sistem, metode pembayaran, pengiriman, dan konfigurasi Midtrans.
                </p>
                <a href="{{ route('admin.super.help') }}#super-admin-guide" class="text-xs text-primary font-medium hover:underline mt-2 inline-block">
                    Lihat Panduan Super Admin →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Midtrans Info -->
<div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
    <div class="flex items-start gap-3">
        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="text-sm text-green-800 font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Apa itu Midtrans?
            </p>
            <p class="text-sm text-green-700 mt-1">
                Midtrans adalah payment gateway yang memungkinkan pelanggan membayar secara otomatis via 
                kartu kredit, virtual account, e-wallet, QRIS, dan lainnya.
            </p>
            <p class="text-sm text-green-700 mt-2 flex items-start gap-2">
                <svg class="w-4 h-4 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
                <span>
                    <span class="font-medium">Cara Mendapatkan:</span>
                    Daftar di 
                    <a href="https://dashboard.midtrans.com" target="_blank" class="text-primary font-medium hover:underline">
                        dashboard.midtrans.com
                    </a> 
                    dan dapatkan Server Key & Client Key dari dashboard.
                </span>
            </p>
            <p class="text-sm text-green-700 mt-2 flex items-start gap-2">
                <svg class="w-4 h-4 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span>
                    <span class="font-medium">Panduan Lengkap:</span>
                    <a href="https://midtrans.com/docs" target="_blank" class="text-primary hover:underline">
                        Dokumentasi Midtrans
                    </a>
                    atau kunjungi 
                    <a href="{{ route('admin.super.help') }}#super-admin-guide" class="text-primary font-medium hover:underline">
                        Pusat Bantuan
                    </a>
                    untuk panduan konfigurasi.
                </span>
            </p>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="mt-6 flex flex-wrap items-center justify-between gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
    <div class="flex items-center gap-2 text-sm text-gray-600">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>Butuh bantuan lebih lanjut?</span>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.super.help') }}" class="btn-primary !py-1.5 !px-4 !text-xs rounded-lg inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pusat Bantuan
        </a>
        <a href="mailto:support@fashion.id" class="btn-secondary !py-1.5 !px-4 !text-xs rounded-lg inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Email Support
        </a>
    </div>
</div>
@endsection