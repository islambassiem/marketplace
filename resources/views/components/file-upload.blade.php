@props(['model', 'postMediaCount'])

@php
    $maxFiles = env('MAX_UPLOAD_NUMNER', 5);
    $maxSize = env('MAX_UPLOAD_SIZE', 2048);
@endphp

<div x-data="{
    files: [],
    maxFiles: {{ $maxFiles - $postMediaCount }},
    maxSize: {{ $maxSize }},
    handleFiles(event) {
        const newFiles = Array.from(event.target.files || event.dataTransfer.files);
        for (let file of newFiles) {
            if (this.files.length >= this.maxFiles) {
                alert(`You can only upload up to ${this.maxFiles} files.`);
                break;
            }
            if (file.size / 1024 > this.maxSize) {
                alert(`${file.name} is too large. Max size is ${this.maxSize / 1024 }MB.`);
                continue;
            }
            this.files.push(file);
        }
    },
    removeFile(index) {
        this.files.splice(index, 1);
    }
}" x-on:drop.prevent="handleFiles($event)" x-on:dragover.prevent
    class="border-dashed border-2  rounded-lg p-6 relative text-gray-900 bg-gray-50 border-gray-300  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white ">

    <input type="file" multiple class="hidden" x-ref="fileInput" x-on:change="handleFiles($event)" accept="image/*"
        {{ $attributes->whereStartsWith('wire:model') }} />

    <button type="button" @click="$refs.fileInput.click()"
        class="w-full h-32 flex flex-col justify-center items-center text-gray-500 cursor-pointer">
        <svg class="w-10 h-10 mb-2 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L4 7m3-3l3 3m10 7v8m0 0l-3-3m3 3l3-3" />
        </svg>
        <p>{{ __('Drag & drop files here or click to upload') }}</p>
        <p class="text-sm text-gray-400 mt-1">{{ __('Max') }} {{ $maxFiles - $postMediaCount }} {{ __('files') }}. {{ __('Max size') }} {{ $maxSize / 1024 }}MB
            {{ __('each') }}.</p>
    </button>

    <template x-for="(file, index) in files" :key="index">
        <div class="relative mt-4 inline-block mr-2" x-show="file.type.startsWith('image/')">
            <img :src="URL.createObjectURL(file)" class="w-32 h-32 object-cover rounded shadow">
            <button type="button" @click="removeFile(index)"
                class="absolute top-0 right-0 p-1 bg-red-500 text-white rounded-full hover:bg-red-600">
                ✕
            </button>
        </div>
    </template>

    <!-- Hidden input for Livewire compatibility -->
    {{-- <template x-for="(file, index) in files" :key="'input-' + index">
        <input type="hidden" :name="'{{ $name }}[]'" :value="file">
    </template> --}}
</div>
