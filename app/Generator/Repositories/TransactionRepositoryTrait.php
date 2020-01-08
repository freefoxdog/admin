<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/10
* Time: 11:09:36
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait TransactionRepositoryTrait
{
    public function __construct(\App\Storage\Database\Transaction $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->orderId  =  $newData['orderId'];
        $model->uid  =  $newData['uid'];
        $model->total  =  $newData['total'];
        $model->surplus  =  $newData['surplus'];
        $model->min  =  $newData['min'];
        $model->max  =  $newData['max'];
        $model->price  =  $newData['price'];
        $model->remarks  =  $newData['remarks'];
        $model->payType  =  $newData['payType'];
        $model->payList  =  $newData['payList'];
        $model->status  =  $newData['status'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        if(isset($updateData['orderId']))
        $oldModel->orderId  =  $updateData['orderId'];
        if(isset($updateData['uid']))
        $oldModel->uid  =  $updateData['uid'];
        if(isset($updateData['total']))
        $oldModel->total  =  $updateData['total'];
        if(isset($updateData['surplus']))
        $oldModel->surplus  =  $updateData['surplus'];
        if(isset($updateData['min']))
        $oldModel->min  =  $updateData['min'];
        if(isset($updateData['max']))
        $oldModel->max  =  $updateData['max'];
        if(isset($updateData['price']))
        $oldModel->price  =  $updateData['price'];
        if(isset($updateData['remarks']))
        $oldModel->remarks  =  $updateData['remarks'];
        if(isset($updateData['payType']))
        $oldModel->payType  =  $updateData['payType'];
        if(isset($updateData['payList']))
        $oldModel->payList  =  $updateData['payList'];
        if(isset($updateData['status']))
        $oldModel->status  =  $updateData['status'];
            return $this->save($oldModel);
    }

}