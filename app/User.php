<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Fruits\Apple\Auth\Passwords\CanResetPassword;
use Fruits\Apple\Channels\NotificationFor;

class User extends Authenticatable
{
    use Notifiable,NotificationFor,CanResetPassword;

    protected $table = 'admin_users';
    protected $dateFormat = 'U';
    public $apiToken;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setGoogle2fa()
    {
        $google2fa = app('pragmarx.google2fa');
        $this->google2fa_secret = $google2fa->generateSecretKey();
        $this->google2fa_enable = 0;
        $this->save();
    }
}
