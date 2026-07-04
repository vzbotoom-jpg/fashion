@props([
    'title' => null,
    'subtitle' => null,
    'padding' => true,
    'hover' => false,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-200 ' . ($hover ? 'hover:shadow-md transition-shadow' : '')]) }}>
    @if($title || $subtitle)
        <div class="px-6 py-4 border-b border-gray-200">
            @if($title)
                <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="text-sm text-gray-500">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    
    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>
</div>