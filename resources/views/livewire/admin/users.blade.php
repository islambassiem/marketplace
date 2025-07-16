<div class="text-zinc-900 dark:text-zinc-100">
    <h1 class="mb-3 text-3xl">{{ __('Users List') }}</h1>

    <div class="relative overflow-x-auto shadow-lg sm:rounded-lg p-10">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

            <div x-data="{ open: false }" class="relative">
                <button x-on:click="open = !open"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    {{ $limit . ' ' . __('Users') }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div x-show="open" x-on:click.away="open = false"
                    class="absolute z-10 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1" role="menu" aria-orientation="vertical"
                    aria-labelledby="dropdownRadioButton">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownRadioButton">
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-1" type="radio" value="" name="filter-radio"
                                    @checked($limit == 5) wire:change='setLimit(5)' x-on:click="open = false"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-1"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">5
                                    {{ __('Users') }}</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-2" type="radio" value=""
                                    @checked($limit == 10) wire:change='setLimit(10)' name="filter-radio"
                                    x-on:click="open = false"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-2"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">10
                                    {{ __('Users') }}</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-3" type="radio" value="" name="filter-radio"
                                    x-on:click="open = false" @checked($limit == 20) wire:change='setLimit(20)'
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-3"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">20
                                    {{ __('Users') }}</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-4" type="radio" value="" name="filter-radio"
                                    x-on:click="open = false" @checked($limit == 50) wire:change='setLimit(50)'
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-4"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">50
                                    {{ __('Users') }}</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search" wire:model.live.debounce.500ms="search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Search for user') }}">
            </div>
        </div>
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
                        {{ __('Ads Count') }}
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        {{ __('Is Admin') }}
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        {{ __('Member since') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Actions') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->posts_count }}
                        </td>
                        {{-- <td class="px-6 py-4">
                            <div class="flex items-center mb-4" x-data>
                                <input id="default-checkbox" type="checkbox" @checked($user->is_admin)
                                    @change="$wire.toggleAdmin({{ $user }})"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                            </div>
                        </td> --}}
                        <td class="px-6 py-4">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 flex items-center gap-2">
                            <div x-data="{ open: false }" x-cloak class="relative">
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
                                <ul x-show="open" x-on:click.away="open = false" x-on:click="open = false"
                                    class="space-y-4 absolute z-50 w-56 p-3 rounded-lg shadow-sm dark:bg-gray-700 top-8 right-0 rtl:left-0 rtl:right-auto mt-2 bg-white">
                                    <li x-data wire:click="toggleAdmin({{ $user->id }})"
                                        class="flex items-center gap-2 text-blue-600 dark:text-blue-500 cursor-pointer ms-4">
                                        <div class="flex items-center mb-4">
                                            <input id="isAdmin" type="checkbox" @checked($user->is_admin)
                                                @change="$wire.toggleAdmin({{ $user }})"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="isAdmin"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Is Admin') }}</label>
                                        </div>
                                    </li>
                                    <li @click="$dispatch('open-delete-modal', { id: {{ $user->id }} })"
                                        class="flex items-center gap-2 text-blue-600 dark:text-blue-500 cursor-pointer ms-3">
                                        <button data-modal-target="popup-modal-{{ $user->id }}"
                                            data-modal-toggle="popup-modal-{{ $user->id }}"
                                            class="font-medium text-red-600 cursor-pointer flex gap-3" type="button">
                                            <flux:icon.trash />
                                            {{ __('Delete') }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $this->users->links() }}
        </div>
    </div>


    <div x-data="{ show: false, userID: null }" x-show="show" x-cloak wire:ignore
        @open-delete-modal.window="userID = $event.detail.id; show = true"
        x-on:user-deleted.window="show = false"
        @click.self="show = false" x-transition.opacity
        class="fixed top-0 right-0 left-0 z-50 flex overflow-y-auto overflow-x-hidden justify-center items-center w-full h-screen bg-black/50">
        <div class="relative p-4 w-full max-w-md bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                @click="show = false">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <div class="p-4 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    {{ __('Are you sure you want to delete this user?') }}
                </h3>

                <form wire:submit.prevent="delete(userID)">
                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        {{ __("Yes, I'm sure") }}
                    </button>
                    <button type="button" @click="show = false"
                        class="ml-3 py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
                        {{ __('Cancel') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
