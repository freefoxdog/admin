<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/12
 * Time: 09:45:39
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\GroupNociteControllerTrait;
use Illuminate\Http\Request;

class GroupNociteController extends Controller
{
    use RESTful,GroupNociteControllerTrait;

    public function index(Request $request)
    {
       $data = resolve($this->repositoryClass)->storage()->index();
       $result = array(
           'data' => $data,
       );
        return view('groupNocite.index',$result);
    }


}
