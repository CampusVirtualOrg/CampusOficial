<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;




class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	public $message;
	public $userNotification;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message, int $userNotification)
    {
        $this->message = $message;
		$this->userNotification = $userNotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel(name: 'user.' . $this->userNotification),
        ];
    }

	public function broadcastAs()
	{
		return 'Sendmessage';
	}

	public function broadcastWith()
	{
		return [
			'message' => $this->message,
		];
	}
}

