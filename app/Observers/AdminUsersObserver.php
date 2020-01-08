<?php

namespace App\Observers;

use App\Storage\Database\AdminUser;

class AdminUsersObserver
{
    public function created(AdminUser $user)
    {
//        $user->setGoogle2fa();
    }
}
