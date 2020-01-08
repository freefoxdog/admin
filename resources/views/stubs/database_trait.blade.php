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

trait {{$DummyClass}}
{
    @if( $softDelete )
use \Illuminate\Database\Eloquent\SoftDeletes;
    @endif

@foreach($relation as $funName=>$methodDefine)
    public function {{$funName}}()
    {
        return $this->{{$methodDefine['fun']}}(@if($methodDefine['class']){{$methodDefine['class']}}@endif @if($methodDefine['arg1']), '{{$methodDefine['arg1']}}'@endif @if($methodDefine['arg2']), '{{$methodDefine['arg2']}}'@endif @if($methodDefine['arg3']), '{{$methodDefine['arg3']}}'@endif);

    }

@endforeach

}