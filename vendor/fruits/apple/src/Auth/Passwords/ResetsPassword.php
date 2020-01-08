<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/12
 * Time: 20:37
 */

namespace Fruits\Apple\Auth\Passwords;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
trait ResetsPassword
{
    use ThrottleResets;
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }
    protected function sendResetResponse($request, $response)
    {
        return response()->apiReturn([__($response)],'密码重置成功','',200);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        if($response == Password::INVALID_TOKEN) {
            if($this->hasTooManyResetAttempts($request))
            {

                return response()->apiReturn([__('passwords.throttle',['second'=>1])], 419, '密码重置次数失败', 419);
            }
            else{

                $this->incrementResetAttempts($request);

                $residue = $this->residue($request);
                return response()->apiReturn([__($response,['residue'=>$residue])], 419, '密码重置失败', 419);
            }


        }

        return response()->apiReturn([__($response)],413,'密码重置失败',413);
    }
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

       // $this->guard()->login($user);
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'mobile', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'mobile' => 'required',
            'password' => 'required|confirmed|min:6',
        ];
    }

}