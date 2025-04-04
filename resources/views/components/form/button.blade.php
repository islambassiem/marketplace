@props([
    'type' => 'submit',
])
<button type="{{ $type }}" {!! $attributes->merge([
    'class' =>
        'text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800',
]) !!}>{{ $slot }}</button>

