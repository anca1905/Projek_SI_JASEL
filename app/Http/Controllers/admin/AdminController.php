<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;

class AdminController extends Controller
{
    public function index()
    {
        $data = Orders::withoutGlobalScopes()->get();
        $total = Orders::withoutGlobalScopes()->where('status', 'selesai')
            ->orWhere('status', 'diproses')
            ->count();

        $newOrdersCount = Orders::countOrders();
        $teknisiCount = Orders::serviceCount();
        return view('admin.index', compact('data', 'total', 'newOrdersCount', 'teknisiCount'));
    }

    public function show($id)
    {
        $order = Orders::with('user', 'teknisi', 'manageService')->withoutGlobalScopes()->findOrFail($id);
        return view('admin.show', compact('order'));
    }
}
