<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/13
 * Time: 11:01
 */

namespace Fruits\Apple\Auth;



use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Redis;

class TokenGuard extends \Illuminate\Auth\TokenGuard
{

    protected  $delimiter = '_';
    public function attempt(array $credentials = [])
    {



        $user = $this->provider->retrieveByCredentials($credentials);

        // If an implementation of UserInterface was returned, we'll ask the provider
        // to validate the user against the given credentials, and if they are in
        // fact valid we'll log the users into the application and return true.
        if ($this->hasValidCredentials($user, $credentials)) {
            $this->login($user);

            return true;
        }

        // If the authentication attempt fails we will fire an event so that the user
        // may be notified of any suspicious attempts to access their account from
        // an unrecognized user. A developer may listen to this event as needed.
        //$this->fireFailedEvent($user, $credentials);

        return false;
    }

    public  function login(AuthenticatableContract $user)
    {

        $this->freshApiToken($user);
        $this->setUser($user);
    }
    public function logout()
    {
        $user = $this->user();
        if (!$user) {
            $this->loggedOut = true;
            return true;
        }


        $this->cleanApiToken($user);



        $this->user = null;

        $this->loggedOut = true;
    }
    public function user()
    {
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (! is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $token = $this->getTokenForRequest();
        $userId =$this->request->header('tuid');


        if (! empty($token) && ! empty($userId)) {
            if( !($cacheVal = Redis::get($this->cacheKey($userId))))
                return null;

            $cacheVal = explode($this->delimiter,$cacheVal);
            if($cacheVal[0] != $token)
                return null;

            if($cacheVal[1] != $this->request->ip())
                return null;

            $user = $this->provider->retrieveById($userId);
        }

        return $this->user = $user;
    }
    protected function cacheKey($userId)
    {

        return "user:{$userId}:logintoken";
    }
    protected function cleanApiToken(AuthenticatableContract $user)
    {
        Redis::del($this->cacheKey($user->id));
    }
    protected function freshApiToken(AuthenticatableContract $user)
    {


        $token =  str_random(64);
        $ip = $this->request->ip();
        $user->apiToken = $token;


        Redis::set($this->cacheKey($user->id),"{$token}{$this->delimiter}{$ip}", 'ex', config('app.loginTTL'));

    }
    /**
     * Determine if the user matches the credentials.
     *
     * @param  mixed  $user
     * @param  array  $credentials
     * @return bool
     */
    protected function hasValidCredentials($user, $credentials)
    {
        return ! is_null($user) && $this->provider->validateCredentials($user, $credentials);
    }
    public function inputKey()
    {
        return $this->inputKey;
    }
    public function token()
    {
        return $this->user()->{$this->storageKey};
    }
}