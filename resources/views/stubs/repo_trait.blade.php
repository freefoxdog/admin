@php
    echo "<?php\n";
@endphp
/**
* Created by PhpStorm.
* User: apple GeneratorCommand
* Date: {{$DummyDate}}
* Time: {{$DummyTime}}
*/

namespace {{$DummyNamespace}};

use {{$DummyRootNamespace}}Storage\Storage;
trait {{$DummyClass}}
{
    public function __construct(\App\Storage\Database\{{$DummyDatabaseClass}} $persistence)
    {
        parent::__construct($persistence);
    }

    public function store(array $newData)
    {
        //todo  wirete new data login
@if(count($storeData))
        $model = $this->storage();
@foreach ($storeData as $property)
        $model->{{$property}}  =  $newData['{{$property}}'];
@endforeach
        return $this->save($model);
@else
        return false;
@endif
    }
    public function update(Storage $oldModel, array $updateData)
    {
        //todo  wirete update  data login
@if(count($updateData))
    @foreach ($storeData as $property)
    if(isset($updateData['{{$property}}']))
        $oldModel->{{$property}}  =  $updateData['{{$property}}'];
    @endforeach
        return $this->save($oldModel);
@else
        return false;
@endif
    }

}