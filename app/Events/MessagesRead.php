<?php

namespace App\Events;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagesRead implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $roomId;
    public $userId;

    public function __construct($roomId, $userId)
    {
        $this->roomId = $roomId;
        $this->userId = $userId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat-room.' . $this->roomId);
    }

    public function broadcastWith()
    {
        return [
            'room_id' => $this->roomId,
            'user_id' => $this->userId
        ];
    }
}
