@extends('layouts.app')

@section('title', 'Keranjang Belanja - ' . config('app.name'))

@section('content')
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <!-- Judul Langsung - TANPA BREADCRUMB -->
        <div class="mb-12">
            <span class="eyebrow">Pesanan Anda</span>
            <h1 class="section-title">Keranjang Belanja</h1>
        </div>

        @if($cart && $cart->items->isNotEmpty())
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="divide-y divide-gray-100">
                            @foreach($cart->items as $item)
                                <x-sections.cart-item :item="$item" />
                            @endforeach
                        </div>

                        <!-- Clear Cart -->
                        <div class="p-6 bg-gray-50/50 border-t border-gray-100">
                            <form action="{{ route('customer.cart.clear') }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Kosongkan semua keranjang?')" 
                                        class="text-sm font-bold text-red-500 hover:text-red-700 transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="lg:col-span-1">
                    <x-sections.checkout-summary 
                        :cart="$cart"
                        :subtotal="$cartTotal"
                        :shipping="0"
                        :tax="0"
                        :grandTotal="$cartTotal"
                    />
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-24 bg-white rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Keranjang Anda Kosong</h2>
                <p class="text-gray-500 mb-8 max-w-sm mx-auto">Mulai belanja produk fashion favorit Anda sekarang dan temukan gaya terbaikmu!</p>
                <a href="{{ route('products.index') }}" class="btn-primary !px-10">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
