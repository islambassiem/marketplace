@props([
    'label' => null,
    'id' => null
])

@php
    $inputId = $id ?? Str::slug($label) . '-' . uniqid();
@endphp


<div class="flex items-start mb-6">
    <div class="flex items-center h-5">
    <input type="checkbox" value="" id="{{ $inputId }}"  class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-indigo-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-indigo-600 dark:ring-offset-gray-800" />
    </div>
    <label for="{{ $inputId }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label }}</label>
</div>
