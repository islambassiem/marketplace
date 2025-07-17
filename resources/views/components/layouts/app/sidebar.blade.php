<!DOCTYPE html>
<html lang="{{ app()->currentLocale() }}" dir="{{ app()->currentLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 font-alexandria">

    <div
        class="px-6 lg:px-8 h-[55px]  hidden lg:flex items-center justify-end border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        @livewire('set-locale')
        <x-mary-toast />
        <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle"
            aria-label="Toggle dark mode" />
        <!-- Desktop User Menu -->
        <flux:dropdown position="top" align="end">
            <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal text-zinc-600 dark:text-zinc-300">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left rtl:text-right text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:navlist variant="outline">
                    <flux:navlist.group :heading="__('')" class="grid">
                        <flux:navlist.item class="text-zinc-800! dark:text-zinc-200!" icon="users"
                            :href="route('admin.users')" :current="request()->routeIs('admin.users')" wire:navigate>
                            {{ __('Users') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:navlist variant="outline">
                    <flux:navlist.group :heading="__('')" class="grid">
                        <flux:navlist.item class="text-zinc-800! dark:text-zinc-200!" icon="inbox-arrow-down"
                            :href="route('admin.inbox.index')" :current="request()->routeIs('admin.inbox*')"
                            wire:navigate>
                            {{ __('Messages') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:navlist variant="outline">
                    <flux:navlist.group :heading="__('')" class="grid">
                        <flux:navlist.item class="text-zinc-800! dark:text-zinc-200!" icon="layout-grid"
                            :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')"
                            wire:navigate>{{ __('Dashboard') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </div>


    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('')" class="grid">
                <flux:navlist.item class="text-zinc-800! dark:text-zinc-200! py-5" icon="layout-grid"
                    :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('')" class="grid">
                <flux:navlist.item class="text-zinc-800! dark:text-zinc-200! py-5 " icon="users"
                    :href="route('admin.users')" :current="request()->routeIs('admin.users')" wire:navigate>
                    {{ __('Users') }}</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('')" class="grid">
                <flux:navlist.item class="text-zinc-800! dark:text-zinc-200! py-5 " icon="users"
                    :href="route('admin.ads')" :current="request()->routeIs('admin.ads')" wire:navigate>
                    {{ __('Ads') }}</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('')" class="grid">
                <flux:navlist.item class="text-zinc-800! dark:text-zinc-200! py-5" icon="inbox-arrow-down"
                    :href="route('admin.inbox.index')" :current="request()->routeIs('admin.inbox*')" wire:navigate>
                    {{ __('Messages') }}</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        @livewire('set-locale')
        <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle"
            aria-label="Toggle dark mode" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:navlist variant="outline">
                    <flux:navlist.group :heading="__('')" class="grid">
                        <flux:navlist.item class="text-zinc-800! dark:text-zinc-200!" icon="users"
                            :href="route('admin.users')" :current="request()->routeIs('admin.users')" wire:navigate>
                            {{ __('Users') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:navlist variant="outline">
                    <flux:navlist.group :heading="__('')" class="grid">
                        <flux:navlist.item class="text-zinc-800! dark:text-zinc-200!" icon="inbox-arrow-down"
                            :href="route('admin.inbox.index')" :current="request()->routeIs('admin.inbox*')"
                            wire:navigate>
                            {{ __('Messages') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:navlist variant="outline">
                    <flux:navlist.group :heading="__('')" class="grid">
                        <flux:navlist.item class="text-zinc-800! dark:text-zinc-200!" icon="layout-grid"
                            :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')"
                            wire:navigate>{{ __('Dashboard') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
