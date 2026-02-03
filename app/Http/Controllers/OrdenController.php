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
        return view('orden.buscar_guia');
    }


    public function buscarGuia($codigo)
{
    // Buscamos la orden/guia y cargamos la relación del comercio si existe
    // Asumo que tu modelo se llama Orden y tiene relacion con Comercio
    $guia = \App\Models\Orden::where('guia', $codigo)->first();

    if ($guia) {
        // Obtenemos los datos del comercio (ajusta según tus nombres de columna)
        $comercio = \App\Models\Comercio::where('nombre', $guia->comercio)->first();
        
        return response()->json([
            'success' => true,
            'comercio' => $guia->comercio,
            'direccion' => $comercio ? $comercio->direccion : ''
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Guía no encontrada']);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validar los datos recibidos
    $request->validate([
        'guia' => 'required|exists:ordens,guia', // Validamos que la guía exista en la BD
        'comercio' => 'required|string|max:255',
        'destinatario' => 'required|string|max:255',
        'tipo' => 'required|string|max:255',
        'destino' => 'required|string|max:255',
        'telefono' => 'required|string',
        'fecha_entrega' => 'required|date',
        'total' => 'required|numeric',
        'nota' => 'nullable|string|max:500',
    ]);

    // 2. Buscar la orden existente por el número de guía
    $orden = Orden::where('guia', $request->guia)->first();

    if (!$orden) {
        return back()->with('error', 'No se encontró el registro de la guía para actualizar.');
    }

    // 3. Actualizar los campos del registro existente
    $orden->update([
        'direccion' => $request->input('direccion'),
        'destinatario' => $request->input('destinatario'),
        'telefono' => $request->input('telefono'),
        'whatsapp' => $request->input('whatsapp'),
        'tipo' => $request->input('tipo'),
        'destino' => $request->input('destino'),
        'fecha_entrega' => $request->input('fecha_entrega'),
        'total' => $request->input('total'),
        'nota' => $request->input('nota'),
        'estado' => 'Creado', // Cambiamos el estado de 'Recepcionado' a 'Creado'
    ]);

    // 4. Redirigir con mensaje de éxito
    return redirect()->route('ordenes.crear')->with('success', 'La orden ha sido completada y guardada exitosamente.');
    }

    public function vistaBusqueda() {
    return view('orden.buscar_guia');
}

public function procesarBusqueda(Request $request) {
    
    $request->validate(['guia' => 'required']);

    $guia = \App\Models\Orden::where('guia', $request->guia)->first();

    if (!$guia) {
        return back()->with('error', 'La guía no existe en el sistema.');
    }

    if ($guia->estado !== 'Recepcionado') {
        return back()->with('error', 'La guía ingresada ya ha sido Creada.');
    }

    $comercio = \App\Models\Comercio::where('id', $guia->comercio)->first();
//dd($comercio);
    // Redirigimos al formulario llevando los datos en la sesión

     $guiaact = $guia->guia;
        

    $puntos = Punto::all();
    return view('orden.crearorden', compact('puntos', 'comercio', 'guiaact'));
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
