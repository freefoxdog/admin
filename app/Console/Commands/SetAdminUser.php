<?php

namespace App\Console\Commands;

use App\Repositories\AdminUserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:set_admin_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建超级用户';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = 'root';
        $password = '123456';
        $result = resolve(AdminUserRepository::class)->storage()->where('name',$name)->first();
        if ($result){
            $this->info('超级用户已存在！');
            return true;
        }
        $data = array(
            'name' => $name,
            'password' => Hash::make($password),
            'pic' => '',
            'id_ype' => 1,
        );
        $ret = resolve(AdminUserRepository::class)->storage()->create($data);
        if ($ret){
            $this->info("用户创建成功！用户名：$name 密码：$password");
        }else{
            $this->info('创建失败！');
        }

    }
}
