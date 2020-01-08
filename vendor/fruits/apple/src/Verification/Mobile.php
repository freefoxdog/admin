<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/18
 * Time: 18:45
 */

namespace Fruits\Apple\Verification;


use Illuminate\Support\Facades\Redis;
use Fruits\Apple\Guest;
use Fruits\Apple\Notifications\Verification;

class Mobile
{

    const TYPE_REG = 'register';
    const TYPE_RESET = 'passwords';

    protected $mobile = '';
    protected $type = '';
    protected $code = '';

    protected $bit;

    public function __construct($mobile, $type = '', $bit = 6)
    {

        $this->mobile = $mobile;
        $this->bit = $bit;
        $this->type = $type;

    }

    public function generate()
    {
        $start = pow(10, $this->bit - 1);
        $end = pow(10, $this->bit) - 1;
        $this->code = rand($start, $end);
        $this->save();
        return $this->code;
    }

    public function save()
    {
        Redis::set($this->getStoreKey(), $this->code, 'ex', config('app.verificationTTL'));
    }
    public function check($inputCode)
    {
        $key = $this->getStoreKey();
        $code = Redis::get($key);
        if($code != $inputCode)
            return false;


        return true;
    }
    public function clean()
    {
        Redis::del($this->getStoreKey());
    }
    public function send()
    {


       // $notification = new Verification(__($this->type.'.verification', [ 'code' => $this->code]));
        $notification = new Verification($this->code);

        $guest = new Guest();
        $guest->mobile = $this->mobile;
        $guest->notify($notification);
    }

    protected function getStoreKey()
    {

        return "verification:mobile:{$this->mobile}:{$this->type}";
    }


}