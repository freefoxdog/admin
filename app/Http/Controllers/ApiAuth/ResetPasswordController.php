<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/18
 * Time: 20:02
 */

namespace App\Http\Controllers\ApiAuth;


use App\Http\Controllers\Controller;
use Fruits\Apple\Auth\Passwords\ResetsPassword;
use Fruits\Apple\Auth\Passwords\SendsPasswordReset;

class ResetPasswordController extends  Controller
{

    use SendsPasswordReset,ResetsPassword;
    public function username()
    {
        return 'mobile';
    }

}