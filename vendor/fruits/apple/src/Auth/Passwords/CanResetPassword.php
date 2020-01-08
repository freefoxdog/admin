<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/9
 * Time: 17:45
 */

namespace Fruits\Apple\Auth\Passwords;


use Fruits\Apple\Notifications\Verification;

trait CanResetPassword
{

    public function getMobileForPasswordReset()
    {
        return $this->mobile;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
      //  $this->notify(new Verification("验证码:{$token}"));
    }
}