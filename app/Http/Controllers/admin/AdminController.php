<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Orders::with('user', 'teknisi', 'manageService')->withoutGlobalScopes()->get();
            return response()->json($data);
        }
        $total = Orders::withoutGlobalScopes()->total()->count();
        $data = Orders::withoutGlobalScopes()->get();
        $newOrdersCount = Orders::countOrders();
        $teknisiCount = Orders::serviceCount();
        return view('admin.index', compact('total', 'newOrdersCount', 'teknisiCount', 'data'));
    }

    public function show($id)
    {
        $order = Orders::with('user', 'teknisi', 'manageService')->withoutGlobalScopes()->findOrFail($id);
        return view('admin.show', compact('order'));
    }
}
