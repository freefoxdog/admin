<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/9/29
 * Time: 12:34
 */
return [
//    'Article' => [
//        'propertys' => [
//            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
//            'userId' => ['schema' => ['type' => 'integer'], 'fieldName' => 'user_id', 'insert' => true, 'update' => false, 'uid' => true],
//            'topicId' => ['schema' => ['type' => 'integer'], 'fieldName' => 'topic_id', 'insert' => true, 'update' => false, 'required' => true],
//            'title' => ['schema' => ['type' => 'string', 'len' => 64], 'fieldName' => 'title', 'insert' => true, 'update' => true, 'required' => true, 'validate' => 'min:5'],
//            'pics' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'pics', 'insert' => true, 'update' => false, 'default' => ''],
//            'commentsSum' => ['schema' => ['type' => 'integer'], 'fieldName' => 'comments_sum', 'insert' => true, 'update' => false, 'default' => 0],
//            'content' => ['schema' => ['type' => 'text'], 'fieldName' => 'content', 'insert' => true, 'update' => true, 'required' => true, 'validate' => 'min:15'],
//            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
//            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
//            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],
//
//        ],
//        'relation' => [
//            'comments' => [
//                'num' => '1tn',
//                'type' => 'morph',
//                'class' => 'Comment',
//                'arg1' => 'media',
//            ],
//            'topic' => [
//                'num' => 'nt1',
//                'type' => 'simple',
//                'class' => 'Topic',
//            ]
//        ],
//        'softDelete' => true,
//        'module' => ['ctrl', 'repo', 'data'],
//        //'table' => 'articles'
//
//    ],

    'User' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'name' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'name', 'insert' => true, 'update' => false],
            'mobile' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'mobile', 'insert' => true, 'update' => false],
            'password' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'password', 'insert' => true, 'update' => true],
            'pic' => ['schema' => ['type' => 'string', 'len' => 512], 'fieldName' => 'pic', 'insert' => true, 'update' => false],
            'identity' => ['schema' => ['type' => 'string', 'len' => 512], 'fieldName' => 'identity', 'insert' => true, 'update' => false],
            'grade' => ['schema' => ['type' => 'integer'], 'fieldName' => 'grade', 'insert' => true, 'update' => false],
            'fraction' => ['schema' => ['type' => 'integer'], 'fieldName' => 'fraction', 'insert' => true, 'update' => false],
            'rememberToken' => ['schema' => ['type' => 'string', 'len' => 100], 'fieldName' => 'remember_token', 'insert' => true, 'update' => false],
            'status' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'status', 'insert' => false, 'update' => false],
            'sharaCode' => ['schema' => ['type' => 'string','len' => 10], 'fieldName' => 'shara_code', 'insert' => false, 'update' => false],
            'parentId' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'parent_id', 'insert' => false, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],

        ],

        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'users'

    ],
    'Pay' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'payId' => ['schema' => ['type' => 'integer'], 'fieldName' => 'pay_id', 'insert' => true, 'update' => false],
            'name' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'name', 'insert' => true, 'update' => false],
            'account' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'account', 'insert' => true, 'update' => false],
            'payPic' => ['schema' => ['type' => 'string', 'len' => 512], 'fieldName' => 'pay_pic', 'insert' => true, 'update' => false],
            'other' => ['schema' => ['type' => 'string', 'len' => 512], 'fieldName' => 'schema', 'insert' => true, 'update' => true],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],
        ],
        'softDelete' => true,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'pay'
    ],

    'UserInfo' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'type' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'type', 'insert' => true, 'update' => false],
            'name' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'name', 'insert' => true, 'update' => false],
            'card' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'card', 'insert' => true, 'update' => false],
            'mobile' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'mobile', 'insert' => true, 'update' => false],
            'jyPassword' => ['schema' => ['type' => 'string', 'len' => 512], 'fieldName' => 'jy_password', 'insert' => true, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
        ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'user_infos'
    ],
//账户
    'Account' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'flow' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'flow', 'insert' => true, 'update' => true],
            'frozen' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'frozen', 'insert' => true, 'update' => true],
            'reward' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'reward', 'insert' => true, 'update' => true],
            'status' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'status', 'insert' => true, 'update' => true],
             'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
        ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'accounts'
    ],
//交易单
    'Transaction' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'orderId' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'order_id', 'insert' => true, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'total' => ['schema' => ['type' => 'integer'], 'fieldName' => 'total', 'insert' => true, 'update' => true],
            'surplus' => ['schema' => ['type' => 'integer'], 'fieldName' => 'surplus', 'insert' => true, 'update' => true],
            'min' => ['schema' => ['type' => 'integer'], 'fieldName' => 'min', 'insert' => true, 'update' => true],
            'max' => ['schema' => ['type' => 'integer'], 'fieldName' => 'max', 'insert' => true, 'update' => true],
            'price' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'price', 'insert' => true, 'update' => true],
            'remarks' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'remarks', 'insert' => true, 'update' => false],
            'payType' => ['schema' => ['type' => 'integer'], 'fieldName' => 'pay_type', 'insert' => true, 'update' => true],
            'payList' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'pay_list', 'insert' => true, 'update' => true],
            'status' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'status', 'insert' => true, 'update' => true],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
        ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'transactions'
    ],

    //挂单订单
    'TransactionOrder' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'orderId' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'order_id', 'insert' => true, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'transactionsID' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'transactions_id', 'insert' => true, 'update' => false],
            'num' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'num', 'insert' => true, 'update' => true],
            'payType' => ['schema' => ['type' => 'integer'], 'fieldName' => 'pay_type', 'insert' => true, 'update' => true],
            'payList' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'pay_list', 'insert' => true, 'update' => true],
            'payNum' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'pay_num', 'insert' => true, 'update' => true],
            'termOfValidity' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'term_of_validity', 'insert' => false, 'update' => false],
            'status' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'status', 'insert' => true, 'update' => true],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
     ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'transaction_orders'
    ],

    //账户流水
    'Flow' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'flowType' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'flow_type', 'insert' => true, 'update' => true],
            'source' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'source', 'insert' => true, 'update' => false],
            'num' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'num', 'insert' => true, 'update' => false],
            'beforeNum' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'before_num', 'insert' => true, 'update' => false],
            'afterNum' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'after_num', 'insert' => true, 'update' => false],
            'symbol' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'symbol', 'insert' => true, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
        ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'flows'
    ],

    //投诉
    'Complaint' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'complaintId' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'complaint_id', 'insert' => true, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'type' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'type', 'insert' => true, 'update' => true],
            'order' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'order', 'insert' => true, 'update' => false],
            'content' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'content', 'insert' => true, 'update' => false],
            'pic' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'pic', 'insert' => true, 'update' => false],
            'isHand' => ['schema' => ['type' => 'integer'], 'fieldName' => 'is_hand', 'insert' => true, 'update' => false],
            'handContent' => ['schema' => ['type' => 'integer'], 'fieldName' => 'hand_content', 'insert' => true, 'update' => false],
            'handAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'hand_at', 'insert' => false, 'update' => false],
            'handUid' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'hand_uid', 'insert' => false, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
        ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'complaints'
    ],
    //群聊
    'Groupchat' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'master' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'master', 'insert' => false, 'update' => false],
            'name' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'name', 'insert' => true, 'update' => false],
            'status' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'status', 'insert' => true, 'update' => true],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
        ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'groupchats'
    ],
    //群公告
    'GroupNocite' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'content' => ['schema' => ['type' => 'string', 'len' => 600], 'fieldName' => 'content', 'insert' => true, 'update' => false],
            'readNum' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'read_num', 'insert' => false, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],

        ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'group_nocites'
    ],

    //已读人数
    'GroupReadNocite' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'nociteId' => ['schema' => ['type' => 'integer'], 'fieldName' => 'nocite_id', 'insert' => true, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
        ],
        'softDelete' => false,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'group_read_nocites'
    ],

    //聊天记录

    'Talk' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'type' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'type', 'insert' => true, 'update' => true],
            'content' => ['schema' => ['type' => 'string', 'len' => 800], 'fieldName' => 'content', 'insert' => true, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],

        ],
        'softDelete' => true,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'talks'
    ],


    //红包任务

    'Task' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'sendUid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'send_uid', 'insert' => true, 'update' => false],
            'num' => ['schema' => ['type' => 'integer'], 'fieldName' => 'num', 'insert' => true, 'update' => false],
            'price' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'price', 'insert' => true, 'update' => true],
            'money' => ['schema' => ['type' => 'decimal','len' => '10,2'], 'fieldName' => 'money', 'insert' => true, 'update' => true],
            'status' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'status', 'insert' => true, 'update' => true],
            'repeatNum' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'repeat_num', 'insert' => true, 'update' => true],
            'efffetAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'efffet_at', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'pay' => ['schema' => ['type' => 'text'], 'fieldName' => 'pay', 'insert' => true, 'update' => false],
            'taskAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'task_at', 'insert' => false, 'update' => false],
            'complaintAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'complaints_at', 'insert' => false, 'update' => false],
            'getMoneyAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'get_money_at', 'insert' => false, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],

        ],
        'softDelete' => true,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'tasks'
    ],

    //redpacket
    'RedPacket' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'appID' => ['schema' => ['type' => 'integer'], 'fieldName' => 'app_id', 'insert' => true, 'update' => false],
            'service' => ['schema' => ['type' => 'string','len' => 255], 'fieldName' => 'service', 'insert' => true, 'update' => false],
            'url' => ['schema' => ['type' => 'text'], 'fieldName' => 'url', 'insert' => true, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],

        ],
        'softDelete' => true,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'red_packets'
    ],


    'NoticeData' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'type' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'type', 'insert' => true, 'update' => false],
            'content' => ['schema' => ['type' => 'string', 'len' => 800], 'fieldName' => 'content', 'insert' => true, 'update' => false],
            'isRead' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'is_read', 'insert' => true, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],

        ],
        'softDelete' => true,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'notices'
    ],

    'AdminUser' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'name' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'name', 'insert' => true, 'update' => false],
            'password' => ['schema' => ['type' => 'string', 'len' => 255], 'fieldName' => 'password', 'insert' => true, 'update' => true],
            'pic' => ['schema' => ['type' => 'string', 'len' => 512], 'fieldName' => 'pic', 'insert' => true, 'update' => false],
            'idType' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'id_ype', 'insert' => true, 'update' => true],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],
        ],

        'softDelete' => true,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'admin_users'

    ],
    'MerchantCashOrder' => [
        'propertys' => [
            'id' => ['schema' => ['type' => 'increments'], 'fieldName' => 'id', 'insert' => false, 'update' => false],
            'uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'uid', 'insert' => true, 'update' => false],
            'order' => ['schema' => ['type' => 'integer'], 'fieldName' => 'order', 'insert' => true, 'update' => false],
            'type' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'type', 'insert' => true, 'update' => false],
            'status' => ['schema' => ['type' => 'tinyinteger'], 'fieldName' => 'status', 'insert' => true, 'update' => false],
            'num' => ['schema' => ['type' => 'integer'], 'fieldName' => 'num', 'insert' => true, 'update' => false],
            'admin_uid' => ['schema' => ['type' => 'integer'], 'fieldName' => 'admin_uid', 'insert' => true, 'update' => false],
            'createdAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'created_at', 'insert' => false, 'update' => false],
            'updatedAt' => ['schema' => ['type' => 'integer', 'null' => true], 'fieldName' => 'updated_at', 'insert' => false, 'update' => false],
            'deletedAt' => ['schema' => ['type' => 'integer', 'null' => true, 'default' => null], 'fieldName' => 'deleted_at', 'insert' => false, 'update' => false],

        ],
        'softDelete' => true,
        'module' => ['ctrl', 'repo', 'data'],
        'table' => 'merchant_cash_order'
    ],

];