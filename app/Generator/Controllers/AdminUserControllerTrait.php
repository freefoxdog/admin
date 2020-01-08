<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/11
 * Time: 14:06:28
 */

namespace App\Generator\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AdminUserRepository;
trait AdminUserControllerTrait
{
    public function __construct()
    {

        $this->repositoryClass = AdminUserRepository::class;
    }

    protected  function storeData(Request $request)
    {
        return [
        'name'=>$request->input('name'),
                'password'=>$request->input('password'),
                'pic'=>$request->input('pic'),
                'idType'=>$request->input('idType'),
                ];

     }
    protected  function updateData(Request $request)
    {
        return [
                    'password'=>$request->input('password'),
                            'idType'=>$request->input('idType'),
        ];

     }
}