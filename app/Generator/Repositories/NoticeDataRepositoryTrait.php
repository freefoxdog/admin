<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/12
* Time: 14:04:13
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait NoticeDataRepositoryTrait
{
    public function __construct(\App\Storage\Database\NoticeData $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->uid  =  $newData['uid'];
        $model->type  =  $newData['type'];
        $model->content  =  $newData['content'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        return false;
    }

}