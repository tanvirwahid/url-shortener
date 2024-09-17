<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UrlShortened implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shortenedUrl;
    public $id;

    public function __construct($shortenedUrl, $id)
    {
        $this->shortenedUrl = $shortenedUrl;
        $this->id = $id;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('url-shortened.'.$this->id)
        ];
    }

    public function broadcastAs()
    {
        return 'UrlShortened';
    }
}
