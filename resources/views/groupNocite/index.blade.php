
@extends('public._blank')
@section('title','投诉列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 投诉列表 <span class="c-gray en">&gt;</span> 投诉列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="text-c">

        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="r">共有数据：<strong> {{$data->total()}} </strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th >ID</th>
                <th>群名</th>
                <th>创建者</th>
                <th>内容</th>
                <th>阅读人数</th>
                <th>状态</th>
                <th>创建时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr class="text-c">
                    <td>{{$v->id}}</td>
                    <td>{{$v->group->name}}</td>
                    <td>{{$v->user->name}}</td>
                    <td>{{$v->content}}</td>
                    <td>{{$v->read_num}}</td>
                    <td>
                        @if($v->deleted_at)
                                已删除
                            @else
                                正常
                            @endif

                    </td>
                    <td>{{date('Y-m-d H:i:s',$v->created_at)}}</td>


                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="pageNav" class="pageNav">
            {{$data->links()}}
        </div>
    </div>



@endsection

