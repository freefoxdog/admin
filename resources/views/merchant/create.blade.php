
@extends('public._blank')
@section('title','挂单列表')

@section('body')

    <div class="pd-20">
        <div class="Huiform">

            <form action="{{route('merchants.store')}}" method="post">
                <table class="table table-bg">
                    <tbody>
                    <tr>
                        <th width="100" class="text-r"><span class="c-red">*</span> 商户名：</th>
                        <td><input type="text" style="width:200px" class="input-text" value="" placeholder="" id="user-name" name="name" datatype="*2-16" nullmsg="用户名不能为空"><span style="color:red;margin-left:20px;">&emsp;{{$errors->first('name')}}</span></td>

                    </tr>

                    <tr>
                        <th class="text-r"><span class="c-red">*</span> 手机号：</th>
                        <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="mobile"><span style="color:red;margin-left:20px;">&emsp;{{$errors->first('mobile')}}</span></td>
                    </tr>
                    <tr>
                        <th class="text-r"><span class="c-red">*</span> 校验字串：</th>
                        <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-email" name="rand"><span style="color:red;margin-left:20px;">&emsp;{{$errors->first('rand')}}</span></td>
                    </tr>
                    <tr>
                        <th class="text-r"><span class="c-red">*</span> 回调地址：</th>
                        <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user_url" name="url"><span style="color:red;margin-left:20px;">&emsp;{{$errors->first('url')}}</span></td>
                    </tr>
                    @csrf
                    <tr>
                        <th class="text-r"><span class="c-red">*</span> 所属群</th>
                        <td><span class="select-box" style="width: 20%">
				<select class="select" name="group">
                    @foreach($data as $v)
					<option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach

				</select>
				</span><span style="color:red;margin-left:20px;">&emsp;{{$errors->first('group')}}</span></td>

                    </tr>
                    <tr>
                        <th></th>
                        <td><button class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 确定</button> <span style="color: red">
                                @if(!empty(session('result')))
                            {{session('result')}}
                               @endif
                            </span></td>
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

