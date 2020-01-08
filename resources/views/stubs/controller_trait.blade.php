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

use Illuminate\Http\Request;
use {{$DummyRootNamespace}}Repositories\{{$DummyRepositoryClass}};
trait {{$DummyClass}}
{
    public function __construct()
    {

        $this->repositoryClass = {{$DummyRepositoryClass}}::class;
    }

    protected  function storeData(Request $request)
    {
@if ( count($storeValidates) > 0 )
        $request->validate([
  @foreach ($storeValidates as $property=>$validate)
           '{{$property}}'=>'{{$validate}}',
  @endforeach
        ]);
@endif
        return [
@foreach ($storeInput as $property=>$inputConfig)
@switch($inputConfig['type'])
        @case(0)
        '{{$property}}'=>$request->input('{{$property}}'),
        @break
        @case(1)
        '{{$property}}'=>$request->input('{{$property}}' ,{!! $inputConfig['default']!!}),
        @break
        @case(2)
        '{{$property}}'=>\Illuminate\Support\Facades\Auth::id(),
        @break
    @endswitch
@endforeach
        ];

     }
    protected  function updateData(Request $request)
    {
@if ( count($updateValidates) > 0 )
        $request->validate([
    @foreach ($updateValidates as $property=>$validate)
            '{{$property}}'=>'{{$validate}}',
    @endforeach
        ]);
@endif
        return [
@foreach ($updateInput as $property=>$inputConfig)
    @switch($inputConfig['type'])
        @case(0)
                '{{$property}}'=>$request->input('{{$property}}'),
        @break
        @case(1)
                '{{$property}}'=>$request->input('{{$property}}' ,{!! $inputConfig['default']!!}),
        @break
        @case(2)
                '{{$property}}'=>\Illuminate\Support\Facades\Auth::id(),
        @break
    @endswitch
@endforeach
];

     }
}