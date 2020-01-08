<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/09
 * Time: 16:20:52
 */

namespace App\Generator\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserInfoRepository;
trait UserInfoControllerTrait
{
    public function __construct()
    {

        $this->repositoryClass = UserInfoRepository::class;
    }

    protected  function storeData(Request $request)
    {
        return [
        'uid'=>$request->input('uid'),
                'type'=>$request->input('type'),
                'name'=>$request->input('name'),
                'card'=>$request->input('card'),
                'mobile'=>$request->input('mobile'),
                'jyPassword'=>$request->input('jyPassword'),
                ];

     }
    protected  function updateData(Request $request)
    {
        return [
];

     }
}