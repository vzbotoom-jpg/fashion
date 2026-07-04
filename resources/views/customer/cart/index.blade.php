@extends('layouts.app')

@section('title', 'Keranjang Belanja - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-display font-bold text-gray-800 mb-8 flex items-center gap-3">
            <!-- Shopping Cart Icon -->
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Keranjang Belanja
        </h1>

        @if($cart && $cart->items->isNotEmpty())
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="divide-y divide-gray-100">
                            @foreach($cart->items as $item)
                                <x-sections.cart-item :item="$item" />
                            @endforeach
                        </div>

                        <!-- Clear Cart -->
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <form action="{{ route('customer.cart.clear') }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Kosongkan semua keranjang?')" 
                                        class="text-sm text-red-500 hover:text-red-700 transition flex items-center gap-1">
                                    <!-- Trash Icon -->
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
            <div class="text-center py-16 bg-white rounded-xl shadow-sm">
                <!-- Shopping Cart Icon -->
                <svg class="w-32 h-32 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Keranjang Anda Kosong</h2>
                <p class="text-gray-500 mb-6">Mulai belanja produk fashion favorit Anda sekarang!</p>
                <a href="{{ route('products.index') }}" class="btn-primary px-8 py-3 rounded-lg inline-block flex items-center justify-center gap-2">
                    <!-- Shopping Bag Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</section>
@endsection