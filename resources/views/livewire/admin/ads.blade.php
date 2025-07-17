<div class="text-zinc-900 dark:text-zinc-100">
    <h1 class="mb-3 text-3xl">{{ __('Ads List') }}</h1>

    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

        <div class="grid grid-cols-12 gap-2 my-2">
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
                <label for="category" class="w-fit ps-0.5 text-sm">{{ __('Category') }}</label>
                <select wire:model.change="categoryId" id="category"
                    class="p-3 w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 py-2 text-sm  disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                    <option selected>{{ __('All Categories') }}</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">
                            {{ app()->getLocale() === 'en' ? Str::ucfirst($category->name_en) : $category->name_ar }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div
                class="col-span-12 sm:col-span-3 md:col-span-6 lg:col-span-3 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                <label for="subCategory" class="w-fit ps-0.5 text-sm">{{ __('Sub Categories') }}</label>
                <select wire:model.live="subCategoryId" id="subCategory"
                    class="p-3 w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 py-2 text-sm  disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value>{{ __('Sub Categories') }}</option>
                    @foreach ($this->subCategories as $category)
                        <option value="{{ $category->id }}">
                            {{ app()->getLocale() === 'en' ? Str::ucfirst($category->name_en) : $category->name_ar }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
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
                    placeholder="{{ __('Search') }}">
            </div>
        </div>
    </div>

    <section class="bg-neutral-200/40 dark:bg-gray-800 mt-5 rounded-2xl py-5">
        @if (count($posts) == 0)
            <div class="m-auto text-center justify-center flex flex-col gap-3">
                <h4 class="font-medium text-lg text-red-800 dark:text-red-400"> {{ __('No posts found') }} </h4>
            </div>
        @endif
        @foreach ($posts as $post)
            <div wire:key="{{ $post->id }}" class="bg-white dark:bg-gray-500/50 p-6 m-3 rounded-2xl cursor-pointer"
                x-data="{ open: false }" x-on:click="open = !open">
                <header class="flex justify-between items-center mb-2">
                    <p>{{ $post->title }}</p>
                    <span :class="{ 'rotate-180': open }" class="transition ease-in duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </header>
                <section x-show="open" x-collapse.duration.500ms>
                    <div class="grid grid-cols-12 gap-5 mt-5">
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Seller Name') }}
                            </p>
                            <p>{{ $post->user->name }}</p>
                        </div>
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Seller Email') }}
                            </p>
                            <p>{{ $post->user->email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-5 mt-5">
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('City') }}</p>
                            <p>{{ app()->getLocale() === 'ar' ? $post->city->city_ar : $post->city->city_en }}</p>
                        </div>
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Province') }}</p>
                            <p>{{ app()->getLocale() === 'ar' ? $post->city->parent->city_ar : $post->city->parent->city_en }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-5 mt-5">
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Category') }}</p>
                            <p>{{ app()->getLocale() === 'ar' ? $post->category->parent->name_ar : $post->category->parent->name_en }}</p>
                        </div>
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Sub Category') }}</p>
                            <p>{{ app()->getLocale() === 'ar' ? $post->category->name_ar : $post->category->name_en }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-5 mt-5">
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Price') }}</p>
                            <p class="flex"><span>$</span><span>{{ $post->price }}</span></p>
                        </div>
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Photos Count') }}
                            </p>
                            <p>{{ $post->media_count }}</p>
                        </div>
                    </div>

                    <div class="mt-5">
                        <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Details') }}</p>
                        <p class="flex"><span>$</span><span>{{ $post->description }}</span></p>
                    </div>

                    <div class="col-span-12 flex justify-end items-center mt-5">
                        <x-form.button wire:click="$dispatch('open-delete-modal', { id: {{ $post->id }} })"
                            @click.stop type="submit"
                            class="flex justify-center items-center gap-1 bg-red-700 dark:bg-red-600 hover:bg-red-800 dark:hover:bg-red-500">
                            <flux:icon.trash />
                            {{ __('Delete') }}
                        </x-form.button>
                    </div>
                </section>
            </div>
        @endforeach
    </section>

    <div x-data="{ show: false, postId: null }" x-show="show" x-cloak wire:ignore
        @open-delete-modal.window="postId = $event.detail.id; show = true" @close-modal.window="show = false"
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
                    {{ __('Are you sure you want to delete this post?') }}
                </h3>

                <form wire:submit.prevent="delete(postId)">
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
    <div x-intersect.full="$wire.load()"></div>
</div>
