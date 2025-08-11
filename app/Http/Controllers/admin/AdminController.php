<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\techniciansApplications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $newOrdersCount = Orders::countOrders();
        $teknisiCount = Orders::serviceCount();
        return view('admin.index', compact('total', 'newOrdersCount', 'teknisiCount', 'data', 'user'));
    }

    public function show($id)
    {
        $order = Orders::with('user', 'teknisi', 'manageService')->withoutGlobalScopes()->findOrFail($id);
        return view('admin.show', compact('order'));
    }

    public function application(){
        $data = techniciansApplications::all();
        return view('admin.application', compact('data'));
    }

    public function show_application($id){
        $data = techniciansApplications::find($id);
        return view('admin.show_application', compact('data'));
    }
}
