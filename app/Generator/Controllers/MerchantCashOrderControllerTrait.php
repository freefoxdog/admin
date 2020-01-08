<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2020/01/08
 * Time: 21:12:24
 */

namespace App\Generator\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MerchantCashOrderRepository;
trait MerchantCashOrderControllerTrait
{
    public function __construct()
    {

        $this->repositoryClass = MerchantCashOrderRepository::class;
    }

    protected  function storeData(Request $request)
    {
        return [
        'uid'=>$request->input('uid'),
                'order'=>$request->input('order'),
                'type'=>$request->input('type'),
                'status'=>$request->input('status'),
                'num'=>$request->input('num'),
                'admin_uid'=>$request->input('admin_uid'),
                ];

     }
    protected  function updateData(Request $request)
    {
        return [
];

     }
}