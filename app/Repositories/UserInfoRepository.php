<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/09
* Time: 16:20:52
*/

namespace App\Repositories;
use App\Generator\Repositories\UserInfoRepositoryTrait;

class UserInfoRepository extends  Repository
{
    use UserInfoRepositoryTrait;

    public function getIdsRate(array $ids)
    {
        return $this->storage()::whereIn('uid',$ids)->pluck('rate','uid');
    }

}