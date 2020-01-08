<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--[if lt IE 9]>
<script type="text/javascript" src="/h-ui/lib/html5shiv.js"></script>
<script type="text/javascript" src="/h-ui/lib/respond.min.js"></script>

<![endif]-->
<link href="{{asset('/h-ui/static/h-ui/css/H-ui.min.css')}}" rel="stylesheet" type="text/css" />
<link href="/h-ui/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/h-ui/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />

<!--[if IE 6]>
<script type="text/javascript" src="/h-ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>@yield('title')</title>
</head>
<body>
@section('body')

@show
<div id="popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content radius">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <p id="popup_content"></p>
                <div class="modal-footer">
                    {{--<button class="btn btn-primary btn-ok">确定</button>--}}
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="/h-ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/h-ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/h-ui/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/h-ui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/h-ui/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/h-ui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/h-ui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/js/01.js" ></script>
</body>
</html>