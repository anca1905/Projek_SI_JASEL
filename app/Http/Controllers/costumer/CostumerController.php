<?php

namespace App\Http\Controllers\costumer;

use App\Http\Controllers\Controller;
use App\Models\ManageServices;
use App\Models\Orders;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ManageServices::all();
        return view('costumer.make_an_order', compact('data'));
    }

    public function orderHistory()
    {
        $orders = Orders::where('user_id', auth()->id())
            ->with(['user', 'teknisi', 'manageService'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'No orders found.');
        }
        return view('costumer.order_history', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data['user_id'] = auth()->id();
        $data['service_type'] = $request->service_type;
        $data['teknisi_id'] = null;
        $data['device_problem'] = $request->device_problem;
        $data['address'] = $request->address;
        $data['appointment_date'] = $request->appointment_date;

        Orders::create($data);

        return redirect()->route('costumer.order_history')->with('success', 'Order has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
