<?php

namespace App\Traits;

trait AdminTraits
{
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTechnician($user)
    {
        return $user->role === 'technician';
    }

    public function isCustomer($user)
    {
        return $user->role === 'customer';
    }
}