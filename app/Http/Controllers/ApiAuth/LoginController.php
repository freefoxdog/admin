<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/19
 * Time: 15:21
 */

namespace App\Http\Controllers\ApiAuth;


use App\Http\Controllers\Controller;

use Fruits\Apple\Auth\ApiAuthenticates;


class LoginController extends Controller
{

    use ApiAuthenticates;

}