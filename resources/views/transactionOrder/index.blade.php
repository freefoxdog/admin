
@extends('public._blank')
@section('title','挂单列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 挂单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="text-c">
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
                <span class="l"><a href="{{route('transactions.index')}}">返回挂单列表</a></span>
                 <span class="r">共有数据：<strong> {{$data->total()}} </strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th >订单号</th>
                <th >购买用户</th>
                <th>购买数量</th>
                <th>支付数量</th>
                <th>获得数量</th>
                <th>下单时间</th>
                <th>支付方式</th>
                <th>支付时间</th>
                <th>状态</th>
                <th>付币时间</th>
                <th>过期时间</th>
                <th>申述单号</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr class="text-c">
                    <td>{{$v->order_id}}</td>
                    <td>{{$v->user->name}}</td>
                    <td>{{$v->num}}</td>
                    <td>{{$v->parents_num}}</td>
                    <td>{{$v->get_num}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->created_at)}}</td>
                    <td>{{$v->pay_list}}</td>
                    <td>{{$v->pay_money_time?date('Y-m-d H:i:s',$v->pay_money_time):'-'}}</td>
                    <td>
                        @switch($v->status)
                            @case(1)
                                待付款
                                @break
                            @case(2)
                                已付款
                                @break
                            @case(3)
                                已取消
                                @break
                            @case(4)
                                已超时
                                @break
                            @case(5)
                                未收款
                                @break
                            @case(6)
                                超时未付币
                                @break
                            @case(7)
                                成功
                                @break
                            @case(8)
                                买家申述
                                @break
                            @case(9)
                                卖家申述
                                @break

                        @endswitch
                    </td>
                    <td>{{$v->pay_currency_time?date('Y-m-d H:i:s',$v->pay_currency_time):'-'}}</td>
                    <td>{{$v->term_of_validity?date('Y-m-d H:i:s',$v->term_of_validity):'-'}}</td>
                    <td>{{$v->complaint?$v->complaint->complaint_id:'-'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pageNav" class="pageNav">
            {{$data->appends(['id' => $id])->links()}}
        </div>
    </div>

@endsection

