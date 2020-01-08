<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/09
* Time: 16:20:52
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait UserInfoRepositoryTrait
{
    public function __construct(\App\Storage\Database\UserInfo $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->uid  =  $newData['uid'];
        $model->type  =  $newData['type'];
        $model->name  =  $newData['name'];
        $model->card  =  $newData['card'];
        $model->mobile  =  $newData['mobile'];
        $model->jyPassword  =  $newData['jyPassword'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        return false;
    }

}