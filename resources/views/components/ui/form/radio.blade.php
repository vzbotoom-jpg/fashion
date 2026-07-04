@props([
    'name' => '',
    'id' => null,
    'value' => '',
    'checked' => false,
    'label' => null,
    'required' => false,
    'disabled' => false,
    'error' => null,
    'hint' => null,
    'group' => null,
])

@php
    $id = $id ?? $name . '_' . Str::slug($value);
    $errorName = str_replace(['[', ']'], ['.', ''], $name);
    $hasError = $errors->has($errorName) || ($error && !empty($error));
    $isChecked = old($name, $checked) == $value;
@endphp

<div class="space-y-1">
    <div class="flex items-start">
        <div class="flex items-center h-5">
            <input
                type="radio"
                name="{{ $name }}"
                id="{{ $id }}"
                value="{{ $value }}"
                {{ $isChecked ? 'checked' : '' }}
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->merge(['class' => 'w-4 h-4 text-primary border-gray-300 focus:ring-primary transition']) }}
            >
        </div>

        @if($label)
            <label for="{{ $id }}" class="ml-2 text-sm text-gray-700">
                {{ $label }}
                @if($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>
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