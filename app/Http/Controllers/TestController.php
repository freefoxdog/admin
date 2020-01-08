<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/19
 * Time: 17:17
 */

namespace App\Http\Controllers;


use Fruits\Apple\Verification\Mobile;


class TestController extends  Controller
{

    public function verification(){

      $mobile = new Mobile("181123456");
      $mobile->generate();
      $mobile->send();
      return response()->apiReturn([3], 0);
    }
    public function test()
    {

        return response()->apiReturn(['haja'], 0);
    }
}