<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/18
 * Time: 17:46
 */

namespace Fruits\Apple\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
trait ApiAuthenticatesUsers
{
    use AuthenticatesUsers;
    public function username()
    {
        return 'mobile';
    }
    public function login(Request $request)
    {

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }



        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }

    protected function attemptLogin(Request $request)
    {

        return Auth::guard('api')->attempt(
            $this->credentials($request)
        );
    }

    protected function sendLoginResponse(Request $request)
    {

        $this->clearLoginAttempts($request);
        /*
         * s$guard = Auth::guard('api');
        $key = $guard->inputKey();
        $token = $guard->token();*/

        $user = Auth::guard('api')->user();


        return response()->apiReturn([$user], 0);


    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->apiReturn([],'','',412);
    }

    public function logout(Request $request)
    {
        $fab = resolve(FabulousRepository::class);
        $executeUserId=\Illuminate\Support\Facades\Auth::id();
        $fab->delSubscriberMachineCode($executeUserId);
        $this->guard()->logout();
        return response()->apiReturn(['success'], 0);
    }

}