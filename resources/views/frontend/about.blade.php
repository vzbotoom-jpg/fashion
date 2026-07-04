@extends('layouts.app')

@section('title', 'Tentang Kami - ' . config('app.name'))
@section('meta_description', 'Pelajari lebih lanjut tentang visi, misi, dan layanan Fashion Pre-Order.')

@section('content')
<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
            <span class="eyebrow">Cerita Kami</span>
            <h1 class="section-title">Mewujudkan Fashion Impian Anda</h1>
            <p class="section-subtitle">
                <strong>{{ config('app.name', 'Fashion Pre-Order') }}</strong> adalah platform yang menghubungkan Anda dengan fashion kustom berkualitas tinggi melalui layanan pre-order dan pesanan khusus.
            </p>
        </div>

        <div class="max-w-5xl mx-auto space-y-24">
            <!-- Vision & Mission -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-gray-50 p-12 rounded-3xl border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Visi Kami</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Menjadi destinasi utama bagi mereka yang mencari fashion berkualitas dengan sentuhan personal, di mana setiap pelanggan bisa mendapatkan produk yang benar-benar mewakili kepribadian mereka.
                    </p>
                </div>
                <div class="bg-gray-50 p-12 rounded-3xl border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Misi Kami</h2>
                    <ul class="space-y-4 text-gray-600">
                        <li class="flex items-start gap-4">
                            <span class="text-secondary shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z"/></svg>
                            </span>
                            Hanya menggunakan bahan baku premium untuk setiap jahitan.
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="text-secondary shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z"/></svg>
                            </span>
                            Layanan pre-order dengan akurasi ukuran yang presisi.
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="text-secondary shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z"/></svg>
                            </span>
                            Memberikan ruang ekspresi tanpa batas melalui custom order.
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Services -->
            <div>
                <div class="text-center mb-16">
                    <span class="eyebrow">Apa Yang Kami Tawarkan</span>
                    <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mt-2">Layanan Unggulan Kami</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-10 rounded-2xl text-center border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-20 h-20 bg-gray-50 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-8">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Ready-to-Wear</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Koleksi pakaian siap pakai dengan desain eksklusif dan ukuran standar terbaik.</p>
                    </div>
                    <div class="bg-white p-10 rounded-2xl text-center border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-20 h-20 bg-gray-50 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-8">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Pre-Order</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Pesan item favorit Anda dengan jaminan ketersediaan dan opsi ukuran kustom.</p>
                    </div>
                    <div class="bg-white p-10 rounded-2xl text-center border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-20 h-20 bg-gray-50 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-8">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Custom Design</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Bekerja sama dengan desainer kami untuk mewujudkan siluet pakaian impian Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
@if(isset($testimonials) && $testimonials->isNotEmpty())
    <x-sections.testimonials :testimonials="$testimonials" 
        title="Kepuasan Pelanggan"
        subtitle="Apa yang mereka katakan tentang pengalaman berbelanja di platform kami."
    />
@endif
@endsection
