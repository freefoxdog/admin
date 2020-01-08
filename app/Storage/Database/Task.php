<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/10
 * Time: 15:24:23
 */

namespace App\Storage\Database;

use App\Events\NoticeUser;
use App\Repositories\UserRepository;
use App\Storage\Database;
use App\Generator\Storage\Database\TaskTrait;

class Task extends Database
{
    use TaskTrait;
    protected $table = 'tasks';
    //TODO please complete $fields
    protected $fields = [
        'id' => 'id',
        'send_uid' => 'sendUid',
        'num' => 'num',
        'price' => 'price',
        'money' => 'money',
        'status' => 'status',
        'repeat_num' => 'repeatNum',
        'efffet_at' => 'efffetAt',
        'uid' => 'uid',
        'pay' => 'pay',
        'task_at' => 'taskAt',
        'complaints_at' => 'complaintAt',
        'get_money_at' => 'getMoneyAt',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
        'deleted_at' => 'deletedAt',
    ];
    protected const ORDER_GANERATE = 1;//生成订单
    protected const ORDER_RECEIPT = 2;//用户接单
    protected const ORDER_NORECEIPT = 3;//订单过期
    protected const ORDER_PAYMONEY = 4;//商户已付款
    protected const ORDER_PAYCURRENCY = 5;//用户已付币
    protected const ORDER_NO_PAYMONEY = 6;//商户付币异常
    protected const ORDER_NO_PAYCURRENCY = 7;//用户付币异常
    protected const ORDER_PAY_MONEY_CANCEL = 8;//商户超时未付钱，取消
    protected const ORDER_CANCEL = 9;//商户主动取消

    public function index($search = '')
    {
        $where_order = array();
        $where_send = array();
        $where_uid = array();
        if ($search){
            $where = array(
                array('name', 'like', '%'.$search.'%'),
            );
            $name = resolve(UserRepository::class)->storage()->where($where)->first();
            if ($name){
                $where_send = array(
                    'send_uid' => $name->id
                );
                $where_uid = array(
                    'uid' => $name->id
                );
            }
            $where_order = array(
                'order' => $search
            );
        }


        return $this->with('user','sendUser')->orWhere($where_order)->orWhere($where_send)->orWhere($where_uid)->orderBy('created_at','desc')->paginate(config('sys.page_num'));
    }
    public function user()
    {
        return $this->belongsTo('App\Storage\Database\User','uid','id');
    }
    public function sendUser()
    {
        return $this->belongsTo('App\Storage\Database\User','send_uid','id');
    }

    //获取买家账户信息 -
    public function getBuyAccount()
    {
        return $this->hasOne('App\Storage\Database\Account','uid','send_uid');

    }

    //获取买家账户信息 -
    public function getSellAccount()
    {
        return $this->hasOne('App\Storage\Database\Account','uid','uid');

    }

    //修改订单状态--用户确定付币
    public  function setPayCurrency(Task $task)
    {
        $task->status = self::ORDER_PAYCURRENCY;
        $task->get_currency_at = time();
        $ret = $task->save();
        if ($ret){
            //修改账户获得的币总数
            $acc = $task->getSellAccount;
            $total = bcadd($acc->task, $task->num,2);
            $acc->task = $total;
            $acc->save();
            //修改等级
            $grade = $this->comGrade($total);
            $user = $task->user;
            if ($user->grade !== (int)$grade){
                $user->grade = $grade;
                $ret = $user->save();
                $content = array(
                    'type'=>'user_nocite_1',
                    'grade' => $grade,
                    'content' => '恭喜您，等级提升至'.$grade,    //通知内容
                    'time' => '',    //通知时间 -时间戳
                );
                event(new NoticeUser($content,'SYS',$user->uid));
            }
            return true;
        }
        return false;
    }
    public function comGrade($total)
    {
        $grade_num = config('gradeNum');
        $count = count($grade_num);
        $key = 0;
        foreach ($grade_num as $k=>$v){
            if($k == 1){
                if (bccomp($v, $total, 0)){
                    break;
                }
            }elseif ($k>1 && $k< $count){
                if ($v>$total && $v< $grade_num[$k+1]){
                    $key = $k;
                    break;
                }

            } else{
                $key = $count;
            }
        }
        return $key;
    }


    public function getUsePayAttribute($value)
    {
        $pay = config('sys.pay');
        $list = json_decode($value, true);
        $str = '';
        foreach ($list as $v){
            $str .= $pay[$v].'，';
        }
        $str = trim($str,',');
        return $str;
    }

    //商户超时取消订单
    public function setPayMoneyCancel(Task $task, $currency_num)
    {
        $task->status = self::ORDER_PAY_MONEY_CANCEL;
        $task->cancel_at = time();
        $task->cancel_reward = $currency_num;
        return $task->save();

    }

}