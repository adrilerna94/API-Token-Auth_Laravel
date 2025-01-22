<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Http\Requests\StoreBandRequest;
use App\Http\Requests\UpdateBandRequest;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bands = Band::with('concerts')->get();
        return response()->json($bands, 200);
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
    public function store(StoreBandRequest $request)
    {
        $band = Band::create($request->all());
        return response()->json($band, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Band $band)
    {
        $bandWithConcerts = Band::with(['concerts'])->find($band->id);
        return response()->json($bandWithConcerts, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Band $band)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBandRequest $request, Band $band)
    {
        $band->update($request->all());
        return response()->json($band, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Band $band)
    {
        // 1) Desatamos las relaciones
        $band->concerts()->detach();

        // 2) Eliminamos el registro de band
        $band->delete();

        // 3) respuesta noContent
        return response()->noContent();
    }
}
