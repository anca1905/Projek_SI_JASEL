<?php

namespace App\Traits;

trait AdminTraits
{
    public function isAdmin($user)
    {
        return $user->role === 'admin';
    }

    public function isTechnician($user)
    {
        return $user->role === 'teknisi';
    }

    public function isCustomer()
    {
        return $this->role === 'pelanggan';
    }
}