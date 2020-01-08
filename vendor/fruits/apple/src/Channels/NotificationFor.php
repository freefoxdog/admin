<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/14
 * Time: 13:51
 */

namespace Fruits\Apple\Channels;




trait NotificationFor
{
    public function routeNotificationForSms()
    {


        return $this->mobile;
    }
    public function routeNotificationForDeviceMsg()
    {

        return $this->deviceId;

    }
}