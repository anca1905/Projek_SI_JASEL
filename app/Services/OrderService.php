<?php

namespace App\Services;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderService
{
    public function getFilteredOrders(Request $request)
    {
        $query = Orders::with(['user', 'teknisi', 'manageService'])
            ->withoutGlobalScopes();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('technician')) {
            $query->where('teknisi_id', $request->technician);
        }

        return $query->get();
    }
}
