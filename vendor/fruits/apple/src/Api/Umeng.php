<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/12/24
 * Time: 17:24
 */

namespace Fruits\Apple\Api;


class Umeng
{
    protected $appkey = '';
    protected $appMasterSecret = '';
    protected $api = "http://msg.umeng.com";
    public function __construct($appkey, $appMasterSecret)
    {
        $this->appkey = $appkey;
        $this->appMasterSecret = $appMasterSecret;
    }
    public function send($type, $deviceTokens, $data)
    {
        $payload = $this->getPayload($type,$data);
        $postData = [];
        $postData['appkey'] = $this->appkey;
        $postData['timestamp'] = time();
        $postData['type'] = 'unicast';
        $postData['device_tokens'] =$deviceTokens;
        $postData['payload'] = $payload;
        $postData['production_mode'] = env('APP_ENV') == 'production'? true:false;
        $path = '/api/send';
        $url = $this->api.$path;
        $sign = $this->sign('POST',$url,$postData);

        $url .= "?sign={$sign}";

        $this->post($url,$postData);

    }
    protected function getPayload($type, $data)
    {
        switch ($type)
        {
            case 'ios':
                return $this->iosPayload($data);
            default:
                return $this->iosPayload($data);
        }
    }
    protected function iosPayload($data)
    {

        return [

            'aps'=>[
                'alert'=>[
                    "title"=>$data['title'],
                    "subtitle"=>$data['subtitle'],
                    "body"=>$data['body']

                ]
            ],
            'msgType'=>$data['msgType'],
            'param'=>$data['params'],

        ];
    }
    protected function sign($httpMethod,$url,$post)
    {



        $sign = md5($httpMethod.$url.json_encode($post). $this->appMasterSecret);
        return $sign;
    }
    protected  function post($url,$postData)
    {
        $client = new \GuzzleHttp\Client();
        $headers = ['Content-Type'=>'application/json'];


        try
        {
            $response  = $client->request('POST', $url,
                ['headers'=>$headers, 'verify' => false,
                    'json'=>$postData]);
            $body = $response->getBody();
            $body = (string)$body;


        }
        catch (\GuzzleHttp\Exception\ClientException $exception)
        {

            $body = (string)($exception->getResponse()->getBody());
        }




        $ret =  json_decode($body, true);




        if(!$ret)
            return false;

        if($ret['ret'] !='SUCCESS')
            return false;

        return $ret['data'];



    }
}