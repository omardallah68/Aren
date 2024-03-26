<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class PrivateMessage implements ShouldBroadcast
{
    public $sender;
    public $receiverId;
    public $message;

    public function __construct(User $sender, $receiverId, $message)
    {
        $this->sender = $sender;
        $this->receiverId = $receiverId;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel("private-chat.{$this->receiverId}");
    }
}

