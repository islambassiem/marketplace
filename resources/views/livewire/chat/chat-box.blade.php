<div
    x-data="{
        height: 0,
        conversationElement: document.getElementById('conversation'),
        markAsRead: null
    }"
    x-init="
    height = conversationElement.scrollHeight;
    $nextTick(() => conversationElement.scrollTop = conversationElement.scrollHeight);"
    @scroll-bottom.window="$nextTick(()=> conversationElement.scrollTop= conversationElement.scrollHeight);"
    class="w-full overflow-hidden">

    <div class="border-b flex flex-col overflow-y-auto grow h-full">


        {{-- header --}}
        <header class="w-full sticky inset-x-0 flex pb-[5px] pt-[5px] top-0 z-10 bg-gray-100 dark:bg-gray-800 border-b ">

            <div class="flex w-full items-center px-2 lg:px-4 gap-2 md:gap-5">
                <a class="shrink-0 lg:hidden" href="{{ route('chat.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d=" M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>
                </a>
                {{-- avatar --}}
                <div class="shrink-0">
                        <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <span class="font-medium text-gray-600 dark:text-gray-300">{{$selectedConversation->getReceiver()->initials() }}</span>
                        </div>
                </div>
                <h6 class="font-bold truncate text-gray-800 dark:text-neutral-300"> {{ $selectedConversation->getReceiver()->name }} </h6>
            </div>
        </header>

{{-- body --}}
<main
    @scroll="
            scrollTop = $el.scrollTop;
            if(scrollTop <= 0){
                $dispatch('loadMore')
            }"
    @update-chat-height.window="
            newHeight= $el.scrollHeight;
            oldHeight= height;
            $el.scrollTop= newHeight- oldHeight;
            height=newHeight;"
    id="conversation"
    class="flex flex-col gap-3 p-2.5 overflow-y-auto  flex-grow overscroll-contain overflow-x-hidden w-full my-auto">

    @if ($loadedMessages)
        @php
            $previousMessage = null;
        @endphp
        @foreach ($loadedMessages as $key => $message)
            {{-- keep track of the previous message --}}
            @if ($key > 0)
                @php
                    $previousMessage = $loadedMessages->get($key - 1);
                @endphp
            @endif
            <div wire:key="{{ time() . $key }}" @class([
                'max-w-[85%] md:max-w-[78%] flex w-auto gap-2 relative mt-2',
                'ms-auto' => $message->sender_id === auth()->id(),
                ])>
                {{-- avatar --}}
                <div @class([
                    'shrink-0',
                    'invisible' => $previousMessage?->sender_id == $message->sender_id,
                    'hidden' => $message->sender_id === auth()->id(),
                ])>
                    <x-avatar src="{{ is_null($message->sender->profile_photo_path) ? null : asset('storage/' . $message->sender->profile_photo_path) }}"></x-avatar>
                </div>
                {{-- messsage body bg-[#f6f6f8fb]--}}
                <div @class([
                    'flex flex-wrap text-[15px]  rounded-xl p-2.5 flex flex-col',
                    'rounded-bl-none border border-gray-200/40 bg-gray-200/50 dark:text-gray-200' => !(
                        $message->sender_id === auth()->id()
                    ),
                    'rounded-br-none bg-blue-500/80 text-white' =>
                        $message->sender_id === auth()->id(),
                ])>



                    <p class="whitespace-normal truncate text-sm md:text-base tracking-wide lg:tracking-normal text-zinc-800 dark:text-gray-200">
                        {{-- show message body --}}
                        {{ $message->body }}
                    </p>
                    <div class="ml-auto flex gap-2">
                        <p @class([
                            'text-xs ',
                            'text-gray-500 dark:text-gray-200' => !($message->sender_id === auth()->id()),
                            'text-white' => $message->sender_id === auth()->id(),
                            ])>
                            {{ $message->created_at->format('g:i a') }}
                        </p>
                        {{-- message status , only show if message belongs auth --}}
                        @if ($message->sender_id === auth()->id())
                            <div x-data="{ markAsRead: @json($message->isRead()) }">
                                {{-- double ticks --}}
                                <span x-cloak x-show="markAsRead" @class(['text-gray-200'])>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                        <path
                                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                    </svg>
                                </span>
                                {{-- single ticks --}}
                                <span x-show="!markAsRead" @class(['text-gray-200'])>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</main>



{{-- send message  --}}

<footer class="shrink-0 z-10 bg-gray-100 dark:bg-gray-600 inset-x-0">

    <div class="p-2 border-t">

        <form x-data="{ body: $wire.entangle('body') }" @submit.prevent="$wire.sendMessage" method="POST" autocapitalize="off">
            @csrf
            <input type="hidden" autocomplete="false" style="display:none">
            <div class="grid grid-cols-12 gap-2">
                <input x-model="body" type="text" autocomplete="off" autofocus placeholder="{{ __('write your message here') }}"
                    maxlength="1700"
                    class="col-span-10 text-zinc-800 dark:text-gray-200 md:col-span-11 bg-gray-200/50 dark:bg-gray-800 border-0 outline-0 focus:border-0 focus:ring-0 hover:ring-0 rounded-lg  focus:outline-none ">
                <button x-bind:disabled="!body" class="col-span-2 md:col-span-1 border-2 border-gray-800 dark:border-gray-100 shadow-lg bg-indigo-500 hover:bg-indigo-300 hover:text-gray-100 text-neutral-300 dark:text-neutral-300 rounded-2xl" type='submit'>{{ __('Send') }}</button>
            </div>

        </form>

        @error('body')
            <p> {{ $message }} </p>
        @enderror

    </div>





</footer>

</div>

</div>
