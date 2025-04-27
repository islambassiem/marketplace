<div class="text-zinc-900 dark:text-zinc-100">

    <form wire:submit.prevent='reender'>
        <div class="flex items-center gap-3">
            <x-form.date id="startDate" wire:model='startDate' label="{{ __('Select date start') }}" />
            <x-form.date id="endDate" wire:model='endDate' label="{{ __('Select date end') }}" />
        </div>

        <x-form.button type="submit" class="mt-4">
            {{ __('Submit') }}
        </x-form.button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
        <a href="{{ route('admin.users') }}" wire:navigate
            class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.users class="size-24" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->usersCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Users') }}</h2>
        </a>

        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.badge class="size-24" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->adsCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Ads') }}</h2>
        </div>

        <a href="{{ route('admin.inbox.index') }}" wire:navigate
            class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.messages class="size-24" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->messagesCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Messages') }}</h2>
        </a>

        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.image class="size-24" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->imagesCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Images') }}</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.bell class="size-12" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->complaintsCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Complaints') }}</h2>
            <div class="flex gap-2 justify-between w-full px-20">
                <div class="flex flex-col justify-center items-center text-green-500">
                    {{ $this->complaintsReadCount }}
                    <x-icons.eye class="size-6 text-green-500" />
                </div>
                <div class="flex flex-col justify-center items-center text-red-500">
                    {{ $this->complaintsUnReadCount }}
                    <x-icons.eye-slash class="size-6 text-red-500" />
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.question class="size-12" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->questionsCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Questions') }}</h2>
            <div class="flex gap-2 justify-between w-full px-20">
                <div class="flex flex-col justify-center items-center text-green-500">
                    {{ $this->questionsReadCount }}
                    <x-icons.eye class="size-6 text-green-500" />
                </div>
                <div class="flex flex-col justify-center items-center text-red-500">
                    {{ $this->questionsUnReadCount }}
                    <x-icons.eye-slash class="size-6 text-red-500" />
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.question class="size-12" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->suggestionsCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Suggestions') }}</h2>
            <div class="flex gap-2 justify-between w-full px-20">
                <div class="flex flex-col justify-center items-center text-green-500">
                    {{ $this->suggestionsReadCount }}
                    <x-icons.eye class="size-6 text-green-500" />
                </div>
                <div class="flex flex-col justify-center items-center text-red-500">
                    {{ $this->questionsUnReadCount }}
                    <x-icons.eye-slash class="size-6 text-red-500" />
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.label class="size-12" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->otherCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Other') }}</h2>
            <div class="flex gap-2 justify-between w-full px-20">
                <div class="flex flex-col justify-center items-center text-green-500">
                    {{ $this->otherReadCount }}
                    <x-icons.eye class="size-6 text-green-500" />
                </div>
                <div class="flex flex-col justify-center items-center text-red-500">
                    {{ $this->otherUnReadCount }}
                    <x-icons.eye-slash class="size-6 text-red-500" />
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.clock class="size-12" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->pendingCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Pending') }}</h2>
            <div class="flex gap-2 justify-between w-full px-20">
                <div class="flex flex-col justify-center items-center text-green-500">
                    {{ $this->pendingReadCount }}
                    <x-icons.eye class="size-6 text-green-500" />
                </div>
                <div class="flex flex-col justify-center items-center text-red-500">
                    {{ $this->pendingUnReadCount }}
                    <x-icons.eye-slash class="size-6 text-red-500" />
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.in-process class="size-12" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->inProcessCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('In Progress') }}</h2>
            <div class="flex gap-2 justify-between w-full px-20">
                <div class="flex flex-col justify-center items-center text-green-500">
                    {{ $this->inProcessReadCount }}
                    <x-icons.eye class="size-6 text-green-500" />
                </div>
                <div class="flex flex-col justify-center items-center text-red-500">
                    {{ $this->inProcessUnReadCount }}
                    <x-icons.eye-slash class="size-6 text-red-500" />
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.check-circile class="size-12" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->completedCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Completed') }}</h2>
            <div class="flex gap-2 justify-between w-full px-20">
                <div class="flex flex-col justify-center items-center text-green-500">
                    {{ $this->completedReadCount }}
                    <x-icons.eye class="size-6 text-green-500" />
                </div>
                <div class="flex flex-col justify-center items-center text-red-500">
                    {{ $this->completedUnReadCount }}
                    <x-icons.eye-slash class="size-6 text-red-500" />
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-700 shadow-2xl rounded-lg p-4 flex flex-col items-center gap-4">
            <x-icons.check class="size-12" />
            <p class="text-main-600 text-5xl font-bold">{{ $this->resolvedCount }}</p>
            <h2 class=" font-semibold mb-2">{{ __('Resolved') }}</h2>
            <div class="flex gap-2 justify-between w-full px-20">
                <div class="flex flex-col justify-center items-center text-green-500">
                    {{ $this->resolvedReadCount }}
                    <x-icons.eye class="size-6 text-green-500" />
                </div>
                <div class="flex flex-col justify-center items-center text-red-500">
                    {{ $this->resolvedUnReadCount }}
                    <x-icons.eye-slash class="size-6 text-red-500" />
                </div>
            </div>
        </div>
    </div>
</div>
