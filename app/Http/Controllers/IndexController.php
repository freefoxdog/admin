<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/19
 * Time: 17:17
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends  Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('index');
    }

    public function welcome()
    {
        return view('welcome');
    }


}