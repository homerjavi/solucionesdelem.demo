<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateChat implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $chatId;

  public function __construct( $chatId )
  {
      $this->chatId = $chatId;
  }

  public function broadcastOn()
  {
      return 'chat-channel';
  }

  public function broadcastAs()
  {
      return 'chat-event';
  }
}