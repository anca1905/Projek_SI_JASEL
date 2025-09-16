<?php

namespace App\Http\Controllers\admin;

use App\Models\Orders;
use App\Exports\JasaExport;
use App\Exports\OrdersExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OrderService;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function report()
    {

        $services = Orders::serviceCount();
        $orders = Orders::with('user', 'teknisi', 'manageService')->withoutGlobalScopes()->get();
        $orderCount = Orders::withoutGlobalScopes()->where('status', 'selesai')->whereYear('finish_time', now()->year)->count();
        return view('admin.report.report', compact('services', 'orderCount', 'orders'));
    }

    public function orders(Request $request, OrderService $orderServices)
    {
        $orders = $orderServices->getFilteredOrders($request);
        $technicians = User::where('role', 'teknisi')->get();

        return view('admin.report.__order_report', compact('orders', 'technicians'));
    }

    public function income()
    {
        return view('admin.report.__income_report');
    }

    public function technicians()
    {
        return view('admin.report.__technician_performance_report');
    }

    public function popularServices()
    {
        return view('admin.report.__most_popular_services_report');
    }

    public function exportOrders(Request $request, $type)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $orders = Orders::with(['user', 'manageService', 'teknisi'])
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                $query->whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')]);
            })
            ->when($request->input('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->when($request->input('technician'), function ($query) use ($request) {
                $query->where('teknisi_id', $request->input('technician'));
            })
            ->withoutGlobalScopes()
            ->get();


        $fileName = 'laporan_pesanan_' . now()->format('Ymd_His');

        // mapping type ke handler
        $handlers = [
            'pdf' => fn() => Pdf::loadView(
                'admin.report.export.orders',
                [
                    'orders' => $orders,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                ]
            )->setPaper('a4', 'potrait')
                ->download($fileName . '.pdf'),

            'excel' => fn() => Excel::download(
                new JasaExport($orders),
                $fileName . '.xlsx'
            ),
        ];

        abort_unless(isset($handlers[$type]), 404, 'Format tidak dikenali');

        return $handlers[$type]();
    }
}
