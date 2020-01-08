
@extends('public._blank')
@section('title','挂单列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 挂单管理 <span class="c-gray en">&gt;</span> 挂单列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="text-c">
            <form action="{{route('transactions.index')}}" method="GET">
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
                <th >挂单用户</th>
                <th>挂单时间</th>
                <th>支持方式</th>
                <th>挂单总数</th>
                <th>最小数量</th>
                <th>最大数量</th>
                <th>剩余数量</th>
                <th>冻结数量</th>
                <th>状态</th>
                <th>备注</th>
                <th>过期时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr class="text-c">
                    <td>{{$v->order_id}}</td>
                    <td>{{$v->user->name}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->created_at)}}</td>
                    <td>{{$v->pay_list}}</td>
                    <td>{{$v->total}}</td>
                    <td>{{$v->min}}</td>
                    <td>{{$v->max}}</td>
                    <td>{{$v->surplus}}</td>
                    <td>{{$v->conduct}}</td>
                    <td>
                        @switch($v->status)
                            @case(1)
                              正常
                            @break
                            @default
                                过期
                        @endswitch

                    </td>
                    <td>{{$v->remarks}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->term_of_validity)}}</td>
                    <td><a href="{{route('transactionOrders.index')}}?id={{$v->order_id}}">详情</a></td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pageNav" class="pageNav">
            {{$data->appends(['search'=>$search])->links()}}
        </div>
    </div>

@endsection

