
@extends('public._blank')
@section('title','挂单列表')

@section('body')

    <div class="pd-20">
        <div class="Huiform">
            <form action="/" method="post">
                <table class="table table-bg">
                    <tbody>
                    <tr>
                        <th width="100" class="text-r"><span class="c-red">*</span> 订单号：</th>
                        <td><input type="text" style="width:200px" class="input-text" value="" placeholder="" id="user-name" name="user-name" datatype="*2-16" nullmsg="用户名不能为空"></td>
                    </tr>
                    <tr>
                        <th class="text-r"><span class="c-red">*</span> 类型：</th>
                        <td><label>
                                <input name="sex" type="radio" id="six_1" value="1" checked>
                                增加</label>
                            <label>
                                <input type="radio" name="sex" value="0" id="six_0">
                                减少</label></td>
                    </tr>
                    <tr>
                        <th class="text-r"><span class="c-red">*</span> 数量：</th>
                        <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="user-tel"></td>
                    </tr>

                    <tr>
                        <th class="text-r"><span class="c-red">*</span> 类型</th>
                        <td><span class="select-box" style="width: 20%">
				<select class="select" name="group">

                        <option value="1">挂单出售</option>
                    <option value="1">挂单购买</option>
                    <option value="1">挂单奖励</option>
                    <option value="1">挂单购买分成</option>
                    <option value="1">红包过期未支付奖励</option>
                    <option value="1">商户取消奖励</option>
                    <option value="1">红包交易成功</option>

				</select>
				</span><span style="color:red;margin-left:20px;">&emsp;{{$errors->first('group')}}</span></td>

                    </tr>

                    {{--<tr>--}}
                        {{--<th class="text-r">邮箱：</th>--}}
                        {{--<td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-email" name="user-email"></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<th class="text-r">头像：</th>--}}
                        {{--<td><input type="file" class="" name="" multiple></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<th class="text-r">地址：</th>--}}
                        {{--<td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-address" name="user-address"></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<th class="text-r">简介：</th>--}}
                        {{--<td><textarea class="input-text" name="user-info" id="user-info" style="height:100px;width:300px;"></textarea></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        <th></th>
                        <td><button class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 确定</button></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <script>
        window.onload=function () {

        }
    </script>
@endsection

