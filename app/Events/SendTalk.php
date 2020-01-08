<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendTalk
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content = array();//内容
    public $uid = '';//用户对象
    public $is_group = 1;//是否是群
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $content, $is_group = 1, $uid = null)
    {
        $this->uid = $uid;
        $this->content = $content;
        $this->is_group = $is_group;
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
