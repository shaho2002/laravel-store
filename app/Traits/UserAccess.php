<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth ;

trait UserAccess
{
    public function isSuperAdmin()
    {
        $user = Auth::user();
        return $user->id===1||$user->isAdmin||$user->hasRole('مدیرکل');
    }
    public function isUserAdmin()
    {
        $user = Auth::user();
        return $user->isSuperAdmin()||$user->hasRole('مدیر کاربران');
    }
     public function isShopeAdmin()
    {
        $user = Auth::user();
        return $user->isSuperAdmin()||$user->hasRole('مدیر فروشگاه');
    }
}
