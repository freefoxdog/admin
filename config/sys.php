<?php
return [
    'page_num' => 10,//分页数量,
    'api_complaint_url' => 'http://127.0.0.1:8019/storage/complaint/',//投诉图片api地址
    'pay'=>array(
        1 => '银行卡',
        2 => '支付宝',
        4 => '微信',
        8 => 'paypal',
    ),//支付方式--和api对应
    'registerAddress' => '127.0.0.1:1236',//websocket地址
];