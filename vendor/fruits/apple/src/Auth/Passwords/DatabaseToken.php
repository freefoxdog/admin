<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/9
 * Time: 17:55
 */

namespace Fruits\Apple\Auth\Passwords;


use Illuminate\Auth\Passwords\TokenRepositoryInterface;

use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class DatabaseToken implements TokenRepositoryInterface
{
    /**
     * The number of seconds a token should last.
     *
     * @var int
     */
    protected $expires;
    /**
     * @var  \Illuminate\Database\Eloquent\Model
     */
    protected $model;
   public function __construct($config)
   {

       $this->expires = $config['expire'];
       $this->model = new ResetEloquent();
   }
    public function createNewToken()
    {
        $num = 6;
        $ret = [];
        for($i=0; $i<$num; $i++)
        {
            $ret[]= rand(0,9);
        }

        return implode("",$ret);
    }
    /**
     * Create a new token.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @return string
     */
    public function create(CanResetPasswordContract $user)
    {
        $mobile = $user->getMobileForPasswordReset();

        $model = ResetEloquent::where('mobile', $mobile)->first();
        if($model)
        {
            $model->delete();
        }


        // We will create a new, random token for the user so that we can e-mail them
        // a safe link to the password reset form. Then we will insert a record in
        // the database so that we can verify the token within the actual reset.
        $token = $this->createNewToken();



        $this->saveToken($mobile, $token);
        //$this->getTable()->insert($this->getPayload($email, $token));

        return $token;
    }

    /**
     * Determine if a token record exists and is valid.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $token
     * @return bool
     */
    public function exists(CanResetPasswordContract $user, $token)
    {


        $record = ResetEloquent::where('mobile', $user->getMobileForPasswordReset())->where('token',$token)->first();

        return $record &&
            ! $this->tokenExpired($record['created_at']);
    }
    protected function tokenExpired($createdAt)
    {

        return $createdAt + $this->expires <= time() ? true:false;
    }
    /**
     * Delete a token record.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @return void
     */
    public function delete(CanResetPasswordContract $user)
    {

        return  ResetEloquent::where('mobile', $user->getMobileForPasswordReset())->first()->delete();
       // return $user->delete();
    }

    /**
     * Delete expired tokens.
     *
     * @return void
     */
    public function deleteExpired()
    {

    }
    protected function saveToken($mobile, $token)
    {

        $model  = new ResetEloquent();
        $model->token = $token;
        $model->mobile = $mobile;
        $model->save();
    }
    protected function deleteExisting( $mobile)
    {
        return $this->getTable()->where('mobile',$mobile)->delete();
    }

}
