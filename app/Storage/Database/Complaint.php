<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 15:03:29
 */

namespace App\Storage\Database;

use App\Storage\Database;
use App\Generator\Storage\Database\ComplaintTrait;

class Complaint extends Database
{
    use ComplaintTrait;
    protected $table = 'complaints';
    //TODO please complete $fields
    protected $fields = [
        'id' => 'id',
        'complaint_id' => 'complaintId',
        'uid' => 'uid',
        'type' => 'type',
        'order' => 'order',
        'content' => 'content',
        'pic' => 'pic',
        'is_hand' => 'isHand',
        'hand_content' => 'handContent',
        'hand_at' => 'handAt',
        'hand_uid' => 'handUid',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
    ];
    protected $fillable = [
        'is_hand',
        'hand_content',
        'hand_at',
        'hand_uid',
        'hand_order'
    ];

    public function index($order = null)
    {
        $w = array();
        if ($order){
            $w = array(
                'order' => $order
            );
        }
        return $this->with('user','task','transactionOrder')->where($w)->orderBy('created_at','desc')->paginate(config('sys.page_num'));
    }

    public function user()
    {
        return $this->belongsTo('App\Storage\Database\User','uid','id');
    }
    public function task()
    {
        return $this->hasOne('App\Storage\Database\Task','order','order');
    }
    public function transactionOrder()
    {
        return $this->hasOne('App\Storage\Database\TransactionOrder','order_id','order');

    }
    public function adminUser()
    {
        return $this->belongsTo('App\Storage\Database\AdminUser','hand_uid','id');

    }




    public function getPicAttribute($value)
    {
        return json_decode($value,true);
    }


}