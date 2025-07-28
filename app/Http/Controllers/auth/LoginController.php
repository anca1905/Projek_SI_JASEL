<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
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
                return redirect()->route('admin.admin.index');
            } elseif ($user->role == 'teknisi') {
                return redirect()->route('teknisi.incoming_orders');
            } else {
                return redirect()->route('costumer.make_an_order');
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
