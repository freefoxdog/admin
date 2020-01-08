<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2020/01/08
 * Time: 21:12:24
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\MerchantCashOrderControllerTrait;
use App\Repositories\MerchantCashOrderRepository;
use App\Storage\Database\MerchantCashOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantCashOrderController extends Controller
{
    use RESTful,MerchantCashOrderControllerTrait;

//merchant_cash
    public function index(MerchantCashOrderRepository $merchantCashOrderRepository)
    {
        $data = $merchantCashOrderRepository->getIndex();
        $result = [
            'data' => $data,
        ];
        return view('merchant_cash.index', $result);
    }

    public function refuse(Request $request, MerchantCashOrderRepository $merchantCashOrderRepository)
    {
        $id = $request->id;
        $uid = Auth::id();
        $mode = $merchantCashOrderRepository->getMode($id);
        if (!$mode || $mode->status != MerchantCashOrder::WAIT){
            return back()->with([
                'error' => '订单错误！',
            ]);
        }
        $result = $merchantCashOrderRepository->refuseCash($mode, $uid);
        if (!$result){
            return back()->with([
                'error' => '处理失败！',
            ]);
        }
        return back()->with([
            'success' => '处理成功！',
        ]);
    }


    public function apply(Request $request, MerchantCashOrderRepository $merchantCashOrderRepository)
    {
        $id = $request->id;
        $uid = Auth::id();
        $mode = $merchantCashOrderRepository->getMode($id);
        if (!$mode || $mode->status != MerchantCashOrder::WAIT){
            return back()->with([
                'error' => '订单错误！',
            ]);
        }
        $acc_model = $mode->account;
        if (bccomp($acc_model->flow, $mode->num,2) < 0){
            return back()->with([
                'error' => '账户余额不足！',
            ]);
        }
       $result =  $merchantCashOrderRepository->applyCash($mode, $acc_model, $uid);
        if ($result !== true){
            return back()->with([
                'error' => $result,
            ]);
        }

        return back()->with([
            'success' => '处理成功！',
        ]);
    }



}
