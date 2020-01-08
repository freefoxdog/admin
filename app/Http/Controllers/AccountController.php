<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/09
 * Time: 16:23:01
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\AccountControllerTrait;

class AccountController extends Controller
{
    use RESTful,AccountControllerTrait;

    public function create()
    {
        return view('account.create');
    }


}
