<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    @if (session('success'))
        <div class="flex items-center p-4 my-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                {{ __(session('success')) }}
            </div>
        </div>
    @endif
    <form wire:submit="query" class="mx-5 mt-5">
        <div class="mb-5 animate-bounce">
            <p class="leading-relaxed text-black font-bold text-lg px-4 py-2 border-2 border-orange-400 bg-yellow-100 rounded-md inline-block"
                :class="document.documentElement.dir === 'rtl' ?
                    'animate-slideRTL animate-pulseGlow' :
                    'animate-slideLTR animate-pulseGlow'">
                <span class="font-bold underline">{{ __('Terms of Service') }}</span> :
                {{ __('This is a beta version of the platform for testing and feedback only. Not a commercial launch.') }}
                {{ __('No transactions or sales are taking place at this time.') }}
            </p>
        </div>
        <div class="grid grid-cols-12 gap-2">
            <div class="relative col-span-9 sm:col-span-10 lg:col-span-11 ">
                <label for="search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model="search" type="search" id="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
                {{-- <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button> --}}
            </div>
            <a href="{{ route('post.create') }}"
                class="col-span-3 sm:col-span-2 lg:col-span-1 ms-3 flex justify-between items-center gap-1 border border-main-500 bg-main-500 text-gray-200 rounded-xl px-4 py-2 hover:bg-main-300 hover:text-white hover:border-neutral-100 ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z">
                    </path>
                </svg>
                {{ __('Add') }}
            </a>
        </div>
        <div class="grid grid-cols-12 gap-1 mt-2">
            <div
                class="col-span-12 sm:col-span-3 md:col-span-6 lg:col-span-3 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                <label for="province" class="w-fit ps-0.5 text-sm">{{ __('Province') }}</label>
                <select wire:model.change="provinceId" id="province"
                    class="p-3 w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 py-2 text-sm  disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                    <option selected>{{ __('All Provinces') }}</option>
                    @foreach ($this->provinces as $province)
                        <option value="{{ $province->id }}">
                            {{ app()->getLocale() === 'en' ? Str::ucfirst($province->city_en) : $province->city_ar }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div
                class="col-span-12 sm:col-span-3 md:col-span-6 lg:col-span-3 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                <label for="city" class="w-fit ps-0.5 text-sm">{{ __('City') }}</label>
                <select wire:model.live="cityId" id="city"
                    class="p-3 w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 py-2 text-sm  disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value>{{ __('All Cities') }}</option>
                    @foreach ($this->cities as $city)
                        <option value="{{ $city->id }}">
                            {{ app()->getLocale() === 'en' ? Str::ucfirst($city->city_en) : $city->city_ar }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div
                class="col-span-12 sm:col-span-3 md:col-span-6 lg:col-span-3 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                <label for="minPrice" class="w-fit ps-0.5 text-sm">{{ __('From Price') }}</label>
                <input type="number" wire:model.live="minPrice" id="minPrice"
                    class="h-[38px] text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div
                class="col-span-12 sm:col-span-3 md:col-span-6 lg:col-span-3 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                <label for="maxPrice" class="w-fit ps-0.5 text-sm">{{ __('To Price') }}</label>
                <input type="number" wire:model.live="maxPrice" id="maxPrice"
                    class="h-[38px] text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
        </div>
        <div class="flex gap-3 overflow-x-auto py-3 my-3">
            @foreach ($this->categories as $category)
                <div wire:click="category({{ $category->id }})" wire:key='{{ $category->id }}'
                    class="flex flex-col justify-center items-center cursor-pointer p-3 border-2 rounded-3xl min-w-20 hover:bg-main-200 transform transition duration-300 hover:scale-105 dark:text-neutral-200">
                    <x-icons :type="$category->name_en" />
                    <span
                        class="block mt-3 text-xs text-main-900 dark:text-main-300">{{ app()->getLocale() == 'ar' ? $category->name_ar : Str::ucfirst($category->name_en) }}</span>
                </div>
            @endforeach
        </div>
        <div class="flex gap-3 py-3">
            @if ($subCategories[0] !== null)
                @foreach ($subCategories as $subCategory)
                    <a href="{{ $subCategory?->name_en }}" wire:navigate wire:key='{{ $subCategory?->id }}'
                        class="flex flex-col justify-center items-center cursor-pointer p-3 border-2 rounded-3xl min-w-20 hover:bg-main-200 transform transition duration-300 hover:scale-105 dark:text-neutral-200">
                        <x-icons :type="$subCategory?->name_en" />
                        <span
                            class="block mt-3 text-xs text-main-900 dark:text-main-300">{{ app()->getLocale() == 'ar' ? $subCategory?->name_ar : Str::ucfirst($subCategory?->name_en) }}</span>
                    </a>
                @endforeach
            @endif
        </div>
    </form>
    <div class="grid auto-rows-min gap-4 md:grid-cols-3 mx-auto ">
        @foreach ($posts as $post)
            <div class="relative text-zinc-800 dark:text-zinc-300">
                @auth
                    <button wire:click='bookmark({{ $post->id }})'
                        class="absolute font-medium text-red-200 cursor-pointer top-2 right-2 left-auto rtl:right-auto rtl:left-2 hover:text-red-800 hover:bg-zinc-200 rounded-3xl p-1">
                        <flux:icon.bookmark-square />
                    </button>
                @endauth
                <x-post :post="$post" wire:key="{{ $post->id }}" />
            </div>
        @endforeach
    </div>

    <!-- Main modal -->
    {{-- <div id="default-modal" tabindex="-1" aria-hidden="true" x-data="{ show: true }" x-show="show" x-cloak
        class="flex bg-gray-600/50 dark:bg-gray-800/50 opacity-95 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Terms of Service') }}
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        {{__("This is a beta version of the platform for testing and feedback only. Not a commercial launch.")}}
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        {{ __("No transactions or sales are taking place at this time.") }}
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal" type="button" @click="show = false"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ __('Accept') }}</button>
                </div>
            </div>
        </div>
    </div> --}}


    <div x-intersect.full="$wire.load()"></div>
</div>
