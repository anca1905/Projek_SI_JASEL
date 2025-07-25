<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function proses(Request $request) {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->role == "admin") {
                return redirect()->route('adminadmin.index');
            } elseif ($user->role == 'teknisi') {
                return redirect()->route('teknisiservice.index');
            } else {
                return redirect()->route('pelanggan.index');
            }
        } else {
            return redirect()->route('auth.login')->with('failed', 'Email atau Password Salah');
        }
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('auth.login');
    }
}
