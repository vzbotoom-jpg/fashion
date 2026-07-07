@extends('layouts.admin')

@section('title', 'Hasil Pencarian - Admin Panel')
@section('page_title', 'Hasil Pencarian')
@section('page_subtitle', 'Pencarian untuk: "' . $query . '"')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow-sm p-4">
        <p class="text-sm text-gray-500">
            Menampilkan hasil untuk: <span class="font-bold text-gray-900">"{{ $query }}"</span>
        </p>
    </div>

    @php
        $hasResults = false;
    @endphp

    <!-- Products -->
    @if($results['products']->isNotEmpty())
        @php $hasResults = true; @endphp
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Produk ({{ $results['products']->count() }})</h3>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($results['products'] as $product)
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="block px-6 py-3 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $product->category->name ?? 'No Category' }}</p>
                            </div>
                            <span class="text-xs text-gray-400">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Orders -->
    @if($results['orders']->isNotEmpty())
        @php $hasResults = true; @endphp
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Pesanan ({{ $results['orders']->count() }})</h3>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($results['orders'] as $order)
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="block px-6 py-3 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">#{{ $order->order_number }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->name ?? 'Guest' }}</p>
                            </div>
                            <span class="text-xs text-gray-400">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Users -->
    @if($results['users']->isNotEmpty())
        @php $hasResults = true; @endphp
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Pengguna ({{ $results['users']->count() }})</h3>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($results['users'] as $user)
                    <a href="{{ route('admin.super.users.edit', $user->id) }}" class="block px-6 py-3 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                            <span class="text-xs text-gray-400">{{ ucfirst($user->role) }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Messages -->
    @if($results['messages']->isNotEmpty())
        @php $hasResults = true; @endphp
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Pesan ({{ $results['messages']->count() }})</h3>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($results['messages'] as $message)
                    <a href="{{ route('admin.messages.show', $message->id) }}" class="block px-6 py-3 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $message->subject }}</p>
                                <p class="text-xs text-gray-500">Dari: {{ $message->name }}</p>
                            </div>
                            <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- No Results -->
    @if(!$hasResults)
        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <p class="text-lg font-bold text-gray-900">Tidak ada hasil ditemukan</p>
            <p class="text-sm text-gray-500 mt-1">Tidak ada data yang cocok dengan kata kunci "<strong>{{ $query }}</strong>"</p>
            <a href="{{ route('admin.dashboard') }}" class="btn-primary mt-4 inline-block">
                Kembali ke Dashboard
            </a>
        </div>
    @endif
</div>
@endsection