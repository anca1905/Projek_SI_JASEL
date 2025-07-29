<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $cari = $request->search;
            $query->where(function ($q) use ($cari) {
                $q->where('name', 'like', '%' . $cari . '%')
                    ->orWhere('email', 'like', '%' . $cari . '%');
            });

            if ($request->filled('role')) {
                $query->where('role', $request->role);
            }
        }

        $users = $query->paginate(5)->appends($request->only('search', 'role'));

        return view('admin.kelola_user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_user.__create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        if ($request->role) { 
            $data['role'] = $request->role;
        } else {
            $data['role'] = 'pelanggan';
        }

        User::create($data);

        return redirect()->route('admin.adminuser.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('adminuser.index')->with('error', 'User tidak ditemukan!');
        }
        return view('admin.kelola_user.__edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $find = User::find($id);

        $data = $request->validated();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $data['role'] = $request->role;
        $find->update($data);

        return redirect()->route('admin.adminuser.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);

        if (!$data) {
            return redirect()->route('admin.adminuser.index')->with('error', 'User tidak ditemukan!');
        }

        $data->delete();

        return redirect()->route('admin.adminuser.index')->with('success', 'User berhasil dihapus!');
    }
}
