<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/12
 * Time: 14:39
 */

namespace Fruits\Apple\Auth\Passwords;
use Illuminate\Support\ServiceProvider;

class PasswordResetProvider extends ServiceProvider
{

    public function boot()
    {

    }
    public function register()
    {
        $this->app->singleton('apple.password.broker', function ($app) {
            $config = config("auth.passwords.users");
            return new PasswordBroker(
                new DatabaseToken(  $config ),

                $app->make('auth')->createUserProvider($config['provider'] ?? null)
            );
        });
    }
}