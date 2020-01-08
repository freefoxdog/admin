
@extends('public._blank')
@section('title','管理员列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="text-c">
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="r">共有数据：<strong> {{$data->total()}} </strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">用户名</th>
                <th width="90">类型</th>
                <th width="130">状态</th>
                <th width="90">创建时间</th>
                <th width="90">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr class="text-c">
                    <td>{{$v->id}}</td>
                    <td>{{$v->name}}</td>
                    <td>
                        @switch($v->id_ype)
                            @case(1)
                                超级管理员
                                @break
                            @default
                                管理员

                            @endswitch
                    </td>
                    <td>
                        @if($v->deleted_at)
                            已禁用
                            @else
                            启用
                            @endif
                    </td>
                    <td>{{date('Y-m-d H:i:s',$v->created_at)}}</td>
                    <td>
                        <a style="text-decoration:none" class="{{$v->deleted_at ===null?'hidden':''}}"  href="{{route('admin.startUser',['id' => $v->id])}}" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>
                        <a style="text-decoration:none" class="ml-5  {{$v->deleted_at !==null?'hidden':''}}"  href="{{route('admin.destroy',['id' =>  $v->id])}}" title="禁用"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="pageNav" class="pageNav">
            {{$data->links()}}
        </div>
    </div>
    <script>
        window.onload = function()
        {
            if ('{{$errors->first()}}'){
                $('#popup_content').text("{{$errors->first()}}");
                $('#popup').modal('show')
            }
            if ('{{session('result')}}'){
                $('#popup_content').text("{{session('result')}}");
                $('#popup').modal('show')
            }
        }
    </script>
@endsection
