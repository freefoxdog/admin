<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 11:09:48
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\TransactionOrderControllerTrait;
use Illuminate\Http\Request;

class TransactionOrderController extends Controller
{
    use RESTful,TransactionOrderControllerTrait;

    public function index(Request $request)
    {
        if(!is_numeric($request->id)){
            abort(404);
        }
        $data = resolve($this->repositoryClass)->storage()->index($request->id);
        $result = [
            'data'=>$data,
            'id' => $request->id,
            ];
        return view('transactionOrder.index', $result);


    }


}
