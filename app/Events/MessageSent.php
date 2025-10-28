<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    // public $roomId;

    public function __construct(ChatMessage $message)
    {
        $this->message = $message->load('user');
        // $this->roomId = $message->chat_room_id;
    }

    public function broadcastOn()
    {
        // return new PrivateChannel('chat-room.'.$this->roomId);

        return new Channel('chat-room.'.$this->message->chat_room_id);
    }

    // public function broadcastWith()
    // {
    //     return [
    //         'message_id' => $this->message->id,
    //         'room_id' => $this->roomId,
    //         'text' => $this->message->text,
    //         'user_id' => $this->message->user_id,
    //         'created_at' => $this->message->created_at->toDateTimeString(),
    //     ];
    // }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}
