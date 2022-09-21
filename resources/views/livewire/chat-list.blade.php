<div>
    <h2 class="text-3xl font-bold dark:text-white mb-4">Lista de chats</h2>
    
    @if ( count( $chats ) > 0 )
        <div class="flex flex-col text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <div class="grid grid-cols-7 gap-4 px-4 py-2 bg-blue-700 text-white font-semibold rounded-t-lg border-b-2 content-center align-middle">
                <span class="self-center col-span-2">Servicio</span>    
                <span class="self-center col-span-2">Creador</span>    
                <span class="self-center col-span-2">Hablando con</span>    
            </div>
            @foreach ( $chats as $chat )
                <x-chat-item-list :chat="(object)$chat"></x-chat-item-list>
            @endforeach
        </div>
    @else
        <p class="ml-4 text-xl font-semibold dark:text-white mb-4">No hay chats que mostrar</p>
    @endif
    

</div>
