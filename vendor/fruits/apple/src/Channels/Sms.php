<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/8
 * Time: 17:46
 */

namespace Fruits\Apple\Channels;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Fruits\Apple\Api\Sms as SmsClient;
class Sms
{

    /**
     * @var \Fruits\Apple\Api\Sms
     */
    protected $smsApi;

    public function __construct(SmsClient $smsApi)
    {
        $this->smsApi = $smsApi;
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


        if (! $to = $notifiable->routeNotificationFor('sms', $notification)) {
            return;
        }


        $message = $notification->toAppleSms($notifiable);

        if (App::environment('local'))
        {
           //local环境不发送短信，只记录日志
            Log::stack(['single', 'stderr'])->info($message);
            $ret = true;
        }
        else{
            $ret =  $this->smsApi->send($to ,$message);
        }




        return $ret;

    }
}