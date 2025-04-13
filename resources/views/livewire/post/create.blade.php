<form method="post" wire:submit.prevent='store' enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-12 gap-4 border-2 border-dashed p-4 rounded-lg">
        <div class="col-span-12 md:col-span-6">
            <div class="mb-3">
                <label for="title"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Title') }}</label>
                <input type="text" id="title" wire:model="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Title') }}" />
            </div>
            @error('title')
                <div class="text-sm text-red-500 -mt-2 mb-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Price') }}</label>
                <input type="number" id="price" wire:model="price" aria-describedby="price-for-product"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Price') }}" />
            </div>
            @error('price')
                <div class="text-sm text-red-500 -mt-2 mb-2">{{ $message }}</div>
            @enderror
            <div class="grid grid-cols-12 gap-2">
                <div
                    class="col-span-6 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300 mb-5">
                    <label for="parent" class="w-fit pl-0.5 text-sm">{{ __('Category') }}</label>
                    <select wire:model.change="patentId" id="parent"
                        class="p-3 w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 py-2 text-sm focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <option selected>{{ __('All Categories') }}</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}">
                                {{ app()->getLocale() === 'en' ? Str::ucfirst($parent->name_en) : $parent->name_ar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div
                    class="col-span-6 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                    <label for="child" class="w-fit pl-0.5 text-sm">{{ __('Sub category') }}</label>
                    <select wire:model.change="category_id" id="category_id"
                        class="p-3 w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 py-2 text-sm focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <option selected>{{ __('All Categories') }}</option>
                        @foreach ($children as $child)
                            <option value="{{ $child->id }}">
                                {{ app()->getLocale() === 'en' ? Str::ucfirst($child->name_en) : $child->name_ar }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-sm text-red-500 mb-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-12 gap-2">
                <div
                    class="col-span-6 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                    <label for="province" class="w-fit ps-0.5 text-sm">{{ __('Province') }}</label>
                    <select wire:model.change="provinceId" id="province"
                        class="p-3 w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 py-2 text-sm  disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <option selected>{{ __('All Provinces') }}</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">
                                {{ app()->getLocale() === 'en' ? Str::ucfirst($province->city_en) : $province->city_ar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div
                    class="col-span-6 relative flex w-full lg:max-w-lg flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                    <label for="city" class="w-fit ps-0.5 text-sm">{{ __('City') }}</label>
                    <select wire:model.change="city_id" id="city"
                        class="p-3 w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 py-2 text-sm  disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value>{{ __('All Cities') }}</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">
                                {{ app()->getLocale() === 'en' ? Str::ucfirst($city->city_en) : $city->city_ar }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <div class="text-sm text-red-500 mb-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-6">
            <label for="message"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Description') }}</label>
            <textarea id="message" rows="8" wire:model="description"
                class="leading-8 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Description') }}"></textarea>
            @error('description')
                <div class="text-sm text-red-500 mb-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-span-12">
            <x-file-upload wire:model='images' postMediaCount="0"/>
            @error('images')
                <div class="text-sm text-red-500 mb-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-span-12 flex justify-end items-center">
            <x-form.button type="submit" class="flex justify-center items-center gap-1">
                <flux:icon.bookmark-square />
                {{ __('Save') }}
            </x-form.button>
        </div>
    </div>
</form>
