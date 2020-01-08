<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/09
 * Time: 16:23:01
 */

namespace App\Storage\Database;

use App\Storage\Database;
use App\Generator\Storage\Database\AccountTrait;

class Account extends Database
{
    use AccountTrait;
    protected $table = 'accounts';
    //TODO please complete $fields
    protected $fields = [
        'id' => 'id',
        'uid' => 'uid',
        'flow' => 'flow',
        'frozen' => 'frozen',
        'reward' => 'reward',
        'status' => 'status',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
    ];

    /**
     *
     * 账户流动金额减少指定金额
     *
     * @param  $acc_model Account 模型
     * @param  $num int 减少数量
     * @return  bool
     * */
    public static function sub(Account $acc_model, $num)
    {
        $acc_model->flow = bcsub($acc_model->flow, $num, 2);
        return $acc_model->save();
    }

}