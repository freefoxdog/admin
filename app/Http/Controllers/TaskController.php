<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 15:24:23
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\TaskControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    use RESTful,TaskControllerTrait;

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'search'=> 'nullable|string',
        ],[
            'search.string'=> '字符串',
        ]);
        if ($validator->errors()->first()){
            abort(404);
        }
        $search = $request->search?$request->search:null;
        $data = resolve($this->repositoryClass)->storage()->index($search);
        $result = array(
            'data' => $data,
            'search' => $search
        );
        return view('task.index', $result);
    }







}
