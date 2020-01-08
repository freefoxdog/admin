<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/09
* Time: 16:23:01
*/

namespace App\Repositories;
use App\Generator\Repositories\AccountRepositoryTrait;

class AccountRepository extends  Repository
{
    use AccountRepositoryTrait;

    public function getDataInfo($uid)
    {
        $w = array(
            'uid' => $uid,
            'status' => 1
        );
        return $this->storage()::where($w)->first();
    }

}