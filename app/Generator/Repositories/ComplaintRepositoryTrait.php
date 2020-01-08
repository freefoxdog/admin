<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/10
* Time: 15:03:29
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait ComplaintRepositoryTrait
{
    public function __construct(\App\Storage\Database\Complaint $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->complaintId  =  $newData['complaintId'];
        $model->uid  =  $newData['uid'];
        $model->type  =  $newData['type'];
        $model->order  =  $newData['order'];
        $model->content  =  $newData['content'];
        $model->pic  =  $newData['pic'];
        $model->isHand  =  $newData['isHand'];
        $model->handContent  =  $newData['handContent'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        if(isset($updateData['complaintId']))
        $oldModel->complaintId  =  $updateData['complaintId'];
        if(isset($updateData['uid']))
        $oldModel->uid  =  $updateData['uid'];
        if(isset($updateData['type']))
        $oldModel->type  =  $updateData['type'];
        if(isset($updateData['order']))
        $oldModel->order  =  $updateData['order'];
        if(isset($updateData['content']))
        $oldModel->content  =  $updateData['content'];
        if(isset($updateData['pic']))
        $oldModel->pic  =  $updateData['pic'];
        if(isset($updateData['isHand']))
        $oldModel->isHand  =  $updateData['isHand'];
        if(isset($updateData['handContent']))
        $oldModel->handContent  =  $updateData['handContent'];
            return $this->save($oldModel);
    }

}