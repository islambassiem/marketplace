<div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">

    <div class="p-4 rounded-lg ">
        <h2 class="text-2xl font-bold py-4 text-zinc-600 dark:text-zinc-300">{{ $post->title }}</h2>
        <!-- Alpine.js Carousel -->
        @if (count($post->getMedia()) > 0)
            <div x-data="{
                currentSlide: 0,
                autoplayIntervalTime: 3000,
                isPaused: false,
                autoplayInterval: null,
                next() {
                    if (this.currentSlide === {{ $post->media->count() - 1 }}) {
                        this.currentSlide = 0
                    } else {
                        this.currentSlide = this.currentSlide + 1
                    }
                },
                previous() {
                    if (this.currentSlide === 0) {
                        this.currentSlide = {{ $post->media->count() - 1 }}
                    } else {
                        this.currentSlide = this.currentSlide - 1
                    }
                },
                autoplay() {
                    this.autoplayInterval = setInterval(() => {
                        if (!this.isPaused) {
                            this.next()
                        }
                    }, this.autoplayIntervalTime)
                },
                // Updates interval time
                setAutoplayInterval(newIntervalTime) {
                    clearInterval(this.autoplayInterval)
                    this.autoplayIntervalTime = newIntervalTime
                    this.autoplay()
                },
            }" class="relative w-full max-w-lg mx-auto" x-init="autoplay">
                <div class="relative overflow-hidden">
                    <!-- Images -->
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="`transform: translateX(${document.documentElement.dir === 'rtl' ? '' : '-'}${currentSlide * 100}%)`">
                        @foreach ($post->getMedia() as $media)
                            <img src="{{ $media->getUrl() }}" alt="Media {{ $loop->index + 1 }}" class="w-full">
                        @endforeach
                    </div>
                </div>

                <!-- previous button -->
                <button type="button"
                    class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0 dark:bg-neutral-950/40 dark:text-neutral-300 dark:hover:bg-neutral-950/60 dark:focus-visible:outline-white"
                    aria-label="previous slide" x-on:click="previous">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                        stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <!-- next button -->
                <button type="button"
                    class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0 dark:bg-neutral-950/40 dark:text-neutral-300 dark:hover:bg-neutral-950/60 dark:focus-visible:outline-white"
                    aria-label="next slide" x-on:click="next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                        stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

                <!-- Pause/Play Button -->
                <button type="button"
                    class="absolute bottom-5 right-5 z-20 rounded-full text-on-surface-dark opacity-50 transition hover:opacity-80 focus-visible:opacity-80 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-dark active:outline-offset-0"
                    aria-label="pause carousel"
                    x-on:click="(isPaused = !isPaused), setAutoplayInterval(autoplayIntervalTime)"
                    x-bind:aria-pressed="isPaused">
                    <svg x-cloak x-show="isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true" class="size-7">
                        <path fill-rule="evenodd"
                            d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z"
                            clip-rule="evenodd">
                    </svg>
                    <svg x-cloak x-show="!isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true" class="size-7">
                        <path fill-rule="evenodd"
                            d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm5-2.25A.75.75 0 0 1 7.75 7h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Zm4 0a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Z"
                            clip-rule="evenodd">
                    </svg>
                </button>

                <!-- Indicators -->
                <div class="flex justify-center mt-2 space-x-2">
                    @foreach ($post->media as $index => $media)
                        <button x-on:click="currentSlide = {{ $index }}"
                            :class="currentSlide === {{ $index }} ? 'bg-blue-500' : 'bg-gray-300'"
                            class="w-3 h-3 rounded-full">
                        </button>
                    @endforeach
                </div>
            </div>
        @endif
        <p class="py-1 font-bold underline text-zinc-600 dark:text-zinc-300">{{ __('Price') }}:</p>
        <p class="text-zinc-600 dark:text-zinc-300">${{ number_format($post->price, 2) }}</p>
        <p class="py-1 font-bold underline text-zinc-600 dark:text-zinc-300">{{ __('Description') }}:</p>
        <p class="text-justify text-lg text-zinc-600 dark:text-zinc-300">{{ Str::limit($post->description, 100) }}</p>
    </div>
</div>
