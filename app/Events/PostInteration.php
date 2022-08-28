<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostInteration implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $recieverId;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($recieverId, $message)
    {
        $this->recieverId = $recieverId;
        $this->message  = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('post-interation-' . $this->recieverId);
        return new Channel('post.interation.' . $this->recieverId);
    }

    public function broadcastAs() {
        return 'newInteration';
    }

}
