<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 11:09:36
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\TransactionControllerTrait;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use RESTful,TransactionControllerTrait;

    public function index(Request $request)
    {
        $w = array(
            array(),
            array(),
        );
        if ($request->search && is_string($request->search)){
            $w = array(
                array(
                    'uid' => $request->search
                ),
                array(
                    'order_id' => $request->search
                ),
            );
        }
        $data = resolve($this->repositoryClass)->storage()->index($w);
        $result = array(
            'data' => $data,
            'search' => $request->search?$request->search:'',
        );

        return view('transaction.index',$result);
    }


}
