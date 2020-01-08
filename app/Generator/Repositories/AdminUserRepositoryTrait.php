<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/11
* Time: 14:06:28
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait AdminUserRepositoryTrait
{
    public function __construct(\App\Storage\Database\AdminUser $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->name  =  $newData['name'];
        $model->password  =  $newData['password'];
        $model->idType  =  $newData['idType'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        if(isset($updateData['name']))
        $oldModel->name  =  $updateData['name'];
        if(isset($updateData['password']))
        $oldModel->password  =  $updateData['password'];
        if(isset($updateData['pic']))
        $oldModel->pic  =  $updateData['pic'];
        if(isset($updateData['idType']))
        $oldModel->idType  =  $updateData['idType'];
            return $this->save($oldModel);
    }

}