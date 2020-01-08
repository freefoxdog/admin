<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/09
 * Time: 16:20:52
 */

namespace App\Storage\Database;

use App\Storage\Database;
use App\Generator\Storage\Database\UserInfoTrait;

class UserInfo extends Database
{
    use UserInfoTrait;
    protected $table = 'user_infos';
    //TODO please complete $fields
    protected $fields = [
        'id' => 'id',
        'uid' => 'uid',
        'type' => 'type',
        'name' => 'name',
        'card' => 'card',
        'mobile' => 'mobile',
        'jy_password' => 'jyPassword',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
    ];

}