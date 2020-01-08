<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/18
 * Time: 20:21
 */

namespace App\Http\Controllers\ApiAuth;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Fruits\Apple\Verification\Mobile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends  Controller
{

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        $code = $request->input('code');
        $mobile =  $request->input('mobile');

        $verification = new Mobile($mobile,Mobile::TYPE_REG);
        if($verification->check($code)){
            $verification->clean();
            $this->create($request->all());
            return response()->apiReturn([__('register.success')]);
        }else{
            return response()->apiReturn([__('register.codeFail')],0,'', 419);
        }

    }
    public function verification(Request $request)
    {
        $mobile = $request->input('mobile');
        $config = config('auth.guards.api');
        $provider = Auth::createUserProvider($config['provider']);
        $credentials = ['mobile'=>$mobile];
        $user = $provider->retrieveByCredentials($credentials);
        if(!$user)
        {
            $verification = new Mobile($mobile,Mobile::TYPE_REG);
            $verification->generate();
            $verification->send();

            return response()->apiReturn([__('register.sentCode')]);
        }
        else {
            return response()->apiReturn([__('register.exist')],417,'',417);
        }
    }
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['mobile'],
            'mobile' => $data['mobile'],
            'email' => $data['mobile'],
            'password' => Hash::make($data['password']),

        ]);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => 'required|string|max:255',
            'code' => 'required|int',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}