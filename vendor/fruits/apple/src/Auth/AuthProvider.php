<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/13
 * Time: 10:59
 */

namespace Fruits\Apple\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::extend('token', function($app, $name, array $config){

            $guard = new TokenGuard(Auth::createUserProvider($config['provider']),  $app['request']);
            $app->refresh('request', $guard, 'setRequest');
            return $guard;
        });
    }
}