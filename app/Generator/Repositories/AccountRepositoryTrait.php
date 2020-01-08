<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/09
* Time: 16:23:01
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait AccountRepositoryTrait
{
    public function __construct(\App\Storage\Database\Account $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->uid  =  $newData['uid'];
        $model->flow  =  $newData['flow'];
        $model->frozen  =  $newData['frozen'];
        $model->reward  =  $newData['reward'];
        $model->status  =  $newData['status'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        if(isset($updateData['uid']))
        $oldModel->uid  =  $updateData['uid'];
        if(isset($updateData['flow']))
        $oldModel->flow  =  $updateData['flow'];
        if(isset($updateData['frozen']))
        $oldModel->frozen  =  $updateData['frozen'];
        if(isset($updateData['reward']))
        $oldModel->reward  =  $updateData['reward'];
        if(isset($updateData['status']))
        $oldModel->status  =  $updateData['status'];
            return $this->save($oldModel);
    }

}