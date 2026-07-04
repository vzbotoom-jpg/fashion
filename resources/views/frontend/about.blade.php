@extends('layouts.app')

@section('title', 'Tentang Kami - ' . config('app.name'))
@section('meta_description', 'Tentang Fashion Pre-Order - toko fashion custom terpercaya')

@section('content')
<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Judul Langsung - TANPA BREADCRUMB -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <span class="eyebrow">Cerita Kami</span>
            <h1 class="section-title">Tentang Kami</h1>
            <p class="section-subtitle">
                <strong>{{ config('app.name', 'Fashion Pre-Order') }}</strong> adalah platform fashion yang menyediakan layanan
                pre-order dan custom order untuk mewujudkan pakaian impian Anda.
            </p>
        </div>

        <div class="max-w-4xl mx-auto space-y-24">
            <!-- Vision & Mission -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-gray-50 p-10 rounded-3xl border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Visi Kami</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Menjadi destinasi utama bagi mereka yang mencari fashion berkualitas dengan sentuhan personal,
                        di mana setiap pelanggan bisa mendapatkan produk yang sesuai dengan keinginan dan kebutuhan mereka.
                    </p>
                </div>
                <div class="bg-gray-50 p-10 rounded-3xl border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Misi Kami</h2>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-3">
                            <span class="text-secondary mt-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z"/></svg>
                            </span>
                            Produk berkualitas tinggi dengan bahan terbaik.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-secondary mt-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z"/></svg>
                            </span>
                            Layanan pre-order dengan ukuran presisi.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-secondary mt-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z"/></svg>
                            </span>
                            Custom order sesuai keinginan pelanggan.
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Services -->
            <div>
                <h2 class="text-3xl font-display font-bold text-gray-900 text-center mb-12">Layanan Unggulan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl text-center border border-gray-100 shadow-sm hover:shadow-md transition">
                        <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Beli Langsung</h3>
                        <p class="text-gray-500">Produk ready stock dengan berbagai pilihan ukuran standar.</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl text-center border border-gray-100 shadow-sm hover:shadow-md transition">
                        <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pre-Order</h3>
                        <p class="text-gray-500">Pesan produk favorit Anda dengan ukuran custom yang presisi.</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl text-center border border-gray-100 shadow-sm hover:shadow-md transition">
                        <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Custom Order</h3>
                        <p class="text-gray-500">Wujudkan desain pakaian impian Anda bersama tim ahli kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
@if(isset($testimonials) && $testimonials->isNotEmpty())
    <x-sections.testimonials :testimonials="$testimonials" 
        title="Apa Kata Pelanggan Kami" 
        subtitle="Testimoni dari pelanggan yang telah menggunakan layanan kami"
    />
@endif

<!-- Gallery -->
@if(isset($galleryImages) && $galleryImages->isNotEmpty())
    <x-sections.gallery-showcase 
        :images="$galleryImages" 
        title="Galeri Kami" 
        subtitle="Lihat hasil karya fashion kami"
    />
@endif
@endsection
