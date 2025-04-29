<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">

    @if ($posts->count() == 0)
        <div class="flex flex-col items-center justify-center w-full h-full p-4 text-center rounded-lg bg-red-100">
            <svg class="w-12 h-12 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 6h18M9 6V4a2 2 0 0 1 4 0v2m-4 0h8m-8 0v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6m16 0v12a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V6m8-4h-4l-1.5-1.5H7.5L6 2H3a1.5 1.5 0 0 0-1.5 1.5V6h18V3.5A1.5 1.5 0 0 0 19.5 2Z" />
            </svg>
            <p class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                {{ __('No favorites yet') }}
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mx-auto max-w-screen-xl">
            @foreach ($posts as $post)
                <div class="relative">
                    <button data-modal-target="popup-modal-{{ $post->id }}"
                        data-modal-toggle="popup-modal-{{ $post->id }}"
                        @click="$dispatch('open-delete-modal', { id: {{ $post->id }} })"
                        class="absolute font-medium text-red-200 cursor-pointer top-2 right-2 left-auto rtl:right-auto rtl:left-2 hover:text-red-800 hover:bg-zinc-200 rounded-3xl p-1"
                        type="button">
                        <flux:icon.trash />
                    </button>
                    <x-post :post="$post" wire:key="{{ $post->id }}" />
                </div>
            @endforeach
        </div>

    @endif

    <script>
        Livewire.on('postDeleted', (postId) => {
            window.dispatchEvent(new CustomEvent('close-modal', {
                detail: {
                    id: postId
                }
            }));
        });
    </script>

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
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    {{ __('Are you sure you want to delete this ad from favorites?') }}
                </h3>

                <form wire:submit.prevent="remove(postId)">
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
</div>
