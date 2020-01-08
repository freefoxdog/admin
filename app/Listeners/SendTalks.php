<?php

namespace App\Listeners;

use App\Events\SendTalk;
use App\Repositories\UserRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use GatewayWorker\Lib\Gateway;
use Illuminate\Support\Facades\Auth;

class SendTalks
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendTalk  $event
     * @return void
     */
    public function handle(SendTalk $event)
    {
        if ($event->is_group == 1){
            $user = Auth::user();
            if(isset($user->groupchat)){
                $group_num = $user->groupchat;
            }else{
                $user = resolve(UserRepository::class)->storage()->find($event->uid);
                $group_num = $user->groupchat;
            }
            $this->sendGroup($group_num ,$event->content);
        }else{
            $this->sendGroup($event->uid ,$event->content);
        }
    }

    //发送给当前用户的群
    public function sendGroup($group,$content)
    {
        Gateway::$registerAddress = config('sys.registerAddress');
        Gateway::sendToGroup($group, json_encode($content));
    }

    //发送给个人
    public function sendUser($uid, $content)
    {
        Gateway::$registerAddress = config('sys.registerAddress');
        Gateway::sendToUid($uid, $content);
    }

}
