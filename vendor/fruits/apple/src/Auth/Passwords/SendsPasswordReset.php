<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/12
 * Time: 19:14
 */

namespace Fruits\Apple\Auth\Passwords;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

trait SendsPasswordReset
{
    public function sendResetCode(Request $request)
    {



        $this->validate($request, ['mobile' => 'required']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('mobile')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }
    protected function broker()
    {
        return app('apple.password.broker');

    }


    protected function sendResetLinkResponse(Request $request,$response)
    {
        return response()->apiReturn([],__($response),'',200);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->apiReturn([],'passwords.sent','',415);
    }
}