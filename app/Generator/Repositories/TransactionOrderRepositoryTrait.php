<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/10
* Time: 11:09:48
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait TransactionOrderRepositoryTrait
{
    public function __construct(\App\Storage\Database\TransactionOrder $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->orderId  =  $newData['orderId'];
        $model->uid  =  $newData['uid'];
        $model->transactionsID  =  $newData['transactionsID'];
        $model->num  =  $newData['num'];
        $model->payType  =  $newData['payType'];
        $model->payList  =  $newData['payList'];
        $model->payNum  =  $newData['payNum'];
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
        if(isset($updateData['transactionsID']))
        $oldModel->transactionsID  =  $updateData['transactionsID'];
        if(isset($updateData['num']))
        $oldModel->num  =  $updateData['num'];
        if(isset($updateData['payType']))
        $oldModel->payType  =  $updateData['payType'];
        if(isset($updateData['payList']))
        $oldModel->payList  =  $updateData['payList'];
        if(isset($updateData['payNum']))
        $oldModel->payNum  =  $updateData['payNum'];
        if(isset($updateData['status']))
        $oldModel->status  =  $updateData['status'];
            return $this->save($oldModel);
    }

}