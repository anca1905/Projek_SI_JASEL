<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function store(AuthRequest $request) {

        $data = $request->validated();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil, silakan login.');
        
    }

    public function proses(LoginRequest $request) {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('web')->attempt($data)) {

            $user = Auth::guard('web')->user();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.admin.index');
            } elseif ($user->role === 'teknisi') {
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

        return redirect()->route('auth.login')->with('success', 'Anda telah logout.');
    }
}
