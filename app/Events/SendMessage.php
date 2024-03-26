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

class SendMessage implements ShouldBroadcast
{
    public $user;
    public $content;
    public function __construct(User $user, $content)
    {
        $this->user = $user;
        $this->content = $content;
    }

    public function broadcastOn()
    {
        return new Channel('chat');
    }
}

