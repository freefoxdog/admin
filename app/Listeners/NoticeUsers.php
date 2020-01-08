<?php

namespace App\Listeners;

use App\Events\NoticeUser;
use App\Events\SendTalk;
use App\Repositories\NoticeDataRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoticeUsers
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  NoticeUser  $event
     * @return void
     */
    public function handle(NoticeUser $event)
    {
        $data = array(
            'uid' => $event->uid,
            'type' => $event->type,
            'content' => $event->content['content']
        );
        $result = resolve(NoticeDataRepository::class)->store($data);
        if ($result){//新增成功，通知用户
                $content = array(
                    'type'=>'user_nocite_1',
                    'content' => $event->content,//通知内容
                    'time' =>time(),//通知时间
                );
            event(new SendTalk($content,0,$event->uid));//通知用户
        }
    }

}
