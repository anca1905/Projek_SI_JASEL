<?php

namespace App\Services;

use App\Models\ManageServices;
use App\Models\Orders;
use Illuminate\Http\Request;

class JasaServices
{
    public function getFilteredServices(Request $request)
    {
        $data = ManageServices::query();

        if ($request->has('search')) {
            $search = $request->search;
            $data->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
        return $data->get();
    }
}
