<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/12
 * Time: 09:45:39
 */

namespace App\Generator\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupNociteRepository;
trait GroupNociteControllerTrait
{
    public function __construct()
    {

        $this->repositoryClass = GroupNociteRepository::class;
    }

    protected  function storeData(Request $request)
    {
        return [
        'uid'=>$request->input('uid'),
                'content'=>$request->input('content'),
                ];

     }
    protected  function updateData(Request $request)
    {
        return [
];

     }
}