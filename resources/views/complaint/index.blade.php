
@extends('public._blank')
@section('title','投诉列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 投诉列表 <span class="c-gray en">&gt;</span> 投诉列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="text-c">
            <form action="{{route('complaints.index')}}" method="GET">
                <input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="" value="{{$search}}" name="search"><button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜订单号</button>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="r">共有数据：<strong> {{$data->total()}} </strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th >编号</th>
                <th>投诉人</th>
                <th>投诉类型</th>
                <th>投诉订单号</th>
                <th>内容</th>
                <th>状态</th>
                <th>投诉时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr class="text-c">
                    <td>{{$v->complaint_id}}</td>
                    <td>{{$v->user->name}}</td>
                    <td>@switch($v->type)
                            @case(1)
                                挂单交易
                            @break
                            @default
                                红包任务
                        @endswitch</td>
                    <td>{{$v->order}}</td>
                    <td>{{$v->content}}</td>
                    <td>@switch($v->is_hand)
                            @case(0)
                                未处理
                            @break
                            @case(1)
                                已处理
                            @break
                        @endswitch</td>
                    <td>{{date('Y-m-d H:i:s',$v->created_at)}}</td>
                    <td><a href="{{route('complaints.show')}}?id={{$v->complaint_id}}">详情</a></td>


                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="pageNav" class="pageNav">
            {{$data->appends(['search'=>$search])->links()}}
        </div>
    </div>



@endsection

