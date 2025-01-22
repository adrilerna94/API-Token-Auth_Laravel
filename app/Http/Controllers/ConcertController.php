<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Http\Requests\StoreConcertRequest;
use App\Http\Requests\UpdateConcertRequest;

class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $concerts = Concert::with('bands')->get();
        return response()->json($concerts, 200);
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

    public function store(StoreConcertRequest $request)
    {
        $concert = Concert::create($request->all());
        return response()->json($concert, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Concert $concert)
    {
        $concertWithBands = Concert::with(['bands'])->find($concert->concert_id);
        return response()->json($concertWithBands, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Concert $concert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConcertRequest $request, Concert $concert)
    {
        $concert->update($request->all());
        return response()->json($concert, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Concert $concert)
    {
        //1) Eliminamos registros relacionados
        $concert->bands()->detach();

        //2) Eliminamos registro principal concert
        $concert->delete();

        // 3) respuesta noContent (204)
        return response()->noContent();
    }
}
