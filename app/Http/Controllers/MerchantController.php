<?php

namespace App\Http\Controllers;

use App\Repositories\GroupchatRepository;
use App\Repositories\RedPacketRepository;
use App\Storage\Database\Account;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;

use App\Storage\Database\RedPacket;
use Faker\Factory;
use Illuminate\Console\Command;


class MerchantController extends Controller
{
    //获取商户统计
    public function merchant(Request $request)
    {
        $data = resolve(UserRepository::class)->storage()->getMerchantUser();
        $result = array(
            'data' => $data
        );
        return view('merchant.merchant', $result);
    }
    
    //增加商户
    public function create()
    {
        $data = resolve(GroupchatRepository::class)->storage()->get();
        $result = array(
            'data' => $data,
        );
        return view('merchant.create',$result);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'bail|required|string|max:30',
            'mobile' => 'bail|required',
            'rand' => 'bail|required|string|max:32|min:6',
            'group' => 'bail|required|exists:groupchats,id',
            'url' => 'bail|required|url',
        ],[
            'name.required' => '商户名必填',
            'name.string' => '商户名必须为字符串',
            'name.max' => '商户名长度小于30',
            'mobile.required' => '联系方式必填',
            'rand.required' => '校验字串必填',
            'rand.string' => '校验字必须为字符串',
            'rand.max' => '校验字长度需小于32个字符',
            'rand.min' => '校验字长度需大于6个字符',
            'group.required' => '请选择群',
            'group.exists' => '群不存在',
            'url.url' => '请填写正确的url',
        ])->validate();
        $data = array(
            'name' => $request->name,
            'mobile' => $request->mobile,
            'password' => $request->rand,
            'groupchat' => $request->group,
            'shara_code'=>'',
            'parent_id' => 0,
            'initial_id' => 0,
            'identity' => 3,
        );
        $ret =  resolve(UserRepository::class)->storage()->create($data);
        $result = '添加失败！';
        if ($ret){
            $red_data = array(
                'app_id' => $ret->id,
                'service' => $request->rand,
                'url' => $request->url,
            );
            $ret_add = resolve(RedPacketRepository::class)->storage()->create($red_data);
            //添加账户
           $acc = new Account();
           $acc->uid = $ret->id;
           $acc->save();

            $result = '添加成功！';
        }
        return back()->with('result', $result);
    }


    public function sendRed()
    {
        return view('merchant.sendRed');
    }

    //发送红包
    public function send(Request $request)
    {
        $url = 'http://0.0.0.0/api/task/add';
        $appid = $request->input('appid');
        $type = 1;
        $pay = $request->input('pay');
        $num = $request->input('num');
        $user = $this->getUser($appid);
        if (!$user){
            $this->info('商户不存在');
            echo '商户不存在！';
            return false;
        }
        if ($type == 1){//生成订单
            $data = $this->stores($user, $appid, $num, $pay);
            $result = $this->curl($url, $data, 'POST');
        }
        if ($result){
            echo $result;
        }else{
            echo '错误！';
        }
    }


    public function getUser($id)
    {
        $w = array(
            'app_id' => $id
        );
        return resolve(RedPacket::class)->where($w)->first();
    }

    //新增红包
    public function stores(RedPacket $redPacket, $appid, $num, $pay)
    {
        $data_packet = array(
            'app_id' => $appid,
            'num' => $num,
            'time' => time(),
            'rand' => Factory::create()->regexify("[0-9A-Za-z]{32}"),
            'pay' => $pay,
            'service' => $redPacket->service,
        );
        $data_packet['sign'] = $this->sign($data_packet);
        return $data_packet;
    }

    public function sign($data)
    {
        if (!$data || !is_array($data)){
            return false;
        }
        asort($data,SORT_STRING);
        $str = '';
        foreach ($data as $k=>$v){
            $str.= $k.$v;
        }
        return md5($str);
    }

    public function curl($url, $data,$method= 'GET')
    {
        $curl = curl_init();
        if ($method == "GET") {
            $str = $url . '?';
            $url = $url . '?' . http_build_query($data);
        }
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        if ($method == "POST"){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt ( $curl ,  CURLOPT_POSTFIELDS ,  $data );
        }
        $ret = curl_exec($curl);
        curl_close($curl);
        return $ret;
    }



}
