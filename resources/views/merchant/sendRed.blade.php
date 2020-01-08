
@extends('public._blank')
@section('title','发红包')

@section('body')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 任务管理 <span class="c-gray en">&gt;</span> 商户列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <span>仅供测试使用</span>
        <form action="{{route('red.store')}}" method="get">
            <div>
                请选择商户：
                <input type="number" name="appid" value="3" readonly>
            </div>

            <div>
                请输入数量：
                <input type="number" name="num" value="100" >
            </div>
            <div>
                请选择支付方式：
                <input type="number" name="pay" value="7">
                <span>
                    备注：
                        银行支付 1，
                        支付宝支付 ：2，
                        微信支付： 4，
                        PayPal：8
                    填写数值格式为支持的方式相加：如支持银行卡和微信支付，请填写 5


                </span>
            </div>
            <button type="submit">确定</button>
        </form>

    </div>



@endsection

