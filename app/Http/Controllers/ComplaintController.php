<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 15:03:29
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\ComplaintControllerTrait;
use App\Repositories\FlowRepository;
use App\Repositories\TransactionOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    use RESTful,ComplaintControllerTrait;

    public function index(Request $request)
    {
        $search = '';
        if($request->search && is_string($request->search)){
            $search = $request->search;
        }
        $data = resolve($this->repositoryClass)->storage()->index($search);
        $result = array(
            'data' => $data,
            'search' => $search,
        );

        return view('complaint.index',$result);
    }
    public function show(Request $request)
    {
        if (!$request->id || !is_numeric($request->id)){
                abort(404);
        }
        $order = $request->id;
        $data = resolve($this->repositoryClass)->storage()->where('complaint_id',$order)->first();
        $result = array(
            'data' => $data,
        );
        return view('complaint.show',$result);
    }

    public function update(Request $request, $id)
    {
        $obj = '';
        $validator = Validator::make([
            'complaint_id' => $id,
            'content' => $request->input('content'),
        ],[
            'complaint_id' => [
                function($attribute, $value, $fail) use (&$obj){
                    $validate = resolve($this->repositoryClass)->storage()->where('complaint_id', $value)->first();
                    if (!$validate){
                        $fail('投诉不存在');
                    } elseif ($validate->is_hand == 1){
                        $fail('投诉已处理，不能重复处理');
                    }
                    $obj = $validate;
                }
            ],
            'content' => 'required|string'
        ],[
            'content.required' => '请填写回复内容！',
            'content.string' => '回复必须为字符串',
        ])->validate();
        $uid = Auth::id();
        $updata_data = array(
            'is_hand' => 1,
            'hand_content' => $request->input('content'),
            'hand_at' => time(),
            'hand_uid' => $uid,
        );
        $ret = $obj->update($updata_data);
        if (!$ret){
            return back()->with(['result'=>'处理失败']);

        }
        return back();


    }


    public function hand(Request $request, TransactionOrderRepository $transactionOrderRepository)
    {
        $order = '';
        $validate = Validator::make($request->all(),[
            'type' => 'required|in:1,2',//1完成交易  2取消交易
            'complaint_id' => [
                'required',
                function($attribute, $value, $fail) use (&$order){
                    $order = resolve($this->repositoryClass)->storage()->where('complaint_id' , $value)->first();
                    if (!$order){
                        return $fail('订单错误');
                    }elseif ($order->is_hand == 1){
                        return $fail('申诉已处理');
                    }
                }],
        ],[
            'type.required' => '请选择操作类型！',
            'type.in' => '类型错误!',
            'complaint_id.required' => '请填写编号！',
        ])->validate();
        if ($order->type == 1){
           // return back()->with('orer_error','挂单类型暂无法处理');
            $transaction = $order->transactionOrder;
            if ($request->input('type') == 1){//完成交易
                $ret = $transactionOrderRepository->success($transaction);
            }else{
                $ret = $transactionOrderRepository->cancel($transaction);
            }
            if ($ret === true){
                return back()->with('ret','成功');
            }
            if ($ret === false){
                $ret = '挂单投诉处理失败！';
            }
            return back()->with('orer_error', $ret);

        }else{
            $tsak = $order->task;
            if ($request->input('type') == 1){//完成交易
                $ret = resolve(FlowRepository::class)->storage()->setRedPacketSuccess($tsak);
            }else{
                $ret = resolve(FlowRepository::class)->storage()->redPacketNoPayMoney($tsak);
            }
            if ($ret){
                $update = array(
                    'hand_order' => 1,
                );
                $order->update($update);
            }else{
                return back()->with('orer_error','处理失败！');
            }
            return back()->with('ret','成功');
        }
    }


}
