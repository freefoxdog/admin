
@extends('public._blank')
@section('title','提现申请列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 任务管理 <span class="c-gray en">&gt;</span> 提现申请列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                @if(session('error'))
                    <span style="color: red;">{{session('error')}}</span>
                    @endif
                    @if(session('success'))
                        <span style="color: green;">   {{session('success')}}</span>
                    @endif

            </span>
            <span class="r">共有数据：<strong> {{$data->total()}} </strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th>商户名</th>
                <th>申请金额</th>
                <th>账户余额</th>
                <th>申请时间</th>
                <th>申请状态</th>
                <th>处理人</th>
                <th>处理时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr class="text-c">
                    <td>{{$v->user->name}}</td>
                    <td>{{$v->num}}</td>
                    <td>{{$v->account->flow}}</td>
                    <td>{{date('Y-m-d H:i:s', $v->created_at)}}</td>
                    <td>
                        @switch($v->status)
                            @case(\App\Storage\Database\MerchantCashOrder::WAIT)
                            申请中
                            @break
                            @case(\App\Storage\Database\MerchantCashOrder::APPLY)
                            已处理
                            @break
                            @case(\App\Storage\Database\MerchantCashOrder::REFUSE)
                            已拒绝
                            @break
                        @endswitch

                    </td>
                    <td>{{$v->admin_uid?$v->hand_user->name:''}}</td>
                    <td>{{$v->hand_at?date('Y-m-d H:i:s', $v->hand_at):''}}</td>
                    <td>
                        @if($v->status == \App\Storage\Database\MerchantCashOrder::WAIT)
                            <a href="javascript:if(confirm('确定已处理此申请吗？')){window.location.href='{{route('task.cash.apply')}}?id={{$v->id}}'}"><button>通过</button></a>
                        &emsp;&emsp;
                            <a href="javascript:if(confirm('确定拒绝此申请吗？'))window.location.href='{{route('task.cash.refuse')}}?id={{$v->id}}'"><button>驳回</button></a>

                        @endif

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="pageNav" class="pageNav">
            {{$data->links()}}
        </div>
    </div>



@endsection

