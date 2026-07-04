@props([
    'variant' => 'default',
    'size' => 'md',
])

@php
    $variants = [
        'default' => 'bg-gray-100 text-gray-800',
        'primary' => 'bg-primary/10 text-primary',
        'success' => 'bg-green-100 text-green-800',
        'danger' => 'bg-red-100 text-red-800',
        'warning' => 'bg-yellow-100 text-yellow-800',
        'info' => 'bg-blue-100 text-blue-800',
    ];
    
    $sizes = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-1 text-sm',
        'lg' => 'px-3 py-1.5 text-base',
    ];
    
    $classes = $variants[$variant] ?? $variants['default'];
    $classes .= ' ' . ($sizes[$size] ?? $sizes['md']);
    $classes .= ' inline-flex items-center rounded-full font-medium';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>