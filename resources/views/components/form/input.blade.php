@props([
    'label' => null,
    'type' => 'text',
    'required' => false,
    'autofocus' => false,
    'autocomplete' => true,
    'placeholder' => null,
    'id' => null
])

@php
    $inputId = $id ?? Str::slug($label) . '-' . uniqid();
@endphp

<div>
    @if($label)
        <label for="{{ $inputId }}" class="block mb-2 text-sm font-regular text-gray-900 dark:text-white">{{ $label }}</label>
    @endif

    <input
        id="{{ $inputId }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        autocomplete="{{ $autocomplete }}"
        {{ $required ? 'required' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
        {!! $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500']) !!}
    />
</div>
