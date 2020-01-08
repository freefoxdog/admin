
@extends('public._blank')
@section('title','投诉详情')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 投诉管理 <span class="c-gray en">&gt;</span> 投诉详情 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-l">
            <span><a href="{{route('complaints.index')}}"><button>返回列表</button></a></span>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <thead>
                <tr class="text-c">

                    <th colspan="2">详情</th>
                </tr>
                </thead>
                <tbody>
                <tr class="text-c">
                    <td >投诉编号</td>
                    <td width="80%" class="text-l">{{$data->complaint_id}}</td>
                 </tr>
                <tr class="text-c">
                    <td>申诉人姓名</td>
                    <td width="80%" class="text-l">{{$data->user->name}}</td>
                </tr>
                <tr class="text-c">
                    <td>投诉姓名</td>
                    <td width="80%" class="text-l">
                        @switch($data->type)
                            @case(1)
                                {{$data->transactionOrder->sellUser->name}}
                            @break
                            @default
                            {{$data->task->sendUser->name}}
                        @endswitch
                    </td>
                </tr>
                <tr class="text-c">
                    <td>投诉类型</td>
                    <td width="80%" class="text-l">@switch($data->type)
                            @case(1)
                            挂单交易
                            @break
                            @default
                            红包任务
                        @endswitch</td>
                </tr>
                <tr class="text-c">
                    <td>投诉订单号</td>
                    <td width="80%" class="text-l">{{$data->order}}</td>
                </tr>
                <tr class="text-c">
                    <td>投诉内容</td>
                    <td width="80%" class="text-l">{{$data->content}}</td>
                </tr>
                <tr class="text-c">
                    <td>投诉图片</td>
                    <td width="80%" class="text-l">
                        @foreach($data->pic as $v)
                            <img src = "{{config('sys.api_complaint_url')}}{{$v}}" width="400px">
                            @endforeach
                    </td>
                </tr>
                @if($data->is_hand == 1)
                <tr class="text-c">
                    <td>处理人</td>
                    <td width="80%" class="text-l">
                        {{$data->adminUser->name}}
                    </td>
                </tr>
                <tr class="text-c">
                    <td>处理结果</td>
                    <td width="80%" class="text-l">
                        {{$data->hand_content}}
                    </td>
                </tr>
                <tr class="text-c">
                    <td>处理时间</td>
                    <td width="80%" class="text-l">
                        {{date('Y-m-d H:i:s',$data->hand_at)}}
                    </td>
                </tr>

                    @else

                    <tr class="text-c">
                        <td>处理</td>
                        @if($data->hand_order != 1)
                        <td width="80%" class="text-l"> <a href="{{route('complaints.hand')}}?type=1&complaint_id={{$data->complaint_id}}"><button>完成交易</button></a>  <a href="{{route('complaints.hand')}}?type=2&complaint_id={{$data->complaint_id}}"><button>取消交易</button></a>
                        <span>{{$errors->first()}}
                            @if(!empty(session('orer_error')))
                                {{session('orer_error')}}
                            @endif

                        </span>
                        </td>
                            @else
                            <td width="80%" class="text-l">
                                @if(!empty(session('ret')))
                                    {{session('ret')}}
                                    @else
                                    已处理
                                @endif
                            </td>
                            @endif
                    </tr>


                    <tr class="text-c">
                        <td>回复</td>
                        <td width="80%" class="text-l">
                            <form action="{{route('complaints.store',['id'=>$data->complaint_id])}}" method="POST">
                            <textarea name="content" rows="15px" cols="80px"></textarea>
                                <span style="color: red"> {{$errors->first()}}
                                    @if(!empty(session('result')))
                                        {{session('result')}}
                                    @endif
                                </span><br/>
                                {{--<span style="color: red"> {{$errors()->first('content')}} </span><br/>--}}
                           @csrf
                            <span style="margin-left: 200px"><button type="submit">回复</button></span>
                            </form>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        window.onload=function(){

        }
    </script>

@endsection

