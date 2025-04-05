<!DOCTYPE html>
<html lang="{{ app()->currentLocale() }}" dir="{{ app()->currentLocale() === 'ar' ? 'rtl' : 'ltr' }}"
    class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 font-alexandria">
    <x-mary-toast />
    <flux:header container
        class="border-b border-zinc-200  dark:border-zinc-700 dark:bg-zinc-900 gap-2 flex items-center">
        <a href="{{ route('home') }}" class="ml-2 mr-5  flex items-center space-x-2 lg:ml-0" wire:navigate>
            <x-app-logo />
        </a>

        <flux:spacer />

        <nav class="-mx-3 flex flex-1 justify-end items-center">
            @livewire('set-locale')
            <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" class="mx-2"/>
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    {{ __('Dashboard') }}
                </a>
                <flux:dropdown position="top" align="end">
                    <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />

                    <flux:menu>
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    </span>

                                    <div class="grid flex-1 text-left text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                                {{ __('Settings') }}</flux:menu.item>
                            <flux:menu.item :href="route('home')" icon="home" wire:navigate>{{ __('Home') }}
                            </flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                                class="w-full">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @else
                <div class="flex gap-2">
                    <a href="{{ route('login') }}"
                        class=" text-white bg-main-700 hover:bg-main-800 focus:ring-4 focus:outline-none focus:ring-main-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-main-600 dark:hover:bg-main-700 dark:focus:ring-main-800">
                        {{ __('Log in') }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                        {{ __('Sign up') }}
                    </a>
                </div>
            @endauth
        </nav>
    </flux:header>


    <main class="mx-3">
        {{ $slot }}
    </main>

    @fluxScripts
</body>

</html>
