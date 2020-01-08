<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 11:09:36
 */

namespace App\Generator\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;
trait TransactionControllerTrait
{
    public function __construct()
    {

        $this->repositoryClass = TransactionRepository::class;
    }

    protected  function storeData(Request $request)
    {
        return [
        'orderId'=>$request->input('orderId'),
                'uid'=>$request->input('uid'),
                'total'=>$request->input('total'),
                'surplus'=>$request->input('surplus'),
                'min'=>$request->input('min'),
                'max'=>$request->input('max'),
                'price'=>$request->input('price'),
                'remarks'=>$request->input('remarks'),
                'payType'=>$request->input('payType'),
                'payList'=>$request->input('payList'),
                'status'=>$request->input('status'),
                ];

     }
    protected  function updateData(Request $request)
    {
        return [
                    'total'=>$request->input('total'),
                            'surplus'=>$request->input('surplus'),
                            'min'=>$request->input('min'),
                            'max'=>$request->input('max'),
                            'price'=>$request->input('price'),
                            'payType'=>$request->input('payType'),
                            'payList'=>$request->input('payList'),
                            'status'=>$request->input('status'),
        ];

     }
}