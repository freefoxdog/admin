<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/12
* Time: 09:45:39
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait GroupNociteRepositoryTrait
{
    public function __construct(\App\Storage\Database\GroupNocite $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->uid  =  $newData['uid'];
        $model->content  =  $newData['content'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        return false;
    }

}