<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserService $userService)
    {
        $users = $userService->getFilterUsers($request);
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
    public function store(UserRequest $request, UserService $userService)
    {
        $data = $request->validated();

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
        $this->authorize('update', User::findOrFail($id));
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('adminuser.index')->with('error', 'User tidak ditemukan!');
        }
        return view('admin.kelola_user.__edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id, UserService $userService)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

        $data['password'] = $data['password'] ? $data['password'] : $user->password;

        $user->update($data);

        return redirect()->route('admin.adminuser.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $this->authorize('delete', $data);

        if (!$data) {
            return redirect()->route('admin.adminuser.index')->with('error', 'User tidak ditemukan!');
        }

        $data->delete();

        return redirect()->route('admin.adminuser.index')->with('success', 'User berhasil dihapus!');
    }
}
