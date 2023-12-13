<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class NewMessage implements ShouldBroadcast

{

	public $message;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Message $message)
    {
		$this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('messages'),
        ];
    }
}


