@extends('layouts.app')

@section('title', 'Kontak - ' . config('app.name'))
@section('meta_description', 'Hubungi kami untuk pertanyaan atau informasi lebih lanjut')

@section('content')
<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Judul Langsung - TANPA BREADCRUMB -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <span class="eyebrow">Hubungi Kami</span>
            <h1 class="section-title">Bantuan & Kontak</h1>
            <p class="section-subtitle">Ada pertanyaan tentang produk atau pesanan Anda? Tim kami siap membantu Anda setiap saat.</p>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Contact Info -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-secondary shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Alamat</p>
                                    <p class="text-gray-900 font-medium">Jl. Fashion No. 123, Jakarta Selatan</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-secondary shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Telepon</p>
                                    <p class="text-gray-900 font-medium">0812-3456-7890</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-secondary shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email</p>
                                    <p class="text-gray-900 font-medium">hello@fashion.id</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-secondary/5 p-8 rounded-3xl border border-secondary/10">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Jam Operasional</h2>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p class="flex justify-between"><span>Senin - Jumat</span> <span class="font-bold text-gray-900">09:00 - 18:00</span></p>
                            <p class="flex justify-between"><span>Sabtu</span> <span class="font-bold text-gray-900">10:00 - 16:00</span></p>
                            <p class="flex justify-between"><span>Minggu</span> <span class="font-bold text-gray-900 text-red-500">Tutup</span></p>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-xl p-8 md:p-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">Kirim Pesan</h2>
                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                           class="form-input" placeholder="Masukkan nama Anda">
                                </div>
                                <div>
                                    <label class="form-label">Alamat Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           class="form-input" placeholder="email@contoh.com">
                                </div>
                            </div>

                            <div>
                                <label class="form-label">Subjek Pesan <span class="text-red-500">*</span></label>
                                <input type="text" name="subject" value="{{ old('subject') }}" required
                                       class="form-input" placeholder="Apa yang bisa kami bantu?">
                            </div>

                            <div>
                                <label class="form-label">Pesan Anda <span class="text-red-500">*</span></label>
                                <textarea name="message" rows="5" required
                                          class="form-input" placeholder="Tuliskan detail pertanyaan atau masukan Anda di sini..."></textarea>
                            </div>

                            <button type="submit" class="w-full btn-primary !py-4 rounded-xl flex items-center justify-center gap-3 shadow-xl shadow-primary/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Kirim Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
