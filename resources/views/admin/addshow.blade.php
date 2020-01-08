@extends('public._blank')
@section('title','添加管理员')

@section('body')

    <article class="page-container">
        <form class="form form-horizontal" id="form-admin-add" method="POST" action="{{route('admin.store')}}">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{old('name')}}" placeholder="" id="adminName" name="name"><span class="c-red">{{$errors->first('name')}}</span>
                </div>
            </div>
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password"><span class="c-red">{{$errors->first('password')}}</span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password" name="password_confirmation">
                </div>
            </div>



            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色：</label>
                <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
                        <select class="select" name="type" size="1"> <span class="c-red">{{$errors->first('type')}}</span>
				<option value="1" {{old('type')&&old('type'==1?'selected':'')}}>超级管理员</option>
				<option value="2" {{old('type')&&old('type'==2?'selected':'')}} {{old('type')?'':'selected'}}>管理员</option>
			</select>
			</span> </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius"  type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                    <span>
                        @if(session('success'))
                            {{session('success')}}
                            @endif
                    </span>
                    <span class="c-red">
                        @if(session('error'))
                            {{session('error')}}
                        @endif
                    </span>
                </div>
            </div>
        </form>
    </article>
@endsection

