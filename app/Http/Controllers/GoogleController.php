<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Google2fa;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{


    public function show()
    {
        $user = Auth::guard('web')->user();
        if (!$user->google2fa_secret){
            $user->setGoogle2fa();
        }


        $google2fa = app('pragmarx.google2fa');
        $google2fa_url = $google2fa->getQRCodeInline(
            $user->id,
            $user->name,
            $user->google2fa_secret
        );
        $data = array(
            'user' => $user,
            'google2fa_url' => $google2fa_url,
        );
        return view('google2fa.index')->with('data',$data);
    }


    public function enable2fa(Request $req, UserRepository $userRepository)
    {
        $user = Auth::guard('web')->user();;
        $secret = $req->input('one_time_password');
        $valid = $userRepository->VerGoogle($user, $secret);
        if ($valid){
            $user->google2fa_enable = 1;
            $user->save();
            return redirect()->route('index');
        }
        return back()->with([
            'error' => '验证错误',
        ]);
    }
}
