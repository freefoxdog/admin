<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/11
* Time: 10:13:10
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait GroupchatRepositoryTrait
{
    public function __construct(\App\Storage\Database\Groupchat $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->name  =  $newData['name'];
        $model->status  =  $newData['status'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        if(isset($updateData['name']))
        $oldModel->name  =  $updateData['name'];
        if(isset($updateData['status']))
        $oldModel->status  =  $updateData['status'];
            return $this->save($oldModel);
    }

}