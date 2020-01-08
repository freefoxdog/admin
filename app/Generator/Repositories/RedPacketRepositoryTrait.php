<?php
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: 2019/10/18
* Time: 17:21:50
*/

namespace App\Generator\Repositories;

use App\Storage\Storage;
trait RedPacketRepositoryTrait
{
    public function __construct(\App\Storage\Database\RedPacket $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
        $model = $this->storage();
        $model->appID  =  $newData['appID'];
        $model->service  =  $newData['service'];
        $model->url  =  $newData['url'];
        return $this->save($model);
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
        return false;
    }

}