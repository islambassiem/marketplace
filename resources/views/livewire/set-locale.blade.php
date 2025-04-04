<div x-cloak x-data="{ local: '{{ app()->currentLocale() }}' }" @language-switched.window="window.location.reload();" wire:click="switchLanguage"
    class="mx-2 cursor-pointer hover:bg-zinc-800/5 dark:hover:bg-white/10">
    <span x-show="local === 'ar'"
        class="block p-1 rounded-sm text-zinc-700 dark:text-zinc-100 bg-zinc-200 border border-zinc-400 dark:bg-zinc-800 hover:bg-zinc-300 dark:hover:bg-zinc-600">En</span>
    <span x-show="local === 'en'"
        class="block p-1 rounded-sm text-zinc-700 dark:text-zinc-100 bg-zinc-200 border border-zinc-400 dark:bg-zinc-800 hover:bg-zinc-300 dark:hover:bg-zinc-600">Ar</span>
</div>

