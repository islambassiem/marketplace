<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3 mx-auto">
        @foreach ($posts as $post)
            <div class="relative">
                <button
                    wire:confirm='Are you sure you want to remove this post from your favorites?'
                    wire:click="remove({{ $post->id }})"
                    class="absolute font-medium text-red-200 cursor-pointer top-2 right-2 left-auto rtl:right-auto rtl:left-2 hover:text-red-800 hover:bg-zinc-200 rounded-3xl p-1"
                    type="button">
                    <flux:icon.trash />
                </button>
                <x-post :post="$post" wire:key="{{ $post->id }}" />
            </div>
        @endforeach
    </div>
</div>
