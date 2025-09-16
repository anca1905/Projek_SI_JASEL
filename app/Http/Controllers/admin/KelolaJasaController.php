<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\ManageServices;
use App\Models\Services;
use App\Services\JasaServices;

class KelolaJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, JasaServices $services)
    {
        $data = $services->getFilteredServices($request);
        return view('admin.kelola_jasa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_jasa.__create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->validated();

        ManageServices::create($data);

        return redirect()->route('admin.adminkelola_jasa.index')->with('success', 'Jasa berhasil ditambahkan.');
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
        $service = ManageServices::findOrFail($id);
        return view('admin.kelola_jasa.__edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        // dd($request);
        $service = ManageServices::findOrFail($id);
        $data = $request->validated();
        $service->update($data);
        return redirect()->route('admin.adminkelola_jasa.index')->with('success', 'Jasa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = ManageServices::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.adminkelola_jasa.index')->with('success', 'Jasa berhasil dihapus.');
    }
}
