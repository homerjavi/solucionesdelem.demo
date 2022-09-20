<x-app-layout>
    <div class="py-12 flex-col">
        <div>
            <livewire:chat-list :chats="$chats">
        </div>
        <div class="mt-12">
            <livewire:chat-conversation>
        </div>
    </div>
</x-app-layout>
