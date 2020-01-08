<?php

return [
    'max' => 5,//分享码层级
    'rate' => '0.2',//群主分享率 20%
    'term_of_validity' => 86400,//挂单有效时间 单位秒数
    'order_term_of_validity' => 18000,//订单有效时间
    'order_pay_currency_overtime' => 36000,//卖家超时未付币

    'webSocket' => [
        'name' => 'ChatGateway',//设置名称，方便status时查看
        'registerAddress' => '127.0.0.1:1236',//注册监听
        'gateway' => 'Websocket://0.0.0.0:7272',
        'lanIp' => '127.0.0.1',// 分布式部署时请设置成内网ip（非127.0.0.1）
        'gateway_count' => 4,//设置进程数，gateway进程数建议与cpu核数相同
        //// 内部通讯起始端口。假如$gateway->count=4，起始端口为2300
        'startPort' => 2300,// 则一般会使用2300 2301 2302 2303 4个端口作为内部通讯端口
        'pingInterval'=> 10,// 心跳间隔
        'pingData' => '{"type":"ping"}',//心跳数据

        'worker_name' => 'ChatBusinessWorker',
        'bussinessWorker_count' => 4,// bussinessWorker进程数量

        'socket_name' => 'text://0.0.0.0:1236',

    ],

    'red_packet'=>[//红包配置
        'request_time' => 60000,//红包新增请求参数有效期
        'efffet_at' => 1800,//红包任务有效期
        'complaints_at' => 1800,//支付有效期，过期用户可投诉-商户限期支付
        'complaints_at_user' => 1800,//用户限期支付币
        'pay_money_expire' => 10,//商户红包任务过期付rmb扣群主账户奖励
        'repeat_num' => 3,//红包重发次数 总次数 +1；
        'repeat_time' => 600,//重发红包有效期
    ],

    'group'=>[
        'group_num' => 20,//战队排行显示数量
    ],
];