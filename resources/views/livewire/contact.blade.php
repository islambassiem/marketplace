<div
    class="border-2 border-dashed mb-4 mt-5 border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg text-zinc-600 dark:text-zinc-300">
    <div class="text-center">
        <h3>
            {{ __("To get in touch with us, please fill the form below. We're here to answer all of your questions and talk you through the benefits of") }}
            {{ config('app.name') }}
        </h3>
    </div>
    <form method="post" wire:submit.prevent="send">
        @csrf
        <div class="my-4">
            @guest
                <x-form.input label="{{ __('Name') }}" class="mt-4 max-w-2xl" placeholder="{{ __('Your name') }}"
                    wire:model="name" />
                @error('name')
                    <p class="text-red-500 text-sm ">{{ $message }}</p>
                @enderror
                <x-form.input label="{{ __('Email') }}" type="email" class="max-w-2xl"
                    placeholder="{{ __('Your email') }}" wire:model="email" />
                @error('email')
                    <p class="text-red-500 text-sm ">{{ $message }}</p>
                @enderror
            @endguest
            <x-form.select label="{{ __('Type') }}" id="type" class="my-4 max-w-2xl" wire:model="type"
                :data="$data"></x-form.select>
            @error('type')
                <p class="text-red-500 text-sm ">{{ $message }}</p>
            @enderror
            <x-form.input label="{{ __('Subject') }}" id="subject" class="my-4 max-w-2xl" wire:model="subject" />
            @error('subject')
                <p class="text-red-500 text-sm ">{{ $message }}</p>
            @enderror
            <x-form.textarea label="{{ __('Body') }}" id="body" class="my-4" wire:model="body" />
            @error('body')
                <p class="text-red-500 text-sm ">{{ $message }}</p>
            @enderror
        </div>
        <x-form.button type="submit" class="flex justify-center items-center gap-1">
            <flux:icon.bookmark-square />
            {{ __('Send') }}
        </x-form.button>
    </form>
</div>
