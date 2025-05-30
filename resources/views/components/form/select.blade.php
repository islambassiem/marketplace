@props([
    'data' => [],
    'id' => null,
    'label' => null,
])
<div class="mb-3">
    <label for="{{ $id }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <select id="{{ $id }}"
        {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
        <option value="0" selected>{{ __('Select an option') }}</option>
        @foreach ($data as $key => $value)
            <option value="{{ $key }}">{{ __($value) }}</option>
        @endforeach
    </select>
</div>
