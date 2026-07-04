@extends('layouts.app')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="container-custom section-padding">
    <div class="max-w-4xl mx-auto">
        <h1 class="section-title text-center">Kebijakan Privasi</h1>
        <p class="text-center text-gray-500 text-sm mt-2">Terakhir diperbarui: {{ date('d F Y') }}</p>
        
        <div class="mt-8 space-y-8">
            <!-- 1. Pendahuluan -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">1. Pendahuluan</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ config('app.name', 'Fashion') }} ("kami", "kita", atau "milik kami") menghormati privasi Anda dan berkomitmen untuk melindungi informasi pribadi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda saat Anda mengunjungi website kami atau menggunakan layanan kami.
                </p>
                <p class="text-gray-600 leading-relaxed mt-2">
                    Dengan menggunakan website kami, Anda menyetujui pengumpulan dan penggunaan informasi sesuai dengan Kebijakan Privasi ini.
                </p>
            </div>

            <!-- 2. Informasi yang Kami Kumpulkan -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">2. Informasi yang Kami Kumpulkan</h2>
                <p class="text-gray-600 leading-relaxed">Kami mengumpulkan beberapa jenis informasi untuk menyediakan dan meningkatkan layanan kami:</p>
                <ul class="list-disc list-inside text-gray-600 leading-relaxed mt-3 space-y-2">
                    <li><strong>Informasi Pribadi:</strong> Nama, alamat email, nomor telepon, alamat pengiriman, dan informasi pembayaran.</li>
                    <li><strong>Informasi Akun:</strong> Username, password, dan preferensi akun.</li>
                    <li><strong>Informasi Transaksi:</strong> Detail pesanan, riwayat pembelian, dan metode pembayaran.</li>
                    <li><strong>Informasi Teknis:</strong> Alamat IP, jenis browser, perangkat, dan data penggunaan website.</li>
                    <li><strong>Cookie:</strong> Kami menggunakan cookie untuk meningkatkan pengalaman Anda di website kami.</li>
                </ul>
            </div>

            <!-- 3. Bagaimana Kami Menggunakan Informasi -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">3. Bagaimana Kami Menggunakan Informasi</h2>
                <p class="text-gray-600 leading-relaxed">Informasi yang kami kumpulkan digunakan untuk:</p>
                <ul class="list-disc list-inside text-gray-600 leading-relaxed mt-3 space-y-2">
                    <li>Memproses dan mengelola pesanan Anda</li>
                    <li>Mengirimkan konfirmasi pesanan dan pembaruan pengiriman</li>
                    <li>Memberikan dukungan pelanggan</li>
                    <li>Mengirimkan newsletter dan promo (dengan persetujuan Anda)</li>
                    <li>Meningkatkan website dan layanan kami</li>
                    <li>Mencegah aktivitas penipuan dan menjaga keamanan</li>
                </ul>
            </div>

            <!-- 4. Keamanan Data -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">4. Keamanan Data</h2>
                <p class="text-gray-600 leading-relaxed">
                    Kami menerapkan langkah-langkah keamanan yang sesuai untuk melindungi informasi pribadi Anda dari akses, perubahan, atau penghancuran yang tidak sah. Namun, tidak ada metode transmisi data melalui internet yang 100% aman, dan kami tidak dapat menjamin keamanan absolut.
                </p>
                <div class="mt-3 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span><span class="font-semibold">Tips Keamanan:</span> Jangan pernah membagikan password Anda kepada siapapun. Kami tidak akan pernah meminta password Anda melalui email atau telepon.</span>
                    </p>
                </div>
            </div>

            <!-- 5. Cookie -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">5. Cookie</h2>
                <p class="text-gray-600 leading-relaxed">
                    Kami menggunakan cookie untuk meningkatkan pengalaman Anda di website kami. Cookie adalah file kecil yang disimpan di perangkat Anda yang membantu kami mengingat preferensi Anda dan memahami bagaimana Anda menggunakan website kami.
                </p>
                <p class="text-gray-600 leading-relaxed mt-2">
                    Anda dapat mengatur browser Anda untuk menolak semua cookie atau memberi tahu Anda saat cookie dikirim. Namun, jika Anda menonaktifkan cookie, beberapa fitur website mungkin tidak berfungsi dengan baik.
                </p>
            </div>

            <!-- 6. Hak Anda -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">6. Hak Anda</h2>
                <p class="text-gray-600 leading-relaxed">Anda memiliki hak untuk:</p>
                <ul class="list-disc list-inside text-gray-600 leading-relaxed mt-3 space-y-2">
                    <li>Mengakses informasi pribadi yang kami simpan tentang Anda</li>
                    <li>Memperbaiki informasi yang tidak akurat</li>
                    <li>Menghapus informasi pribadi Anda</li>
                    <li>Menarik persetujuan Anda untuk pengolahan data</li>
                    <li>Meminta salinan data Anda dalam format yang dapat dibaca</li>
                </ul>
                <p class="text-gray-600 leading-relaxed mt-3">
                    Untuk menggunakan hak-hak ini, silakan hubungi kami di <strong>hello@fashion.id</strong>.
                </p>
            </div>

            <!-- 7. Pihak Ketiga -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">7. Pihak Ketiga</h2>
                <p class="text-gray-600 leading-relaxed">
                    Kami tidak menjual, memperdagangkan, atau mentransfer informasi pribadi Anda kepada pihak ketiga tanpa pemberitahuan kepada Anda. Ini tidak termasuk mitra terpercaya yang membantu kami mengoperasikan website kami atau melayani Anda, selama pihak-pihak tersebut setuju untuk menjaga kerahasiaan informasi ini.
                </p>
                <p class="text-gray-600 leading-relaxed mt-2">
                    Kami juga dapat merilis informasi Anda jika diwajibkan oleh hukum atau untuk melindungi hak, properti, atau keselamatan kami atau orang lain.
                </p>
            </div>

            <!-- 8. Privasi Anak -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">8. Privasi Anak</h2>
                <p class="text-gray-600 leading-relaxed">
                    Layanan kami tidak ditujukan untuk anak-anak di bawah usia 13 tahun. Kami tidak secara sadar mengumpulkan informasi pribadi dari anak-anak di bawah 13 tahun. Jika Anda yakin anak Anda telah memberikan informasi pribadi kepada kami, silakan hubungi kami.
                </p>
            </div>

            <!-- 9. Perubahan Kebijakan -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3">9. Perubahan Kebijakan Privasi</h2>
                <p class="text-gray-600 leading-relaxed">
                    Kami dapat memperbarui Kebijakan Privasi kami dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan dengan memposting Kebijakan Privasi baru di halaman ini. Kami menyarankan Anda untuk meninjau Kebijakan Privasi ini secara berkala untuk mengetahui perubahan.
                </p>
            </div>

            <!-- 10. Hubungi Kami -->
            <div class="card p-6 bg-secondary/5 border-secondary/20">
                <h2 class="text-xl font-bold text-gray-900 mb-3">10. Hubungi Kami</h2>
                <p class="text-gray-600 leading-relaxed">
                    Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, silakan hubungi kami:
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