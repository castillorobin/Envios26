<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use App\Models\Comercio;
use App\Models\Punto;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = Orden::all();
        return view('orden.index', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $puntos = Punto::all();
        $comercios = Comercio::all();
        return view('orden.crearorden', compact('comercios', 'puntos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([

            'comercio' => 'required|string|max:255',
            //'origen' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'nota' => 'nullable|string|max:500',
        ]);

        // Crear una nueva orden
        Orden::create([
            'guia' => $request->input('guia'),
            'comercio' => $request->input('comercio'),
            'direccion' => $request->input('direccion'),
            'destinatario' => $request->input('destinatario'),
            'telefono' => $request->input('telefono'),
            'whatsapp' => $request->input('whatsapp'),
            'tipo' => $request->input('tipo'),
            'destino' => $request->input('destino'),
            'fecha_entrega' => $request->input('fecha_entrega'),
            'total' => $request->input('total'),
            'nota' => $request->input('nota'),
            'stado' => 'Creado',
        ]);

        // Redirigir a la lista de órdenes con un mensaje de éxito
        return redirect()->route('orden.inicio')->with('success', 'Orden creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
