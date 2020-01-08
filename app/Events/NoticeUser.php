<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NoticeUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $uid = '';
    public $type = '';
    public  $content = '';


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $content,string $type,int $uid )
    {
        $this->uid = $uid;
        switch ($type){
            case 'SYS':
                $this->type = 1;
                break;
            case 'ORDER':
                $this->type = 2;
                break;

            case 'COMPLAINT'://申诉
                $this->type = 3;
                break;
            case 'SEND'://申诉
                $this->type = 4;//发货提醒
                break;
        }
        $this->content = $content;
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
