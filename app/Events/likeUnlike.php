<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class likeUnlike implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $voters;
    public $voters_count;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($voters, $voters_count)
    {
        $this->voters = $voters;
        $this->voters_count = $voters_count;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('like-unlike');
    }
}
