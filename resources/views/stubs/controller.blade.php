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

use {{$DummyRootNamespace}}Generator\Controllers\{{$DummyTraitClass}};

class {{$DummyClass}} extends Controller
{
    use RESTful,{{$DummyTraitClass}};




}
