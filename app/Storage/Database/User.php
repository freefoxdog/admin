<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/09
 * Time: 15:38:06
 */

namespace App\Storage\Database;

use App\Storage\Database;
use App\Generator\Storage\Database\UserTrait;

class User extends Database
{
    use UserTrait;
    protected $table = 'users';
    //TODO please complete $fields
    protected $fields = [
        'id' => 'id',
        'name' => 'name',
        'mobile' => 'mobile',
        'password' => 'password',
        'pic' => 'pic',
        'identity' => 'identity',
        'grade' => 'grade',
        'fraction' => 'fraction',
        'remember_token' => 'rememberToken',
        'status' => 'status',
        'shara_code' => 'sharaCode',
        'parent_id' => 'parentId',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
    ];
    protected $fillable = [
        'name',
        'mobile',
        'password',
        'groupchat',
        'shara_code',
        'parent_id',
        'initial_id',
        'identity',
    ];

    public function index(array $w)
    {
        return $this->with('userInfo','account','flow')->with(['flow'=>function($query){
            $query->whereRaw('((flow_type = 2 and symbol = 1) or (flow_type = 7 and symbol = 2))');
        }])->orWhere($w[0])->orWhere($w[1])->orWhere($w[2])->whereIn('identity',[1,2])->paginate(config('sys.page_num'));
    }

    public function userInfo()
    {
        return $this->hasOne('App\Storage\Database\UserInfo','uid');
    }

    public function account()
    {
        return $this->hasOne('App\Storage\Database\Account','uid');
    }

    public function flow()
    {
        return $this->hasMany('App\Storage\Database\Flow','uid');
    }
    public function getGroup()
    {
        return $this->hasOne('App\Storage\Database\Groupchat','id','groupchat');
    }

    //
    public function getMerchantUser()
    {
        $w = array(
            'identity' => 3
        );
        return $this->withCount(['taskCancel'=>function($query){
            $query->whereIn('status',[8,9]);
        },'task'])->with('task')->where($w)->paginate(config('sys.page_num'));
    }

    public function task()
    {
        return $this->hasMany('App\Storage\Database\Task','send_uid');
    }
    public function taskCancel()
    {
        return $this->hasMany('App\Storage\Database\Task','send_uid');
    }

}