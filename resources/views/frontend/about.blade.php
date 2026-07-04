@extends('layouts.app')

@section('title', 'Tentang Kami - ' . config('app.name'))
@section('meta_description', 'Tentang Fashion Pre-Order - toko fashion custom terpercaya')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-display font-bold text-gray-800 mb-6">Tentang Kami</h1>
            
            <div class="prose prose-lg text-gray-600">
                <p class="lead">
                    <strong>{{ config('app.name', 'Fashion Pre-Order') }}</strong> adalah platform fashion yang menyediakan layanan 
                    pre-order dan custom order untuk berbagai kebutuhan fashion Anda.
                </p>
                
                <h2 class="text-2xl font-semibold text-gray-800 mt-8">Visi Kami</h2>
                <p>
                    Menjadi destinasi utama bagi mereka yang mencari fashion berkualitas dengan sentuhan personal, 
                    di mana setiap pelanggan bisa mendapatkan produk yang sesuai dengan keinginan dan kebutuhan mereka.
                </p>
                
                <h2 class="text-2xl font-semibold text-gray-800 mt-8">Misi Kami</h2>
                <ul>
                    <li>Menyediakan produk fashion berkualitas dengan bahan terbaik</li>
                    <li>Memberikan layanan pre-order dengan ukuran yang presisi</li>
                    <li>Memungkinkan pelanggan untuk membuat custom order sesuai keinginan</li>
                    <li>Menjaga kepuasan pelanggan dengan pelayanan yang ramah dan profesional</li>
                </ul>
                
                <h2 class="text-2xl font-semibold text-gray-800 mt-8">Layanan Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div class="bg-gray-50 p-6 rounded-xl text-center">
                        <!-- Shopping Bag Icon -->
                        <svg class="w-12 h-12 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <h3 class="font-semibold text-gray-800">Beli Langsung</h3>
                        <p class="text-sm text-gray-500">Produk ready stock dengan ukuran tersedia</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl text-center">
                        <!-- Package Icon -->
                        <svg class="w-12 h-12 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <h3 class="font-semibold text-gray-800">Pre-Order</h3>
                        <p class="text-sm text-gray-500">Pesan dengan ukuran yang Anda inginkan</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl text-center">
                        <!-- Paint Brush Icon -->
                        <svg class="w-12 h-12 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        <h3 class="font-semibold text-gray-800">Custom Order</h3>
                        <p class="text-sm text-gray-500">Buat desain sesuai keinginan Anda</p>
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