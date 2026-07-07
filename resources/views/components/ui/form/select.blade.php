@props([
    'name' => '',
    'id' => null,
    'value' => '',
    'label' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'autofocus' => false,
    'error' => null,
    'hint' => null,
    'options' => [],
    'optionValue' => 'id',
    'optionLabel' => 'name',
])

@php
    $id = $id ?? $name;
    $errorName = str_replace(['[', ']'], ['.', ''], $name);
    $hasError = $errors->has($errorName) || ($error && !empty($error));
    $classes = 'w-full px-4 py-2.5 border rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition appearance-none';
    $classes .= $hasError ? ' border-danger ring-1 ring-danger' : ' border-gray-300';
    $classes .= $disabled ? ' opacity-50 cursor-not-allowed bg-gray-100' : ' bg-white';
@endphp

<div class="space-y-1">
    <!-- Label -->
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <!-- Select Wrapper -->
    <div class="relative">
        <select
            name="{{ $name }}"
            id="{{ $id }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $autofocus ? 'autofocus' : '' }}
            {{ $attributes->merge(['class' => $classes]) }}
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach($options as $option)
                @php
                    $optionValueKey = $optionValue;
                    $optionLabelKey = $optionLabel;
                    $currentOptionValue = data_get($option, $optionValueKey);
                    $currentOptionLabel = data_get($option, $optionLabelKey);
                    $selected = old($name, $value) == $currentOptionValue;
                @endphp
                <option value="{{ is_array($currentOptionValue) ? json_encode($currentOptionValue) : $currentOptionValue }}" {{ $selected ? 'selected' : '' }}>
                    {{ is_array($currentOptionLabel) ? json_encode($currentOptionLabel) : $currentOptionLabel }}
                </option>
            @endforeach
        </select>

        <!-- Dropdown Arrow -->
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        <!-- Error Icon -->
        @if($hasError)
            <div class="absolute inset-y-0 right-8 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-danger" fill="currentColor" viewBox="0 0 20 20">
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
        <p class="text-xs text-danger font-medium">{{ $errors->first($errorName) ?? $error }}</p>
    @endif
</div>