<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 11:09:36
 */

namespace App\Storage\Database;

use App\Storage\Database;
use App\Generator\Storage\Database\TransactionTrait;

class Transaction extends Database
{
    use TransactionTrait;
    protected $table = 'transactions';
    //TODO please complete $fields
    protected $fields = [
        'id' => 'id',
        'order_id' => 'orderId',
        'uid' => 'uid',
        'total' => 'total',
        'surplus' => 'surplus',
        'min' => 'min',
        'max' => 'max',
        'price' => 'price',
        'remarks' => 'remarks',
        'pay_type' => 'payType',
        'pay_list' => 'payList',
        'status' => 'status',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
    ];

    public function index($w)
    {
        return $this->with('user')->orWhere($w[0])->orWhere($w[1])->paginate(config('sys.page_num'));
    }

    public function user()
    {
        return $this->belongsTo('App\Storage\Database\User','uid','id');
    }


    //账户对应
    public function account()
    {
        return $this->belongsTo('App\Storage\Database\Account','uid','uid');
    }
    public function getPayListAttribute($value)
    {
        $pay = config('sys.pay');
        $list = json_decode($value, true);
        $new = array_unique($list);
        $str = '';
        foreach ($new as $v){
            $str .= $pay[$v].',';
        }
        $str = trim($str,',');
        return $str;
    }

}