<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/09
 * Time: 15:37:13
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\UserControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use RESTful,UserControllerTrait;

    public function index(Request $request)
    {
        $w = array(
            array(),
            array(),
            array(),
        );
        if ($request->search && is_string($request->search)){
            $w = array(
                array(
                    array('name', 'like', '%'.$request->search.'%'),
                ),
                array(
                    array('mobile', 'like', '%'.$request->search.'%'),
                ),
                array(
                    'id' => $request->search
                ),
            );
        }
        $data = resolve($this->repositoryClass)->storage()->index($w);
        $result = array(
            'data' => $data,
            'search' => $request->search?$request->search:''
        );
        return view('user/index',$result);
    }


}
