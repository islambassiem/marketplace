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
                            <p>{{ app()->getLocale() === 'ar' ? $post->category->parent->name_ar : $post->category->parent->name_en }}
                            </p>
                        </div>
                        <div class="col-span-6">
                            <p class="text-xs text-zinc-500 dark:text-zinc-300 underline py-2">{{ __('Sub Category') }}
                            </p>
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

                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-2">
                            @foreach ($post->getMedia() as $media)
                                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false"
                                    x-transition wire:key="{ $media->id }}"
                                    class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-3 relative group">

                                    <button type="button" x-show="open"
                                        @click="$dispatch('open-image-delete-modal', { id: {{ $media->id }} })"
                                        class="absolute top-0 right-0 rtl:left-0 z-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="size-8">
                                            <path fill="#afc4e1"
                                                d="M50,21H14v36c0,1.105,0.895,2,2,2h32c1.105,0,2-0.895,2-2V21z" />
                                            <path fill="#becde8" d="M39,59V21H14v36c0,1.104,0.895,2,2,2H39z" />
                                            <path fill="#cad8ed" d="M25,59V21H14v36c0,1.104,0.895,2,2,2H25z" />
                                            <path fill="#afc4e1" d="M14 21H50V24H14z" />
                                            <path fill="#8d6c9f"
                                                d="M48,60H16c-1.654,0-3-1.346-3-3V21c0-0.553,0.448-1,1-1h36c0.552,0,1,0.447,1,1v36 C51,58.654,49.654,60,48,60z M15,22v35c0,0.552,0.449,1,1,1h32c0.551,0,1-0.448,1-1V22H15z" />
                                            <path fill="#a8b7d1"
                                                d="M53,11H11c-1.105,0-2,0.895-2,2v6c0,1.105,0.895,2,2,2h42c1.105,0,2-0.895,2-2v-6 C55,11.895,54.105,11,53,11z" />
                                            <path fill="#8d6c9f"
                                                d="M53,22H11c-1.654,0-3-1.346-3-3v-6c0-1.654,1.346-3,3-3h42c1.654,0,3,1.346,3,3v6 C56,20.654,54.654,22,53,22z M11,12c-0.551,0-1,0.448-1,1v6c0,0.552,0.449,1,1,1h42c0.551,0,1-0.448,1-1v-6c0-0.552-0.449-1-1-1H11 z" />
                                            <path fill="#8d6c9f"
                                                d="M41 12c-.38 0-.743-.218-.911-.586l-2.335-5.137C37.57 6.1 37.323 6 37.063 6H26.937c-.26 0-.506.1-.691.277l-2.335 5.137c-.229.503-.822.726-1.324.496-.502-.229-.725-.821-.496-1.324l2.4-5.28c.037-.081.084-.157.142-.226C25.204 4.394 26.043 4 26.937 4h10.127c.893 0 1.733.394 2.305 1.08.057.068.105.145.142.226l2.4 5.28c.229.503.006 1.096-.496 1.324C41.28 11.972 41.139 12 41 12zM14 18c-.552 0-1-.447-1-1v-2c0-.553.448-1 1-1s1 .447 1 1v2C15 17.553 14.552 18 14 18zM19 18c-.552 0-1-.447-1-1v-2c0-.553.448-1 1-1s1 .447 1 1v2C20 17.553 19.552 18 19 18zM24 18c-.552 0-1-.447-1-1v-2c0-.553.448-1 1-1s1 .447 1 1v2C25 17.553 24.552 18 24 18zM29 18c-.552 0-1-.447-1-1v-2c0-.553.448-1 1-1s1 .447 1 1v2C30 17.553 29.552 18 29 18zM35 18c-.552 0-1-.447-1-1v-2c0-.553.448-1 1-1s1 .447 1 1v2C36 17.553 35.552 18 35 18zM40 18c-.552 0-1-.447-1-1v-2c0-.553.448-1 1-1s1 .447 1 1v2C41 17.553 40.552 18 40 18zM45 18c-.552 0-1-.447-1-1v-2c0-.553.448-1 1-1s1 .447 1 1v2C46 17.553 45.552 18 45 18zM50 18c-.552 0-1-.447-1-1v-2c0-.553.448-1 1-1s1 .447 1 1v2C51 17.553 50.552 18 50 18zM38 56H14c-.552 0-1-.447-1-1s.448-1 1-1h24c.552 0 1 .447 1 1S38.552 56 38 56zM46 56h-4c-.552 0-1-.447-1-1s.448-1 1-1h4c.552 0 1 .447 1 1S46.552 56 46 56zM20 42c-.552 0-1-.447-1-1V29c0-.553.448-1 1-1s1 .447 1 1v12C21 41.553 20.552 42 20 42zM20 50c-.552 0-1-.447-1-1v-4c0-.553.448-1 1-1s1 .447 1 1v4C21 49.553 20.552 50 20 50zM28 50c-.552 0-1-.447-1-1V29c0-.553.448-1 1-1s1 .447 1 1v20C29 49.553 28.552 50 28 50zM36 50c-.552 0-1-.447-1-1V29c0-.553.448-1 1-1s1 .447 1 1v20C37 49.553 36.552 50 36 50zM44 50c-.552 0-1-.447-1-1V37c0-.553.448-1 1-1s1 .447 1 1v12C45 49.553 44.552 50 44 50zM44 34c-.552 0-1-.447-1-1v-4c0-.553.448-1 1-1s1 .447 1 1v4C45 33.553 44.552 34 44 34z" />
                                        </svg>
                                    </button>

                                    <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"
                                        class="object-cover w-[600px] h-[400px] rounded-lg shadow-xl group-hover:scale-105  transition duration-700 ease-out hover:opacity-25">
                                </div>
                            @endforeach
                        </div>
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

    <div x-data="{ show: false, mediaId: null }" x-show="show" x-cloak wire:ignore
        @open-image-delete-modal.window="mediaId = $event.detail.id; show = true" @close-modal.window="show = false"
        @media-deleted.window="show = false" @click.self="show = false"
        class="fixed top-0 right-0 left-0 z-50 flex overflow-y-auto overflow-x-hidden justify-center items-center w-full h-screen bg-black/50">
        <div class="relative p-4 w-full max-w-md bg-white rounded-lg shadow-md dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg w-8 h-8"
                @click="show = false">
                ✕
            </button>
            <div class="p-4 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    {{ __('Are you sure you want to delete this image?') }}
                </h3>
                <button type="button" @click="$wire.deleteImage(mediaId)"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    {{ __("Yes, I'm sure") }}
                </button>
                <button type="button" @click="show = false"
                    class="ml-3 py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>
    </div>

    <div x-intersect.full="$wire.load()"></div>
</div>
