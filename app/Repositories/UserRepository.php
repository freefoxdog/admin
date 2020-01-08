<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/09
* Time: 15:37:13
*/

namespace App\Repositories;
use App\Generator\Repositories\UserRepositoryTrait;

class UserRepository extends  Repository
{
    use UserRepositoryTrait;


    //获取递归祖父id
    public function getParents($uid,$level,$data)
    {
        $user_data = $this->storage()::find($uid);


        if ($user_data->level === 0){
            return [];
        }elseif ($user_data->level == 1){
            $data[] = $user_data->id;
            return $data;
        }

        $data =  $this->getParents($user_data->parent_id,$user_data->level,$data);
        $data [] = $user_data->id;
        return $data;

    }


    public function VerGoogle($user, $value)
    {
        $google2fa_secret = $user->google2fa_secret;
        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyGoogle2FA(
            $google2fa_secret,
            $value
        );
        return $valid;
    }
}