@extends('layouts.app')

@section('title', 'Home - ' . config('app.name'))

@section('content')
    <!-- Hero Section -->
    <x-sections.hero />

    <!-- Features Section -->
    <x-sections.features />

    <!-- Categories -->
    <x-sections.categories-grid :categories="$categories ?? []" />

    <!-- Featured Products -->
    <x-sections.product-grid 
        :products="$featuredProducts ?? []" 
        title="Produk Unggulan"
        subtitle="Pilihan terbaik dari koleksi kami"
    />

    <!-- Featured Collections -->
    <x-sections.featured-collections :collections="$collections ?? []" />

    <!-- New Products -->
    <x-sections.product-grid 
        :products="$newProducts ?? []" 
        title="Produk Terbaru"
        subtitle="Koleksi terbaru yang siap mempercantik gaya Anda"
    />

    <!-- Gallery Showcase -->
    <x-sections.gallery-showcase :images="$galleryImages ?? []" />

    <!-- Testimonials -->
    <x-sections.testimonials :testimonials="$testimonials ?? []" />

    <!-- Social Proof -->
    <x-sections.social-proof count="500" icon="🌟" />

    <!-- Newsletter -->
    <x-sections.newsletter />
@endsection
