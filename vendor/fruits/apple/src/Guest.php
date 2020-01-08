<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/19
 * Time: 11:39
 */

namespace Fruits\Apple;


use Illuminate\Notifications\Notifiable;
use Fruits\Apple\Channels\NotificationFor;

class Guest
{
    use Notifiable,NotificationFor;
    public  $mobile;
}