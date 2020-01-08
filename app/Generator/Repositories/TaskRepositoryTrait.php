<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/10
* Time: 15:24:23
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait TaskRepositoryTrait
{
    public function __construct(\App\Storage\Database\Task $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->sendUid  =  $newData['sendUid'];
        $model->num  =  $newData['num'];
        $model->price  =  $newData['price'];
        $model->money  =  $newData['money'];
        $model->status  =  $newData['status'];
        $model->repeatNum  =  $newData['repeatNum'];
        $model->uid  =  $newData['uid'];
        $model->pay  =  $newData['pay'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        if(isset($updateData['sendUid']))
        $oldModel->sendUid  =  $updateData['sendUid'];
        if(isset($updateData['num']))
        $oldModel->num  =  $updateData['num'];
        if(isset($updateData['price']))
        $oldModel->price  =  $updateData['price'];
        if(isset($updateData['money']))
        $oldModel->money  =  $updateData['money'];
        if(isset($updateData['status']))
        $oldModel->status  =  $updateData['status'];
        if(isset($updateData['repeatNum']))
        $oldModel->repeatNum  =  $updateData['repeatNum'];
        if(isset($updateData['uid']))
        $oldModel->uid  =  $updateData['uid'];
        if(isset($updateData['pay']))
        $oldModel->pay  =  $updateData['pay'];
            return $this->save($oldModel);
    }

}