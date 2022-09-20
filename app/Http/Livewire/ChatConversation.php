<?php

namespace App\Http\Livewire;

use App\Events\UpdateChat;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ChatConversation extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    public $chat;
    public $newMessage;
    public $content;
    public $type;
    public $file;
    public $originalFileName;

    protected $listeners = [ 'openChat', 'render' ];

    public function render()
    {
        return view('livewire.chat-conversation', [ 
            'messages' => $this->chat->messages()->with( 'user' )
                                     ->orderBy( 'created_at', 'DESC' )
                                     ->paginate( 5 ) 
            ] );
    }

    public function mount( Chat $chat )
    {
        $this->chat = $chat;
        $this->type = 'text';
    }

    public function openChat( Chat $chat ) {
        $this->chat = $chat;
    }

    public function sendNewMessage() {
        $validateRules = $this->getValidationRules();
        $this->validate( $validateRules );

        try {
            Message::create( [
                'chat_id'   => $this->chat->id,
                'user_id'   => auth()->user()->id,
                'content'   => $this->content ?? $this->newMessage,
                'type'      => $this->type,
                'file_name' => $this->originalFileName,
            ] );   

            event( new UpdateChat( $this->chat->id ) );
            
            $this->resetData();

            session()->flash('message', 'Mensaje nviado!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function uploadFile( string $folder = 'filesUpload' )
    {
        $this->originalFileName = $this->file->getClientOriginalName();
        $fileName               = time() . '-' . $this->originalFileName;

        $this->file->storeAs('public/' . $folder, $fileName );

        $this->content = 'storage/' . $folder . '/' . $fileName;
        $this->type    = $this->file->getMimeType();

        $this->sendNewMessage();

        session()->flash('message', 'Imagen subida 🤴');
    }

    public function getValidationRules() :Array
    { 
        $type  = isImage( $this->type ) ? 'image' : $this->type; 
        $rules = [];
        
        switch ( $type ) {
            case 'text':
                $rules[ 'newMessage' ] = [ 'required', 'max:500' ];
                break;
            
            case 'image':
                $rules[ 'file' ] = [ 'required', 'image', 'max:5120' ];
                break;
            
            default:
                $rules[ 'file' ] = [ 'required', 'max:5120' ];
                break;
        }

        return $rules;
    }

    public function resetData() {
        $this->newMessage       = '';
        $this->content          = '';
        $this->file             = null;
        $this->originalFileName = '';
    }
}
