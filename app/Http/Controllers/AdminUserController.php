<?php
/**
 * Created by PhpStorm.
 * User: apple GeneratorCommand
 * Date: 2019/10/11
 * Time: 14:06:28
 */
namespace App\Http\Controllers;

use App\Generator\Controllers\AdminUserControllerTrait;
use App\Repositories\AdminUserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    use RESTful,AdminUserControllerTrait;

    public function passEdit()
    {

        return view('admin.passEdit');
    }

    public function passWord(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'oldpassword' => 'required|string',
            'newpassword' => 'required|confirmed|min:6|max:12|string',
        ],[
            'oldpassword.required' => '请输入旧密码',
            'oldpassword.string' => '密码类型错误',
            'newpassword.required' => '请输入新密码',
            'newpassword.confirmed' => '请确认密码',
            'newpassword.min' => '新密码长度为6-12',
            'newpassword.max' => '新密码长度为6-12',
            'newpassword.string' => '新密码类型错误',
        ])->validate();
        $user = resolve(User::class)->find(Auth::id());
        if (!Hash::check($request->input('oldpassword'),$user->password)){
            return back()->with('error', '密码错误');
        }
        $user->password = Hash::make($request->input('newpassword'));
        $ret = $user->save();
        if (!$ret){
            return back()->with('error', '修改失败');
        }
        return redirect()->route('admin.eidt')->with('suucess','密码修改成功');

    }

    public function create()
    {
        return view('admin.addshow');
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'name' => 'required|string|min:2|max:20',
            'password' => 'required|confirmed|min:6|max:12|string',
            'type' => 'required|in:1,2',
        ],[
            'name.required' => '用户名必填',
            'name.string' => '密码类型错误',
            'password.required' => '请输入新密码',
            'password.confirmed' => '请确认密码',
            'password.min' => '密码长度为6-12',
            'password.max' => '密码长度为6-12',
            'password.string' => '密码类型错误',
            'type.required' => '请选择类型',
            'type.in' => '类型错误',
        ])->validate();
        $data = array(
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'idType' => $request->input('type'),
        );
        $ret = resolve($this->repositoryClass)->store($data);
        if (!$ret){
            return back()->withInput()->with('error', '添加失败！');
        }
        return redirect()->route('admin.create')->with('success','添加成功');

    }

    public function index(Request $request)
    {
        $data = resolve(AdminUserRepository::class)->storage()->withTrashed()->paginate(config('sys.page_num'));
        $result = array(
            'data' => $data
        );
        return view('admin.index', $result);
    }

    public function destroy($id)
    {
        $data = '';
        $validate = Validator::make(['id' => $id],[
            'id' => [
                function($attribute, $value, $fail) use (&$data)
                {
                    $data = resolve(AdminUserRepository::class)->storage()->find($value);
                    if (!$data){
                        $fail('用户不存在或已被禁用！');
                    }elseif ($data->name == 'root'){
                        $fail('root用户不能被禁止使用！');
                    }
                }
            ],
        ])->validate();
        $ret = $data->delete();
        if ($ret){
            $result  = '禁用成功！';
        }else{
            $result  = '禁用失败！';
        }
        return back()->with('result', $result);
    }

    public function startUser($id)
    {
        $data = '';
        $validate = Validator::make(['id' => $id],[
            'id' => [
                function($attribute, $value, $fail) use (&$data)
                {
                    $data = resolve(AdminUserRepository::class)->storage()->withTrashed()->find($value);
                    if (!$data){
                        $fail('用户不存！');
                    }elseif ($data->deleted_at == ''){
                        $fail('用户启用中！');
                    }
                }
            ],
        ])->validate();
        $ret = $data->restore();
        if ($ret){
            $result  = '启用成功！';
        }else{
            $result  = '启用失败！';
        }
        return back()->with('result', $result);
    }

}
