<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/10
* Time: 11:09:48
*/

namespace App\Repositories;
use App\Generator\Repositories\TransactionOrderRepositoryTrait;
use App\Storage\Database\TransactionOrder;
use App\Events\NoticeUser;
use App\Storage\Database\Flow;
use Illuminate\Support\Facades\DB;
use Faker\Factory;


class TransactionOrderRepository extends  Repository
{
    use TransactionOrderRepositoryTrait;


    //完成交易
    public function success(TransactionOrder $transactionOrder)
    {
        $order_data = $transactionOrder;
			 $flowOBJ = new Flow();
        try{
            DB::beginTransaction();
            $sell_ret = $flowOBJ->listSell($order_data);
            if ($sell_ret !== true){
                DB::rollBack();
                return '处理卖家账户错误！';//处理卖家账户错误
            }
            $buy_data = $flowOBJ->listBuy($order_data);
            if ($buy_data !== true){
                DB::rollBack();
                return '处理买家账户错误！';//处理买家账户错误
            }
            $reward_ret = $flowOBJ->listReward($order_data);
            if ($reward_ret !== true){
                DB::rollBack();
                return $reward_ret;
                return '处理分成奖励账户错误！';//处理分成奖励账户错误
            }
            $ret = $this->storage()->setPayCurrrency($order_data);
            if (!$ret){
                DB::rollBack();
                return '订单状态错误';
            }
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            return '运行错误！';
        }

    }

    //取消交易
    public function cancel(TransactionOrder $transactionOrder)
    {
        $order = $transactionOrder;
        $list = $order->transaction;
        $acc = $list->account;
        $obj = new TransactionOrder();
        DB::beginTransaction();
        try{
            $list->conduct = bcsub($list->conduct, $order->parents_num,2);
            $ret = $list->save();
            if (!$ret){
                DB::rollBack();
                return false;
            }
            $acc->frozen = bcsub($acc->frozen,$order->parents_num,2);
            $acc->flow = bcadd($acc->flow,$order->parents_num,2);
            $acc_ret = $acc->save();
            if (!$acc_ret){
                DB::rollBack();
                return false;
            }
            $obj->setPayCancelObj($order);
            if (!$acc_ret){
                DB::rollBack();
                return false;
            }
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            return false;
        }
    }



}