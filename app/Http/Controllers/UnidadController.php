<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = Unidad::all();
        return view('unidades.index', compact('unidades'));
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
     * Display the specified resource.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function show(Unidad $unidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidad $unidad)
    {
        //
    }

   
// Método para guardar una nueva unidad
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
          
        ]);

        Unidad::create($request->all());

        return redirect()->back()->with('success', 'Unidad creada exitosamente.');
    }

    // Método para actualizar una unidad existente
    public function update(Request $request, $id)
    {
        $unidad = Unidad::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            
        ]);

        $unidad->update($request->all());

        return redirect()->back()->with('success', 'Unidad actualizada correctamente.');
    }

    public function destroy($id)
    {
        Unidad::destroy($id);
        return redirect()->back()->with('success', 'Unidad eliminada.');
    }
}
