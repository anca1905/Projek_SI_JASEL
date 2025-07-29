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
        return view('teknisi.myOrders');
    }

    public function incomingOrders()
    {
        $order = Orders::where('status', 'menunggu_konfirmasi')->get();
        return view('teknisi.incomingOrders', compact('order'));
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
        $order = Orders::findOrFail($id);
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
