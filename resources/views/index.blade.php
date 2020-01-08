@extends('public._blank')
@section('title','首页')

@section('body')


    <header class="navbar-wrapper">
        <div class="navbar navbar-fixed-top">
            <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/">H-ui.admin</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/">H-ui</a>
                <span class="logo navbar-slogan f-l mr-10 hidden-xs">v3.1</span>
                <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
                <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                    <ul class="cl">
                        <li> 管理员</li>
                        <li class="dropDown dropDown_hover">
                            <a href="#" class="dropDown_A">
                                admin
                                <i class="Hui-iconfont">&#xe6d5;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                {{--<li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>--}}
                                {{--<li><a href="#">切换账户</a></li>--}}
                                {{--<li><a href="#">退出</a></li>--}}

                                <li><a href="#">   <a class="dropdown-item" href="{{ route('logout') }}"
                                                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form></a></li>
                            </ul>
                        </li>

                    </ul>

                </nav>
            </div>
        </div>
    </header>
    <aside class="Hui-aside">
        <div class="menu_dropdown bk_2">
            <dl id="menu-article">
                <dt><i class="Hui-iconfont">&#xe616;</i> 用户管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{route('users.index')}}" data-title="用户列表" href="javascript:void(0)">用户列表</a></li>
                    </ul>
                </dd>
            </dl>

            <dl id="menu-source">
                <dt><i class="Hui-iconfont">&#xe64b;</i> 挂单管理 <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{route('transactions.index')}}" data-title="挂单列表" href="javascript:void(0)">挂单列表</a></li>
                    </ul>
                </dd>
            </dl>

            <dl id="menu-comments">
                <dt><i class="Hui-iconfont">&#xe622;</i> 任务管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{route('tasks.index')}}" data-title="任务管理" href="javascript:;">任务列表</a></li>
                        <li><a data-href="{{route('merchants.index')}}" data-title="商户列表" href="javascript:;">商户列表</a></li>
                        <li><a data-href="{{route('red.create')}}" data-title="发送红包" href="javascript:;">发送红包</a></li>
                        <li><a data-href="{{route('task.cash.index')}}" data-title="提现申请" href="javascript:;">提现申请列表</a></li>

                    </ul>
                </dd>
            </dl>


            <dl id="menu-comments">
                <dt><i class="Hui-iconfont">&#xe622;</i> 投诉管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{route('complaints.index')}}" data-title="投诉列表" href="javascript:;">投诉列表</a></li>

                    </ul>
                </dd>
            </dl>

            <dl id="menu-comments">
                <dt><i class="Hui-iconfont">&#xe622;</i> 群管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{route('groupNotice.index')}}" data-title="群通知列表" href="javascript:;">通知列表</a></li>

                    </ul>
                </dd>
            </dl>


            <dl id="menu-admin">
                <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{route('admin.index')}}" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
                        <li><a data-href="{{route('admin.eidt')}}" data-title="修改密码" href="javascript:void(0)">修改密码</a></li>
                        <li><a data-href="{{route('admin.create')}}" data-title="新增用户" href="javascript:void(0)">新增用户</a></li>

                    </ul>
                </dd>
            </dl>

            {{--<dl id="menu-admin">--}}
                {{--<dt><i class="Hui-iconfont">&#xe62d;</i> 设置<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
                {{--<dd>--}}
                    {{--<ul>--}}
                        {{--<li><a data-href="/" data-title="通知管理" href="javascript:void(0)">通知管理</a></li>--}}

                    {{--</ul>--}}
                {{--</dd>--}}
            {{--</dl>--}}

        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active">
                        <span title="我的桌面" data-href="welcome">我的桌面</span>
                        <em></em></li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
                <iframe scrolling="yes" frameborder="0" src="/welcome"></iframe>
            </div>
        </div>
    </section>

    <div class="contextMenu" id="Huiadminmenu">






@endsection
