@extends('layouts.admin')

@section('title', 'Pusat Bantuan - Super Admin')
@section('page_title', 'Pusat Bantuan')
@section('page_subtitle', 'Panduan lengkap penggunaan dashboard admin dan super admin')

@section('content')
<div class="space-y-8">
    <!-- Quick Access -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <a href="#getting-started" class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition text-center group">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-700">Mulai Cepat</p>
        </a>
        <a href="#admin-guide" class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition text-center group">
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-700">Panduan Admin</p>
        </a>
        <a href="#super-admin-guide" class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition text-center group">
            <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-700">Panduan Super Admin</p>
        </a>
        <a href="#faq" class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition text-center group">
            <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-700">FAQ</p>
        </a>
    </div>

    <!-- Getting Started -->
    <div id="getting-started" class="bg-white rounded-xl shadow-sm p-6 scroll-mt-20">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Mulai Cepat
        </h2>
        <div class="prose max-w-none text-gray-600">
            <p>Selamat datang di dashboard <strong>{{ config('app.name') }}</strong>! Berikut adalah langkah-langkah cepat untuk memulai:</p>
            <ol class="list-decimal list-inside space-y-2 mt-3">
                <li><strong>Login</strong> - Gunakan akun yang telah diberikan oleh administrator</li>
                <li><strong>Dashboard</strong> - Lihat ringkasan data dan statistik di halaman utama</li>
                <li><strong>Kelola Produk</strong> - Tambah, edit, atau hapus produk fashion</li>
                <li><strong>Kelola Pesanan</strong> - Pantau dan proses pesanan pelanggan</li>
                <li><strong>Pengaturan</strong> - Sesuaikan konfigurasi toko sesuai kebutuhan</li>
            </ol>
        </div>
    </div>

    <!-- Admin Guide -->
    <div id="admin-guide" class="bg-white rounded-xl shadow-sm p-6 scroll-mt-20">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            Panduan Admin
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Produk -->
            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Manajemen Produk
                </h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                    <li>Tambah produk baru dengan gambar dan ukuran</li>
                    <li>Edit informasi produk yang sudah ada</li>
                    <li>Kelola stok produk per ukuran</li>
                    <li>Tandai produk sebagai unggulan</li>
                </ul>
            </div>

            <!-- Pesanan -->
            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Manajemen Pesanan
                </h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                    <li>Lihat daftar semua pesanan</li>
                    <li>Update status pesanan</li>
                    <li>Proses pembayaran</li>
                    <li>Cetak invoice pesanan</li>
                </ul>
            </div>

            <!-- Koleksi & Kategori -->
            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Koleksi & Kategori
                </h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                    <li>Buat dan kelola koleksi produk</li>
                    <li>Buat dan kelola kategori produk</li>
                    <li>Atur produk berdasarkan koleksi dan kategori</li>
                </ul>
            </div>

            <!-- Galeri & Testimoni -->
            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galeri & Testimoni
                </h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                    <li>Upload gambar ke galeri produk</li>
                    <li>Kelola testimoni pelanggan</li>
                    <li>Atur urutan tampilan galeri</li>
                </ul>
            </div>
        </div>

        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Untuk panduan lebih detail, kunjungi <a href="#" class="text-primary font-medium hover:underline">Dokumentasi Admin Lengkap</a></span>
            </p>
        </div>
    </div>

    <!-- Super Admin Guide -->
    <div id="super-admin-guide" class="bg-white rounded-xl shadow-sm p-6 scroll-mt-20 border-l-4 border-purple-500">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Panduan Super Admin
            <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">Khusus</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pengaturan Sistem -->
            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    </svg>
                    Pengaturan Sistem
                </h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                    <li>Kelola informasi toko (nama, email, alamat)</li>
                    <li>Atur zona waktu dan mata uang</li>
                    <li>Konfigurasi metode pembayaran</li>
                    <li>Atur metode dan biaya pengiriman</li>
                </ul>
            </div>

            <!-- Manajemen User -->
            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Manajemen User
                </h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                    <li>Tambah, edit, dan hapus user</li>
                    <li>Atur role user (admin, super_admin, customer)</li>
                    <li>Aktifkan / nonaktifkan akun user</li>
                    <li>Reset password user</li>
                </ul>
            </div>

            <!-- Payment Gateway -->
            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Payment Gateway
                </h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                    <li>Konfigurasi Midtrans (Server Key & Client Key)</li>
                    <li>Aktifkan / nonaktifkan Midtrans</li>
                    <li>Mode Sandbox untuk testing</li>
                    <li>Atur metode pembayaran yang tersedia</li>
                </ul>
            </div>

            <!-- Laporan & Analitik -->
            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Laporan & Analitik
                </h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                    <li>Lihat laporan penjualan</li>
                    <li>Analisis data produk terlaris</li>
                    <li>Monitor stok produk</li>
                    <li>Export data ke CSV</li>
                </ul>
            </div>
        </div>

        <!-- Midtrans Info -->
        <div class="mt-4 p-4 bg-green-50 rounded-lg border border-green-200">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm text-green-800 font-medium">Apa itu Midtrans?</p>
                    <p class="text-sm text-green-700 mt-1">
                        Midtrans adalah payment gateway yang memungkinkan pelanggan membayar secara otomatis via 
                        kartu kredit, virtual account, e-wallet, QRIS, dan lainnya.
                    </p>
                    <p class="text-sm text-green-700 mt-2">
                        <span class="font-medium">Cara Mendapatkan:</span>
                        Daftar di 
                        <a href="https://dashboard.midtrans.com" target="_blank" class="text-primary font-medium hover:underline">
                            dashboard.midtrans.com
                        </a> 
                        dan dapatkan Server Key & Client Key dari dashboard.
                    </p>
                    <p class="text-sm text-green-700 mt-2">
                        <span class="font-medium">📖 Panduan Lengkap:</span>
                        <a href="https://midtrans.com/docs" target="_blank" class="text-primary hover:underline">
                            Dokumentasi Midtrans
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4 p-4 bg-purple-50 rounded-lg">
            <p class="text-sm text-purple-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Untuk panduan lebih detail, kunjungi <a href="#" class="text-purple-600 font-medium hover:underline">Dokumentasi Super Admin Lengkap</a></span>
            </p>
        </div>
    </div>

    <!-- FAQ -->
    <div id="faq" class="bg-white rounded-xl shadow-sm p-6 scroll-mt-20">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Frequently Asked Questions (FAQ)
        </h2>

        <div class="space-y-4">
            <div class="border border-gray-100 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800">Bagaimana cara menambah produk baru?</h3>
                <p class="text-sm text-gray-600 mt-1">Buka menu <strong>Produk → Tambah Produk</strong>, isi semua data produk (nama, kategori, harga, deskripsi), upload gambar, lalu klik Simpan.</p>
            </div>

            <div class="border border-gray-100 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800">Bagaimana cara mengatur stok produk?</h3>
                <p class="text-sm text-gray-600 mt-1">Buka menu <strong>Produk → Update Stok</strong>, pilih produk yang ingin diupdate stoknya, isi jumlah stok per ukuran, lalu klik Update Stok.</p>
            </div>

            <div class="border border-gray-100 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800">Bagaimana cara mengaktifkan Midtrans?</h3>
                <p class="text-sm text-gray-600 mt-1">Buka menu <strong>Pengaturan → Pengaturan Pembayaran</strong>, isi Server Key dan Client Key Midtrans, centang Aktifkan Midtrans, lalu klik Simpan Pengaturan.</p>
            </div>

            <div class="border border-gray-100 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800">Apa perbedaan Admin dan Super Admin?</h3>
                <p class="text-sm text-gray-600 mt-1"><strong>Admin</strong> dapat mengelola produk, pesanan, galeri, testimoni, dan pesan. <strong>Super Admin</strong> memiliki akses tambahan untuk mengelola user dan pengaturan sistem.</p>
            </div>

            <div class="border border-gray-100 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800">Bagaimana cara export data laporan?</h3>
                <p class="text-sm text-gray-600 mt-1">Buka menu <strong>Laporan</strong>, pilih laporan yang diinginkan, lalu klik tombol <strong>Export CSV</strong> di halaman tersebut.</p>
            </div>
        </div>

        <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
            <p class="text-sm text-yellow-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Masih ada pertanyaan? Hubungi <a href="#" class="text-primary font-medium hover:underline">Dukungan Teknis</a></span>
            </p>
        </div>
    </div>

    <!-- Contact Support -->
    <div class="bg-white rounded-xl shadow-sm p-6 text-center">
        <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414-1.414m-1.414 1.414L9 9m-2.25 2.25l.707.707m4.243-4.243l1.414 1.414m-2.828-2.828a5 5 0 00-7.072 7.072l1.414 1.414"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900">Butuh Bantuan?</h3>
        <p class="text-sm text-gray-500 mt-1">Tim dukungan kami siap membantu Anda 24/7</p>
        <div class="mt-4 flex flex-wrap justify-center gap-4">
            <a href="mailto:support@fashion.id" class="btn-primary px-6 py-2 rounded-lg text-sm inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Email Support
            </a>
            <a href="#" class="btn-secondary px-6 py-2 rounded-lg text-sm inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection