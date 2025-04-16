<div class="text-zinc-800 dark:text-zinc-200 rounded-md border border-dashed bg-zinc-50 dark:bg-zinc-700 p-5">
    <div class="grid grid-cols-12 w-full mb-5">
        <div class="col-span-3">{{ __('Name') }}:</div>
        <div class="col-span-9">{{ $contact->name }}</div>
    </div>
    <div class="grid grid-cols-12 w-full mb-5">
        <div class="col-span-3">{{ __('Email') }}:</div>
        <div class="col-span-9">{{ $contact->email }}</div>
    </div>
    <div class="grid grid-cols-12 w-full mb-5">
        <div class="col-span-3">{{ __('Subject') }}:</div>
        <div class="col-span-9">{{ $contact->subject }}</div>
    </div>
    <div class="grid grid-cols-12 w-full mb-5">
        <div class="col-span-3">{{ __('Status') }}:</div>
        <div class="col-span-9 relative" x-data="{ open: false }">
            <button x-on:click="open = !open" x-on:click.away="open = false" x-on:keydown.escape="open = false"
                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button">
                {{ __($statuses[$contact->status]) }}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div x-show="open" x-cloak
                class="absolute z-10 w-48 bg-white rounded-lg shadow-sm dark:bg-gray-700 mt-2 p-2">
                @foreach ($statuses as $key => $type)
                    <li wire:key="{{ $key }}">
                        <div
                            wire:click='updateStatus("{{ $key }}")'
                            class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                            <div class="flex items-center">
                                <input @checked($key === $contact->status) id="default-radio-{{ $key }}"
                                    name="filter-radio" type="radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-{{ $key }}"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __($statuses[$key]) }}</label>
                            </div>
                        </div>
                    </li>
                @endforeach
            </div>
        </div>

    </div>
    <div class="grid grid-cols-12 w-full">
        <div class="col-span-3">{{ __('Body') }}:</div>
        <div class="col-span-9 bg-gray-100 dark:bg-gray-700 p-4 rounded-md h-60">{{ $contact->body }}</div>
    </div>
    <div class="flex justify-end mt-5">
        <a href="{{ route('admin.inbox.index') }}"
            class="text-white rtl:rotate-180 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
            <span class="sr-only">Icon description</span>
        </a>
    </div>
</div>
