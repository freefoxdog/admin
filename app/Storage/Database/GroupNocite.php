<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/12
 * Time: 09:45:39
 */

namespace App\Storage\Database;

use App\Storage\Database;
use App\Generator\Storage\Database\GroupNociteTrait;

class GroupNocite extends Database
{
    use GroupNociteTrait;
    protected $table = 'group_nocites';
    //TODO please complete $fields
    protected $fields = [
        'id' => 'id',
        'uid' => 'uid',
        'content' => 'content',
        'read_num' => 'readNum',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
        'deleted_at' => 'deletedAt',
    ];
    public function index()
    {
        return $this->with('user','group')->orderBy('created_at','desc')->paginate(config('sys.page_num'));
    }

    public function user()
    {
        return $this->belongsTo('App\Storage\Database\User','uid','id');
    }

    public function group()
    {
        return $this->belongsTo('App\Storage\Database\Groupchat','group_id','id');
    }

}