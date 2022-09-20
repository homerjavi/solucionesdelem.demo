@props( ['chat'] )

<div class="grid grid-cols-7 gap-4 px-4 py-2 border-b-2 content-center align-middle">
    <span class="self-center col-span-2">{{ $chat->service->title }}</span>    
    <span class="self-center col-span-2">{{ $chat->service->user->name }}</span>    
    <span class="self-center col-span-2">
        {{ $chat->user->id == auth()->user()->id ? $chat->service->user->name : $chat->user->name }}
    </span>    
    <div class="flex justify-end cursor-pointer" wire:click="openChat( {{ $chat->id }} )">
        <div class="max-w-fit inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Chat
            <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </div>
    </div>
</div>