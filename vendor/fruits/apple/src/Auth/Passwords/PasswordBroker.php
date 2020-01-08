<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/9
 * Time: 17:28
 */

namespace Fruits\Apple\Auth\Passwords;

use Illuminate\Auth\Passwords\PasswordBroker as LaravelPasswordBroker;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Fruits\Apple\Verification\Mobile;
use Closure;
class PasswordBroker extends  LaravelPasswordBroker
{

    public function sendResetLink(array $credentials)
    {
        $user = $this->getUser($credentials);

        if (is_null($user)) {
            return static::RESET_LINK_SENT;
        }


        $verification = new Mobile($user->mobile,Mobile::TYPE_RESET);
        $verification->generate();
        $verification->send();
        // Once we have the reset token, we are ready to send the message out to this
        // user with a link to reset their password. We will then redirect back to
        // the current URI having nothing set in the session to indicate errors.

       /* $user->sendPasswordResetNotification(
            $this->tokens->create($user)
        );*/

        return static::RESET_LINK_SENT;
    }
    public function reset(array $credentials, Closure $callback)
    {
        // If the responses from the validate method is not a user instance, we will
        // assume that it is a redirect and simply return it from this method and
        // the user is properly redirected having an error message on the post.
        $user = $this->validateReset($credentials);


        if (! $user instanceof CanResetPasswordContract) {
            return $user;
        }
        $verification = new Mobile($user->mobile,Mobile::TYPE_RESET);
        if(! $verification->check($credentials['token']))
        {
            return static::INVALID_TOKEN;
        }

        $password = $credentials['password'];
        // Once the reset has been validated, we'll call the given callback with the
        // new password. This gives the user an opportunity to store the password
        // in their persistent storage. Then we'll delete the token and return.
        $callback($user, $password);
        $verification->clean();
        return static::PASSWORD_RESET;
    }
    protected function validateReset(array $credentials)
    {
        if (is_null($user = $this->getUser($credentials))) {

            return static::INVALID_USER;
        }

        if (! $this->validateNewPassword($credentials)) {
            return static::INVALID_PASSWORD;
        }



        return $user;
    }

}