<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/11
 * Time: 14:06:28
 */

namespace App\Storage\Database;

use App\Storage\Database;
use App\Generator\Storage\Database\AdminUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Database
{
    use AdminUserTrait;
    protected $table = 'admin_users';
    //TODO please complete $fields
    protected $fields = [
        'id' => 'id',
        'name' => 'name',
        'password' => 'password',
        'pic' => 'pic',
        'id_ype' => 'idType',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
        'deleted_at' => 'deletedAt',
    ];
    protected  $fillable = [
        'name',
        'password',
        'pic',
        'id_ype',
    ];



}