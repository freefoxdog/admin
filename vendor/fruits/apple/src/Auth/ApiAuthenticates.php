<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/20
 * Time: 14:04
 */

namespace Fruits\Apple\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

trait ApiAuthenticates
{
    use AuthenticatesUsers;
    protected $guard = 'api';

    public function username()
    {
        return 'mobile';
    }


    public function login(Request $request)
    {

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }

    protected function attemptLogin(Request $request)
    {

        return Auth::guard($this->guard)->attempt(
            $this->credentials($request)
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);
        $user = Auth::guard($this->guard)->user();
        $data = $user->toArray();
        $data['api_token'] = $user->apiToken;
        return response()->apiReturn($data, 0);

    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $num = $this->limiter()->attempts($this->throttleKey($request));
        $max = $this->maxAttempts();
        $residue = $max - $num;

        return response()->apiReturn([__('users.loginFail', ['residue' => $residue])], 0, '', 412);
    }

    public function logout(Request $request)
    {
        Auth::guard($this->guard)->logout();
        return response()->apiReturn(['success'], 0);
    }

}