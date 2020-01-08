<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/09
 * Time: 17:26:25
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\FlowControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlowController extends Controller
{
    use RESTful,FlowControllerTrait;


    public function store(Request $request)
    {

    }

}
