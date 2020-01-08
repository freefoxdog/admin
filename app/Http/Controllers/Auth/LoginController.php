<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Google2fa;
use App\Repositories\UserRepository;
use App\Storage\Database\AdminUser;
use App\Storage\Database\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'name';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'number' => [
                'bail',
                'nullable',
            ],
        ]);
        $this->vargoole($request);
    }

    public function vargoole(Request $request)
    {
        $name = $request->name;
        $w = [
            'name' => $name
        ];
        $user = resolve(AdminUser::class)->where($w)->first();
        if (!$user){
            throw ValidationException::withMessages([
                'name' => ['用户名或密码错误'],
            ]);
        }

        if ($user->google2fa_enable){
            $valid =  resolve(UserRepository::class)->VerGoogle($user, $request->input('number'));
            if (!$valid){
                //验证失败
                throw ValidationException::withMessages([
                    'number' => ['动态密码错误'],
                ]);
            }
        }
    }



    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    public function validGoogle(Request $request)
    {
        $user = $this->guard()->user();
        if ($user->google2fa_enable){
            $valid =  resolve(UserRepository::class)->VerGoogle($this->guard()->user(), $request->number);
            if (!$valid){
                //验证失败
                throw ValidationException::withMessages([
                    'number' => ['动态密码错误'],
                ]);
            }
        }else{
            //未绑定，跳转到绑定页面
        }





    }





}
