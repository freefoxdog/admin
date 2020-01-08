<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/09
 * Time: 15:37:13
 */

namespace App\Generator\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
trait UserControllerTrait
{
    public function __construct()
    {

        $this->repositoryClass = UserRepository::class;
    }

    protected  function storeData(Request $request)
    {
        return [
        'name'=>$request->input('name'),
                'mobile'=>$request->input('mobile'),
                'password'=>$request->input('password'),
                'pic'=>$request->input('pic'),
                'identity'=>$request->input('identity'),
                'grade'=>$request->input('grade'),
                'fraction'=>$request->input('fraction'),
                'rememberToken'=>$request->input('rememberToken'),
                ];

     }
    protected  function updateData(Request $request)
    {
        return [
                    'password'=>$request->input('password'),
        ];

     }
}