<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GeneralSmsEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $receivers;

    public $message;

    public $callback;

    public $about;

    public $obj;

    public function __construct(
        $receivers,
        callable $callback,
        $message,
        $obj,
        $about = ''
        )
    {
        $this->receivers = $receivers;
        $this->message = $message;
        $this->callback = $callback;
        $this->about = $about;
        $this->obj = $obj;
    }


/**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
