
@extends('public._blank')
@section('title','用户列表')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="text-c">
            <form action="{{route('users.index')}}" method="GET">
          <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、用户ID" id="" value="{{$search}}" name="search"><button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜用户</button>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
                 <span class="r">共有数据：<strong> {{$data->total()}} </strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">用户名</th>
                <th width="90">手机</th>
                <th width="130">加入时间</th>
                <th width="90">类型</th>
                <th width="90">身份类型</th>
                <th width="90">可用余额</th>
                <th width="90">冻结金额</th>
                <th width="90">奖励金额</th>
                <th width="90">累计购买</th>
                <th width="90">累计出售</th>
                <th width="70">状态</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
            <tr class="text-c">
                <td>{{ $v->id }}</td>
                <td>{{ $v->name }}</td>
                <td>{{ $v->mobile }}</td>
                <td>{{ date('Y-m-d H:i:s',$v->created_at) }}</td>
                <td>@switch($v->identity)
                    @case(1)
                        群主
                        @break
                    @case(2)
                        交易员
                        @break
                    @case(3)
                        商户
                        @break
                @endswitch
                </td>
                <td>
                    @if(isset($v->userInfo->type))
                        @switch($v->userInfo->type)
                            @case(1)
                                 中国大陆
                                @break
                            @default
                                非大陆
                        @endswitch
                    @else
                        未实名制
                    @endif
                </td>
                <td>{{$v->account->flow}}</td>
                <td>{{$v->account->frozen}}</td>
                <td>{{$v->account->reward}}</td>
                <td>{{$v->flow->filter(function($value,$key){
                    return $value->flow_type == 2;
                })->sum->num}}</td>
                <td>
                    {{$v->flow->filter(function($value,$key){
                    return $value->flow_type == 7;
                })->sum->num}}
                </td>
                <td>
                    @switch($v->status)
                        @case(1)
                            正常
                        @break
                        @default
                            禁止
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

