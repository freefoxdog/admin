<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/9
 * Time: 18:04
 */

namespace Fruits\Apple\Auth\Passwords;


use Illuminate\Database\Eloquent\Model;

class ResetEloquent extends  Model
{

    protected $table='password_resets';
    protected $dates = [
        'created_at',

    ];
    protected $dateFormat = 'U';
    const UPDATED_AT = null;
    public function getCreatedAtAttribute($value)
    {

        return $value;
    }

}