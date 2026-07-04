@props([
    'route' => null,
    'method' => 'GET',
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-200 p-4']) }}>
    <form action="{{ $route ?? url()->current() }}" method="{{ $method }}" class="space-y-4">
        @csrf
        @if($method === 'GET')
            @method('GET')
        @endif
        
        <!-- Filter Fields -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{ $slot }}
        </div>
        
        <!-- Actions -->
        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <button type="submit" class="btn-primary px-6 py-2 text-sm flex items-center gap-2">
                <!-- Filter Icon -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filter
            </button>
            <a href="{{ $route ?? url()->current() }}" class="text-sm text-gray-500 hover:text-gray-700 transition flex items-center gap-1">
                <!-- Refresh Icon -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Reset Filter
            </a>
        </div>
    </form>
</div>