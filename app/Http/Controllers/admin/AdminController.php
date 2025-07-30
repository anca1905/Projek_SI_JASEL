<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;

class AdminController extends Controller
{
    public function index(){
        $data = Orders::withoutGlobalScopes()->get();
        return view('admin.index', compact('data'));
    }

    public function show($id){
        $order = Orders::with('user', 'teknisi', 'manageService')->withoutGlobalScopes()->findOrFail($id);
        return view('admin.show', compact('order'));
    }

    
}
