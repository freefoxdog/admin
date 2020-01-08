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

use {{$DummyRootNamespace}}Storage\Database;
use {{$DummyRootNamespace}}Generator\Storage\Database\{{$DummyTraitClass}};

class {{$DummyClass}} extends Database
{
    use {{$DummyTraitClass}};
    protected $table = '{{$tableName}}';
    //TODO please complete $fields
    protected $fields = [
    @foreach($fieldsData as $field=>$property)
    '{{$field}}' => '{{$property}}',
    @endforeach
];

}