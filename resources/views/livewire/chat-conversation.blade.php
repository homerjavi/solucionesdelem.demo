<div>
    <div>
        @if ( session()->has( 'message' ) )
            <div class="flex items-center p-4 space-x-4 max-w-xs text-gray-500 bg-green-100 rounded-lg divide-x divide-gray-200 shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" style="position: absolute; top: 5px; right: 5px; min-width: 300px;">
                <svg aria-hidden="true" class="w-5 h-5 text-blue-600 dark:text-blue-500" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path></svg>
                <div class="ml-4 text-sm font-normal">{{ session('message') }}</div>
            </div>
        @endif
    </div>

    @if ( $chat->id )
        <h2 class="text-3xl font-bold dark:text-white mb-4">
            Chat con {{ $chat->user_id == auth()->user()->id ? $chat->service->user->name : $chat->user->name }}
            ( {{ $chat->service->title }} )
        </h2>
        <div class="p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col-reverse">
                @foreach ( $messages as $message )
                    <div class="relative flex flex-col w-2/3 p-4 mb-4 text-sm rounded-lg {{ $message->user_id == auth()->user()->id ? 'text-green-900 bg-green-100' : 'text-gray-700 bg-gray-100 self-end' }}">
                        <span class="font-bold">{{ $message->user->name }}</span>
                        @if ($message->type == 'text')
                            <span class="font-medium text-gray-800">{{ $message->content }}</span>
                        @elseif ( isImage( $message->type ) )
                            <img src="{{ asset( $message->content ) }}"/>
                        @else
                            <a href="{{ asset( $message->content ) }}" target="_blank" class="flex justify-between content-end font-medium text-gray-800">
                                <span>{{ $message->file_name }} </span>
                                <span class="material-symbols-outlined">
                                    file_download
                                </span>
                            </a>
                        @endif
                        <small class="absolute" style="top: 4px; right: 10px;">{{ ( new \Carbon\Carbon( $message->created_at ) )->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>
            <div>
                {{ $messages->links() }}
                <x-label class="mt-4" for="newMessage" value="Nuevo mensaje" />
                <div class="flex gap-4">
                    <x-input wire:model="newMessage" id="newMessage" class="block mt-1 w-full" type="text" name="newMessage" autofocus />
                    @error('newMessage') <span class="error">{{ $message }}</span> @enderror
                    <x-button wire:click="sendNewMessage">
                        Enviar
                    </x-button>
                </div>
            </div>
            <div>                
                <form wire:submit.prevent="uploadFile">
                    <x-label class="mt-4" for="file" value="Si lo desea también puede enviar un archivo" />
                    <input type="file" wire:model="file" name="file" id="file" class="hidden">
                    <x-button-link id="chooseFile" onclick="document.getElementById( 'file' ).click()">
                        Seleccionar archivo
                    </x-button-link>

                    @error('file') <span class="error">{{ $message }}</span> @enderror
                    @if ( $file )
                        <x-button type="submit">
                            Subir
                            <span class="material-symbols-outlined ml-2">
                                cloud_upload
                            </span>
                        </x-button>
                    @endif
                    <div wire:loading wire:target="file">
                        <span>Uploading...</span>
                    </div>
                </form>

                @if ( $file && isImage( $file->getMimeType() ) )
                    <img src="{{ asset( $file->temporaryUrl() ) }}"/>
                @endif
            </div>
        </div>
        <script>        
            var pusher = new Pusher('f1a14c0d56baf1384958', {
              cluster: 'eu'
            });
        
            var channel = pusher.subscribe('chat-channel');
            channel.bind('chat-event', function(data) {
              window.livewire.emit( 'render', data );
            });

        </script>
    @endif
</div>
