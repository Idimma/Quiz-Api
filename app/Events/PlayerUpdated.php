<?php

namespace App\Events;
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Player;

class PlayerUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('leaderboard-channel');
    }

    public function broadcastWith()
    {
        return$this->player->toArray();
    }
}