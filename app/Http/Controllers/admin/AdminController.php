<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\ExportDatabaseJob;
use App\Models\Orders;
use App\Models\techniciansApplications;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class AdminController extends Controller
{
    public function index(Request $request, OrderService $orderService)
    {
        if ($request->ajax()) {
            return response()->json($orderService->getFilteredOrders($request));
        }
        $total = Orders::withoutGlobalScopes()->total()->count();
        $user = Auth::user();
        $newOrdersCount = Orders::countOrders();
        $teknisiCount = Orders::serviceCount();
        $teknisiList = User::where('role', 'teknisi')->get();
        return view('admin.index', compact('total', 'newOrdersCount', 'teknisiCount', 'teknisiList', 'user'));
    }

    public function show($id)
    {
        $order = Orders::with('user', 'teknisi', 'manageService')->withoutGlobalScopes()->findOrFail($id);
        return view('admin.show', compact('order'));
    }

    public function application()
    {
        $data = techniciansApplications::all();
        return view('admin.application', compact('data'));
    }

    public function show_application($id)
    {
        $data = techniciansApplications::find($id);
        return view('admin.show_application', compact('data'));
    }

    public function export()
    {
        try {
            Artisan::call('backup:run');
            dd(Artisan::output());

            return back()->with('success', 'Proses export database berhasil! File tersimpan di folder backup.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal export database: ' . $e->getMessage());
        }
    }


    public function import(Request $request)
    {

        $request->validate([
            'sql_file' => 'required|file|mimes:sql,txt'
        ]);

        $path = $request->file('sql_file')->getRealPath();
        $sql = file_get_contents($path);

        try {
            DB::unprepared($sql);
            return back()->with('success', 'Database berhasil diimport.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import database: ' . $e->getMessage());
        }
    }
}
