<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/12/24
 * Time: 17:10
 */

namespace Fruits\Apple\Channels;

use Illuminate\Notifications\Notification;
use Fruits\Apple\Api\Umeng;

class UmengMsg
{
    /**
     * @var Umeng
     */
    protected $api = '';
    public function __construct(Umeng $api)
    {
        $this->api = $api;
    }
    /**
     * 发送给定通知.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {


        if (! $to = $notifiable->routeNotificationFor('deviceMsg', $notification)) {

            return;
        }


        $type = $to[0];
        $deviceTokens = $to[1];
        $message = $notification->toUmeng($notifiable);
        if(!$message)
            return;

        $ret =  $this->api->send($type, $deviceTokens ,$message);


        return $ret;

    }
}