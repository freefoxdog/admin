<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/8
 * Time: 18:26
 */

namespace Fruits\Apple;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;
use Fruits\Apple\Channels\Sms;
use Fruits\Apple\Api\Sms as SmsClient;

use Fruits\Apple\Channels\UmengMsg;

class NotificationProvider extends ServiceProvider
{
    /**
     * Boot the application services.
     *
     * @return void
     */
    public function boot()
    {

    }
    public function register()
    {


        $this->app->make(ChannelManager::class)->extend('fruitsms',function($app){

            $account = config('services.sms.account');
            $password = config('services.sms.password');
 
            return new Sms(new SmsClient($account, $password));

        });

        $this->app->make(ChannelManager::class)->extend('umengMsg',function($app){

            $appkey = config('services.umeng.appkey');
            $appMasterSecret = config('services.umeng.secret');

            return new UmengMsg(new \Fruits\Apple\Api\Umeng($appkey,$appMasterSecret));

        });
    }
}