@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'full' => false,
    'disabled' => false,
    'loading' => false,
])

@php
    $variants = [
        'primary' => 'bg-primary hover:bg-primary-dark text-white',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white',
        'success' => 'bg-green-500 hover:bg-green-600 text-white',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'outline' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
        'ghost' => 'hover:bg-gray-100 text-gray-700',
    ];
    
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
    ];
    
    $classes = $variants[$variant] ?? $variants['primary'];
    $classes .= ' ' . ($sizes[$size] ?? $sizes['md']);
    $classes .= $full ? ' w-full' : '';
    $classes .= $disabled ? ' opacity-50 cursor-not-allowed' : ' cursor-pointer';
    $classes .= ' font-medium rounded-lg transition duration-200 inline-flex items-center justify-center';
@endphp

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
    @if($disabled) disabled @endif
    @if($loading) disabled @endif
>
    @if($loading)
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif
    {{ $slot }}
</button>