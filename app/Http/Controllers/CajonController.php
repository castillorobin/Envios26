<?php

namespace App\Http\Controllers;

use App\Models\Cajon;
use Illuminate\Http\Request;

class CajonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cajones = Cajon::all();
        return view('cajon.index', compact('cajones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|integer',
        ]);

        Cajon::create([
            'numero' => $request->numero,
        ]);

        return redirect()->route('cajones.inicio')->with('success', 'Caja creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cajon  $cajon
     * @return \Illuminate\Http\Response
     */
    public function show(Cajon $cajon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cajon  $cajon
     * @return \Illuminate\Http\Response
     */
    public function edit(Cajon $cajon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cajon  $cajon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cajon $cajon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cajon  $cajon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cajon $cajon)
    {
        //
    }
}
