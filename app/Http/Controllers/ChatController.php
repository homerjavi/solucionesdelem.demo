<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use Illuminate\Contracts\View\View;

class ChatController extends Controller
{
    
    public function index() :View
    {
        $chats         = Chat::forAuthenticatedUser()->with( [ 'service', 'user', 'messages' ] )->get();
        $chatsResource = ChatResource::collection( $chats )->resolve();

        return view( 'chats.index', [
            'chats' => $chatsResource,
        ] );
    }

    public function chat( ChatRequest $chatRequest ) :View
    {
        $chat = Chat::firstOrCreate( [
            'user_id'    => auth()->user()->id,
            'service_id' => $chatRequest->service_id
        ] );
            
        return view( 'chats.chat', compact( 'chat' ) );
    }

}