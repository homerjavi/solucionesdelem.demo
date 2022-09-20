<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use Livewire\Component;

class ChatList extends Component
{
    public $chats;

    public function mount () {
        $this->chats = Chat::forAuthenticatedUser()->with( ['service', 'user'] )->get();
    }
    
    public function render()
    {
        return view('livewire.chat-list');
    }

    public function openChat( int $chatId ) {
        $this->emit( 'openChat', $chatId );
    }
}
