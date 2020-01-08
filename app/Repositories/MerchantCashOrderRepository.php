<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2020/01/08
* Time: 21:12:24
*/

namespace App\Repositories;
use App\Generator\Repositories\MerchantCashOrderRepositoryTrait;
use App\Storage\Database\Account;
use App\Storage\Database\Flow;
use App\Storage\Database\MerchantCashOrder;
use Illuminate\Support\Facades\DB;

class MerchantCashOrderRepository extends  Repository
{
    use MerchantCashOrderRepositoryTrait;

    //获取提现列表
    public function getIndex()
    {
        $data = MerchantCashOrder::getList();
        return $data;
    }

    /**
     *
     * 获取指定id申请模型
     * */
    public function getMode($id)
    {
        return MerchantCashOrder::find($id);
    }


    /**
     *
     * 拒绝提现申请
     *
     * @param  $order MerchantCashOrder 模型
     * @param $uid int 处理id
     * */
    public function refuseCash(MerchantCashOrder $order, $uid)
    {
        $time = time();
        return MerchantCashOrder::orderRefuce($order, $uid, $time);
    }

    /**
     *
     * 同意提现
     *
     * @param  $order MerchantCashOrder 订单模型
     * @param $acc_model Account 账户模型
     * @param  $uid int 用户ID
     * @return  bool
     * */
    public function applyCash(MerchantCashOrder $order,$acc_model, $uid)
    {
        $time = time();
        DB::beginTransaction();
        try{
            $before = $acc_model->flow;
            $ret_sub = Account::sub($acc_model, $order->num);
            if (!$ret_sub){
                DB::rollBack();
                return '账户余额减少失败！';
            }
            $after = $acc_model->flow;
            //add($uid,$type, $order, $num, $before, $after, $symbol)
            $ret_write = resolve(Flow::class)->add(
                $order->uid,
                Flow::TASK_CASH,
                $order->order,
                $order->num,
                $before,
                $after,
                Flow::SYMBOL_SUB
            );
            if (!$ret_write){
                DB::rollBack();
                return '流水写入失败！';
            }
            $oredr_status = MerchantCashOrder::orderApply($order, $uid, $time);
            if (!$oredr_status){
                DB::rollBack();
                return '订单状态修改失败！';
            }
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }





    }


}