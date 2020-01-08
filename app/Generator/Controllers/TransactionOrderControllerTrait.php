<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 11:09:48
 */

namespace App\Generator\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionOrderRepository;
trait TransactionOrderControllerTrait
{
    public function __construct()
    {

        $this->repositoryClass = TransactionOrderRepository::class;
    }

    protected  function storeData(Request $request)
    {
        return [
        'orderId'=>$request->input('orderId'),
                'uid'=>$request->input('uid'),
                'transactionsID'=>$request->input('transactionsID'),
                'num'=>$request->input('num'),
                'payType'=>$request->input('payType'),
                'payList'=>$request->input('payList'),
                'payNum'=>$request->input('payNum'),
                'status'=>$request->input('status'),
                ];

     }
    protected  function updateData(Request $request)
    {
        return [
                    'num'=>$request->input('num'),
                            'payType'=>$request->input('payType'),
                            'payList'=>$request->input('payList'),
                            'payNum'=>$request->input('payNum'),
                            'status'=>$request->input('status'),
        ];

     }
}