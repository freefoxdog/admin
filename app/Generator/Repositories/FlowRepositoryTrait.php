<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/09
* Time: 17:26:25
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait FlowRepositoryTrait
{
    public function __construct(\App\Storage\Database\Flow $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->uid  =  $newData['uid'];
        $model->flowType  =  $newData['flowType'];
        $model->source  =  $newData['source'];
        $model->num  =  $newData['num'];
        $model->beforeNum  =  $newData['beforeNum'];
        $model->afterNum  =  $newData['afterNum'];
        $model->symbol  =  $newData['symbol'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        if(isset($updateData['uid']))
        $oldModel->uid  =  $updateData['uid'];
        if(isset($updateData['flowType']))
        $oldModel->flowType  =  $updateData['flowType'];
        if(isset($updateData['source']))
        $oldModel->source  =  $updateData['source'];
        if(isset($updateData['num']))
        $oldModel->num  =  $updateData['num'];
        if(isset($updateData['beforeNum']))
        $oldModel->beforeNum  =  $updateData['beforeNum'];
        if(isset($updateData['afterNum']))
        $oldModel->afterNum  =  $updateData['afterNum'];
        if(isset($updateData['symbol']))
        $oldModel->symbol  =  $updateData['symbol'];
            return $this->save($oldModel);
    }

}