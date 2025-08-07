<?php

namespace App\Http\Controllers\costumer;

use App\Http\Controllers\Controller;
use App\Models\ManageServices;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Http;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!FacadesGate::allows('costumer')) {
            abort(403);
        }
        $data = ManageServices::all();
        $orders = Orders::withoutGlobalScopes()->where('user_id', auth()->id())->limit(3)->get();
        return view('costumer.make_an_order', compact('data', 'orders'));
    }

    public function orderHistory(Request $request)
    {
        // $orders = Orders::withoutGlobalScopes()->where('user_id', auth()->id())
        //     ->with(['user', 'teknisi', 'manageService'])
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(10);

        $query = Orders::query();

        if ($request->has('search')) {
            $cari = $request->search;

            $id = ltrim(str_replace('#', '', $cari), '0');
            $query->where(function ($q) use ($cari, $id) {
                $q->whereHas('manageService', function ($q) use ($cari) {
                    $q->where('name', 'like', '%' . $cari . '%');
                });
                $q->orWhere('device_problem', 'like', '%' . $cari . '%')->orWhere('id', 'like', '%' . $id . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }



        $orders = $query->withoutGlobalScopes()->where('user_id', auth()->id())
            ->with(['user', 'teknisi', 'manageService'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('costumer.order_history', compact('orders'));
    }

    public function applyAsTeknisi()
    {
        $response = Http::get('https://wilayah.id/api/provinces.json');
        $provinces = $response->json();

        return view('costumer.apply_as_teknisi', compact('provinces'));
    }

    public function pay($id)
    {
        $orders = Orders::withoutGlobalScopes()->findOrFail($id);

        $orders->status = "selesai";

        $orders->save();

        return redirect()->route('costumer.order_history', compact('orders'))->with('success', 'Pembayaran Berhasil');
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
    public function storeOrder(Request $request)
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

    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Orders::with(['user', 'teknisi', 'manageService'])
            ->withoutGlobalScopes()
            ->findOrFail($id);

        $teknisi = User::find($order->teknisi_id);

        return view('costumer.show', compact('order', 'teknisi'));
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
