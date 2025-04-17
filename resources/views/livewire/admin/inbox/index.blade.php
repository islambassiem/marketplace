<div class="text-zinc-900 dark:text-zinc-100">
    <h1 class="mb-3 text-3xl">{{ __('Messages List') }}</h1>

    <div class="flex items-center gap-4">
        <!-- Filter messages type -->
        <div x-data="{ open: false }" class="relative mt-7">
            <div class="text-zinc-700 dark:text-zinc-100">{{ __('Types') }}</div>
            <button
                class="my-3 inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button" x-on:click="open = !open" x-on:click.away="open = false"> {{ __('Messages Type') }}
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <div x-show="open" class="absolute z-10 w-48 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
                    @foreach ($types as $key => $type)
                        <li wire:key="{{ $key }}">
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="checkbox-filter-{{ $key }}" type="checkbox"
                                    wire:click='toggleFilterType("{{ $key }}")'
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-filter-{{ $key }}"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">{{ __($type) }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Filter messages type -->

        <!-- Filter messages Status -->
        <div x-data="{ open: false }" class="relative mt-7">
            <div class="text-zinc-700 dark:text-zinc-100">{{ __('Status') }}</div>
            <button
                class="my-3 inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button" x-on:click="open = !open" x-on:click.away="open = false"> {{ __('Status') }}
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <div x-show="open" class="absolute z-10 w-48 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
                    @foreach ($statuses as $key => $status)
                        <li wire:key="{{ $key }}">
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="checkbox-status-{{ $key }}" type="checkbox"
                                    wire:click='toggleFilterStatus("{{ $key }}")'
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-status-{{ $key }}"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">{{ __($status) }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Filter messages Status -->

        <!-- Filter messages read -->
        <div x-data="{ open: false }" class="relative mt-7">
            <div class="text-zinc-700 dark:text-zinc-100">{{ __('Read') }}</div>
            <button
                class="my-3 inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button" x-on:click="open = !open" x-on:click.away="open = false"> {{ __('Read') }}
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <div x-show="open" class="absolute z-10 w-48 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
                    <li wire:key="0">
                        <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-read-0" type="checkbox" wire:click='toggleFilterRead("0")'
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-read-0"
                                class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">{{ __('Unread') }}</label>
                        </div>
                    </li>
                    <li wire:key="1">
                        <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-read-1" type="checkbox" wire:click='toggleFilterRead("1")'
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-read-1"
                                class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">{{ __('Read') }}</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Filter messages read -->
    </div>

    @if ($this->contacts->count())
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Email') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Subject') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Created at') }}
                    </th>
                    <th scope="col" class="px-6 py-3">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->contacts as $contact)
                    <tr @class([
                        'bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600',
                        'text-gray-900 dark:text-gray-100' => !$contact->is_read,
                    ])>
                        <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                            {{ $contact->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $contact->email ?? $contact->user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $contact->subject }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $contact->created_at->format('d M, Y') }}
                        </td>
                        <td class="px-6 py-4 flex items-center gap-2">
                            <div x-data="{ open: false }" class="relative">
                                <button x-on:click="open = !open"
                                    class="inline-flex items-center p-2 text-sm text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                    type="button">
                                    <span class="sr-only">Open dropdown</span>
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 4 15">
                                        <path
                                            d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                    </svg>
                                </button>
                                <ul x-show="open" x-on:click.away="open = false"
                                    wire:click="toggleRead({{ $contact->id }})" x-on:click="open = false"
                                    class="space-y-4 absolute z-50 w-56 p-3 rounded-lg shadow-sm dark:bg-gray-700 top-8 right-0 rtl:left-0 rtl:right-auto mt-2 bg-white">
                                    <li
                                        class="flex items-center gap-2 text-blue-600 dark:text-blue-500 cursor-pointer ms-4 hover:underline">
                                        <span>
                                            @if ($contact->is_read)
                                                <flux:icon.eye />
                                            @else
                                                <flux:icon.eye-slash />
                                            @endif
                                        </span>
                                        {{ $contact->is_read ? __('Mark as unread') : __('Mark as read') }}
                                    </li>
                                    <li
                                        class="flex items-center gap-2 text-blue-600 dark:text-blue-500 cursor-pointer ms-4 hover:underline">
                                        <flux:icon.document-magnifying-glass />
                                        <a href="{{ route('admin.inbox.show', $contact) }}">
                                            {{ __('Details') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $this->contacts->links() }}
        </div>
    @else
        <div class="flex items-center p-4 my-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                {{ __('No messages found') }}
            </div>
        </div>
    @endif
</div>
