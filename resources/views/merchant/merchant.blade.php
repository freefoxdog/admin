
@extends('public._blank')
@section('title','挂单列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 任务管理 <span class="c-gray en">&gt;</span> 商户列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l"><a href="{{route('merchants.create')}}"><button class="btn radius btn-primary">添加</button></a></span>
            <span class="r">共有数据：<strong> {{$data->total()}} </strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th >商户ID</th>
                <th>商户名</th>
                <th>联系方式</th>
                <th>商户字串</th>
                <th>发包数量</th>
                <th>取消数量</th>
                <th>累计成交数量</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr class="text-c">
                    <td>{{$v->id}}</td>
                    <td>{{$v->name}}</td>
                    <td>{{$v->mobile}}</td>
                    <td>{{$v->password}}</td>
                    <td>{{$v->task_count}}</td>
                    <td>{{$v->task_cancel_count}}</td>
                    <td>{{$v->task->filter(function($value,$key){
                        return $value['status'] == 5;
                    })->sum('num')}}</td>
                    <td>@switch($v->status)
                            @case(1)
                                正常
                                @break
                            @default
                                异常
                        @endswitch
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

