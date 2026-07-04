@extends('layouts.app')

@section('title', 'Syarat & Ketentuan')

@section('content')
<div class="container-custom section-padding">
    <div class="max-w-4xl mx-auto">
        <h1 class="section-title text-center">Syarat & Ketentuan</h1>
        <p class="text-center text-gray-500 text-sm mt-2">Terakhir diperbarui: {{ date('d F Y') }}</p>
        
        <div class="mt-8 space-y-8">
            <!-- 1. Pendahuluan -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">1. Pendahuluan</h2>
                <p class="text-gray-600 leading-relaxed">
                    Selamat datang di {{ config('app.name', 'Fashion') }}. Dengan mengakses dan menggunakan website kami, Anda setuju untuk mematuhi Syarat & Ketentuan berikut. Jika Anda tidak setuju dengan ketentuan ini, mohon tidak menggunakan website kami.
                </p>
                <p class="text-gray-600 leading-relaxed mt-2">
                    Kami berhak untuk mengubah Syarat & Ketentuan ini setiap saat tanpa pemberitahuan sebelumnya. Perubahan akan berlaku segera setelah dipublikasikan di halaman ini.
                </p>
            </div>

            <!-- 2. Akun Pengguna -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">2. Akun Pengguna</h2>
                <ul class="list-disc list-inside text-gray-600 leading-relaxed space-y-2">
                    <li>Anda harus berusia minimal 18 tahun atau memiliki izin orang tua untuk membuat akun.</li>
                    <li>Anda bertanggung jawab penuh atas keamanan akun dan password Anda.</li>
                    <li>Anda setuju untuk memberikan informasi yang akurat dan lengkap saat mendaftar.</li>
                    <li>Anda bertanggung jawab atas semua aktivitas yang terjadi di akun Anda.</li>
                    <li>Kami berhak menangguhkan atau mengakhiri akun Anda jika terjadi pelanggaran.</li>
                </ul>
            </div>

            <!-- 3. Pesanan dan Pembayaran -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">3. Pesanan dan Pembayaran</h2>
                <ul class="list-disc list-inside text-gray-600 leading-relaxed space-y-2">
                    <li>Semua pesanan yang Anda buat adalah penawaran untuk membeli produk.</li>
                    <li>Kami berhak untuk menolak atau membatalkan pesanan Anda karena alasan apapun.</li>
                    <li>Harga produk dapat berubah tanpa pemberitahuan sebelumnya.</li>
                    <li>Pembayaran harus dilakukan sesuai dengan metode yang tersedia di website.</li>
                    <li>Kami tidak bertanggung jawab atas kesalahan pembayaran yang dilakukan oleh pihak ketiga.</li>
                </ul>
            </div>

            <!-- 4. Pengiriman dan Pengembalian -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">4. Pengiriman dan Pengembalian</h2>
                <ul class="list-disc list-inside text-gray-600 leading-relaxed space-y-2">
                    <li>Waktu pengiriman adalah perkiraan dan dapat berubah tergantung pada lokasi dan ketersediaan produk.</li>
                    <li>Biaya pengiriman akan dihitung saat checkout.</li>
                    <li>Anda berhak mengembalikan produk dalam waktu 7 hari setelah diterima.</li>
                    <li>Produk yang dikembalikan harus dalam kondisi baru dan belum digunakan.</li>
                    <li>Biaya pengembalian ditanggung oleh pelanggan kecuali ada kerusakan dari pihak kami.</li>
                </ul>
            </div>

            <!-- 5. Hak Kekayaan Intelektual -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">5. Hak Kekayaan Intelektual</h2>
                <p class="text-gray-600 leading-relaxed">
                    Semua konten di website ini, termasuk teks, gambar, logo, dan desain, adalah milik {{ config('app.name', 'Fashion') }} dan dilindungi oleh hak cipta dan merek dagang. Anda tidak diperbolehkan untuk menyalin, mendistribusikan, atau menggunakan konten kami tanpa izin tertulis.
                </p>
            </div>

            <!-- 6. Penggunaan yang Dilarang -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">6. Penggunaan yang Dilarang</h2>
                <p class="text-gray-600 leading-relaxed">Anda setuju untuk tidak menggunakan website kami untuk:</p>
                <ul class="list-disc list-inside text-gray-600 leading-relaxed mt-3 space-y-2">
                    <li>Melakukan aktivitas ilegal atau penipuan</li>
                    <li>Menyebarkan virus atau konten berbahaya</li>
                    <li>Mengganggu keamanan atau integritas website</li>
                    <li>Melanggar hak orang lain</li>
                    <li>Mengirim spam atau materi promosi yang tidak diminta</li>
                </ul>
            </div>

            <!-- 7. Pembatalan dan Pengakhiran -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">7. Pembatalan dan Pengakhiran</h2>
                <ul class="list-disc list-inside text-gray-600 leading-relaxed space-y-2">
                    <li>Anda dapat membatalkan pesanan sebelum pesanan diproses.</li>
                    <li>Kami berhak untuk membatalkan pesanan jika terjadi kesalahan harga atau ketersediaan produk.</li>
                    <li>Kami berhak mengakhiri akun Anda jika terjadi pelanggaran ketentuan.</li>
                </ul>
            </div>

            <!-- 8. Batasan Tanggung Jawab -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">8. Batasan Tanggung Jawab</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ config('app.name', 'Fashion') }} tidak bertanggung jawab atas kerusakan langsung, tidak langsung, insidental, atau konsekuensial yang timbul dari penggunaan atau ketidakmampuan menggunakan website kami. Kami menyediakan website dan layanan kami "sebagaimana adanya" tanpa jaminan apapun.
                </p>
            </div>

            <!-- 9. Hukum yang Berlaku -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">9. Hukum yang Berlaku</h2>
                <p class="text-gray-600 leading-relaxed">
                    Syarat & Ketentuan ini diatur oleh dan ditafsirkan sesuai dengan hukum Negara Kesatuan Republik Indonesia. Setiap sengketa yang timbul akan diselesaikan di pengadilan yang berwenang di Indonesia.
                </p>
            </div>

            <!-- 10. Hubungi Kami -->
            <div class="card p-6 bg-secondary/5 border-secondary/20">
                <h2 class="text-xl font-bold text-gray-900 mb-3">10. Hubungi Kami</h2>
                <p class="text-gray-600 leading-relaxed">
                    Jika Anda memiliki pertanyaan tentang Syarat & Ketentuan ini, silakan hubungi kami:
                </p>
                <ul class="mt-3 space-y-3 text-gray-600">
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-secondary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <strong>Email:</strong> <a href="mailto:hello@fashion.id" class="text-secondary hover:underline">hello@fashion.id</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-secondary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <strong>Telepon:</strong> 0812-3456-7890
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-secondary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <strong>Alamat:</strong> [Alamat Toko Anda]
                    </li>
                </ul>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="btn-secondary inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection