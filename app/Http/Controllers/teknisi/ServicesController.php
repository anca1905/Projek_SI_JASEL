<?php

namespace App\Http\Controllers\teknisi;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManageServices;
use App\Models\Orders;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('teknisi.index');
    // }

    public function myOrders()
    {
        $orders = Orders::orderStatus()->get();
        return view('teknisi.myOrders', compact('orders'));
    }

    public function incomingOrders()
    {
        $order = Orders::all();
        return view('teknisi.incomingOrders', compact('order'));
    }

    public function takeOrder($id)
    {
        $order = Orders::findOrFail($id);
        $order->teknisi_id = auth()->user()->id; 
        $order->status = 'diproses'; 
        $order->save();

        return redirect()->route('teknisi.my_orders')->with('success', 'Order has been taken successfully.');
    }

    public function complete($id) {
        $order = Orders::withoutGlobalScopes()->findOrFail($id);
        $order->status = 'selesai'; 
        $order->finish_time = now()->format('Y-m-d');
        $order->save();

        return redirect()->route('teknisi.my_orders')->with('success', 'Order has been marked as completed.');
    }

    public function cancel($id)
    {
        $order = Orders::withoutGlobalScopes()->findOrFail($id);
        $order->status = 'menunggu_konfirmasi'; 
        $order->teknisi_id = null; // Clear the technician assignment
        $order->save();

        return redirect()->route('teknisi.my_orders')->with('success', 'Order has been cancelled successfully.');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Orders::withoutGlobalScopes()->findOrFail($id);
        return view('teknisi.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services)
    {
        //
    }
}
