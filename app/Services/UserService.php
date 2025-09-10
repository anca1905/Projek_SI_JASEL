<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getFilterUsers($request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $cari = $request->search;
            $query->where(function ($q) use ($cari) {
                $q->where('name', 'like', '%' . $cari . '%')
                    ->orWhere('email', 'like', '%' . $cari . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        return $query->paginate(5)->appends($request->only('search', 'role'));
    }
}
