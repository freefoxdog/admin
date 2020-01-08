<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 15:03:29
 */

namespace App\Generator\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ComplaintRepository;
trait ComplaintControllerTrait
{
    public function __construct()
    {

        $this->repositoryClass = ComplaintRepository::class;
    }

    protected  function storeData(Request $request)
    {
        return [
        'complaintId'=>$request->input('complaintId'),
                'uid'=>$request->input('uid'),
                'type'=>$request->input('type'),
                'order'=>$request->input('order'),
                'content'=>$request->input('content'),
                'pic'=>$request->input('pic'),
                'isHand'=>$request->input('isHand'),
                'handContent'=>$request->input('handContent'),
                ];

     }
    protected  function updateData(Request $request)
    {
        return [
                    'type'=>$request->input('type'),
        ];

     }
}