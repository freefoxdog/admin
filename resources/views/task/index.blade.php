
@extends('public._blank')
@section('title','挂单列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 任务管理 <span class="c-gray en">&gt;</span> 任务列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="text-c">
            <form action="{{route('tasks.index')}}" method="GET">
          <input type="text" class="input-text" style="width:250px" placeholder="输入订单号、用户ID" id="" value="{{$search}}" name="search"><button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜用户</button>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
                 <span class="r">共有数据：<strong> {{$data->total()}} </strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th >订单号</th>
                <th>商户</th>
                <th>发送时间</th>
                <th>支持方式</th>
                <th>数量</th>
                <th>重发次数</th>
                <th>有效期</th>
                <th>接单人</th>
                <th>接单时间</th>
                <th>商户支付时间</th>
                <th>支付时间</th>
                <th>取消时间</th>
                <th>取消奖励</th>
                <th>投诉编号</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr class="text-c">
                    <td>{{$v->order}}</td>
                    <td>{{$v->sendUser->name}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->created_at)}}</td>
                    <td>{{$v->use_pay}}</td>
                    <td>{{$v->num}}</td>
                    <td>{{$v->repeat_num}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->efffet_at)}}</td>
                    <td>{{$v->user?$v->user->name:'-'}}</td>
                    <td>{{$v->task_at?date('Y-m-d H:i:s',$v->task_at):'-'}}</td>
                    <td>{{$v->get_money_at?date('Y-m-d H:i:s',$v->get_money_at):'-'}}</td>
                    <td>{{$v->get_currency_at?date('Y-m-d H:i:s',$v->get_currency_at):'-'}}</td>
                    <td>{{$v->cancel_at?date('Y-m-d H:i:s',$v->cancel_at):'-'}}</td>
                    <td>{{$v->cancel_reward}}</td>
                    <td>{{$v->complaints_id?$v->complaints_id:'-'}}</td>
                    <td>@switch($v->status)
                            @case(1)
                                未接单
                                @break
                            @case(2)
                                待付款
                                @break
                            @case(3)
                                过期
                                @break
                            @case(4)
                                已付款
                                @break
                            @case(5)
                                已完成
                                @break
                            @case(6)
                                付款异常
                                @break
                            @case(7)
                                付币异常
                                @break
                            @case(8)
                                超时取消
                                @break
                            @case(9)
                                主动取消
                                @break
                        @endswitch
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pageNav" class="pageNav">
            {{$data->appends(['search'=>$search])->links()}}
        </div>
    </div>



@endsection

