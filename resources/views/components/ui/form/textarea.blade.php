@props([
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
    'rows' => 4,
])

@php
    $id = $id ?? $name;
    $errorName = str_replace(['[', ']'], ['.', ''], $name);
    $hasError = $errors->has($errorName) || ($error && !empty($error));
    $classes = 'w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition resize-y';
    $classes .= $hasError ? ' border-red-500 ring-2 ring-red-500' : ' border-gray-300';
    $classes .= $disabled ? ' opacity-50 cursor-not-allowed bg-gray-100' : ' bg-white';
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

    <!-- Textarea -->
    <textarea
        name="{{ $name }}"
        id="{{ $id }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
        {{ $attributes->merge(['class' => $classes]) }}
    >{{ old($name, $value) }}</textarea>

    <!-- Hint -->
    @if($hint && !$hasError)
        <p class="text-xs text-gray-500">{{ $hint }}</p>
    @endif

    <!-- Error Message -->
    @if($hasError)
        <p class="text-xs text-red-500">{{ $errors->first($errorName) ?? $error }}</p>
    @endif
</div>