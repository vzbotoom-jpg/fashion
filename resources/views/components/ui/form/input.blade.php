@props([
    'type' => 'text',
    'name' => '',
    'id' => null,
    'value' => '',
    'label' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'autofocus' => false,
    'error' => null,
    'hint' => null,
    'icon' => null,
])

@php
    $id = $id ?? $name;
    $errorName = str_replace(['[', ']'], ['.', ''], $name);
    $hasError = $errors->has($errorName) || ($error && !empty($error));
    $classes = 'w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition';
    $classes .= $hasError ? ' border-red-500 ring-2 ring-red-500' : ' border-gray-300';
    $classes .= $disabled ? ' opacity-50 cursor-not-allowed bg-gray-100' : ' bg-white';
    $classes .= $icon ? ' pl-10' : '';
@endphp

<div class="space-y-1">
    <!-- Label -->
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <!-- Input Wrapper -->
    <div class="relative">
        <!-- Icon -->
        @if($icon)
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                {!! $icon !!}
            </div>
        @endif

        <!-- Input -->
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ $autofocus ? 'autofocus' : '' }}
            {{ $attributes->merge(['class' => $classes]) }}
        >

        <!-- Error Icon -->
        @if($hasError)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
        @endif
    </div>

    <!-- Hint -->
    @if($hint && !$hasError)
        <p class="text-xs text-gray-500">{{ $hint }}</p>
    @endif

    <!-- Error Message -->
    @if($hasError)
        <p class="text-xs text-red-500">{{ $errors->first($errorName) ?? $error }}</p>
    @endif
</div>