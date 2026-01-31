<?php

namespace App\Http\Controllers;

use App\Models\Recepcion;
use Illuminate\Http\Request;
use App\Models\Comercio;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Orden;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecepcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function crearrecepcion(Request $request)
{
    // Validar que el comercio_id esté presente y exista en la tabla
    $request->validate([
        'comercio_id' => 'required|exists:comercios,id'
    ], [
        'comercio_id.required' => 'Debe seleccionar un comercio antes de continuar.'
    ]);

    $comercio_id = $request->input('comercio_id');
    $comercio = Comercio::findOrFail($comercio_id);
    
    return view('recepcion.crearrecepcion', compact('comercio'));
}
    public function elegircomercio()
    {
        $comercios = Comercio::all();
        return view('recepcion.elegircomercio', compact('comercios'));
    }



    public function guardar(Request $request)
    {
        // 1. Validar que vengan guías
        if (!$request->has('guias') || count($request->guias) == 0) {
            return back()->with('error', 'No hay guías en la lista para guardar.');
        }

        try {
            DB::beginTransaction();

            // 2. Crear el registro de Recepción
            $recepcion = new Recepcion();
            $recepcion->comercio   = $request->comercio_id; // O el nombre según tu DB
            $recepcion->usuario    = Auth::user()->name;
            $recepcion->subtotal   = $request->subtotal ?? 0;
            $recepcion->descuento  = $request->descuento ?? 0;
            $recepcion->total      = $request->total ?? 0;
            $recepcion->nota       = $request->nota;
            $recepcion->metodo     = $request->metodo_pago;
            $recepcion->status     = 'Pendiente';
            $recepcion->save();

            // 3. Generar el Código (Año + ID)
            $anioActual = date('Y');
            $recepcion->codigo = $anioActual . $recepcion->id;
            $recepcion->save();

            // 4. Guardar cada guía en el modelo Orden
            foreach ($request->guias as $guiaNum) {
                $orden = new Orden();
                $orden->guia     = $guiaNum;
                $orden->comercio = $request->comercio_id;
                $orden->estado   = 'Recepcionado';
                $orden->recepcion_id = $recepcion->id; // Relación si la tienes
                $orden->save();
            }

            DB::commit();

            // 5. Preparar datos para el Ticket PDF
            // Creamos un objeto genérico para que coincida con tu plantilla
            $ticket = (object)[
                'codigo'         => $recepcion->codigo,
                'comercio'       => $request->comercio_nombre ?? 'Comercio', 
                'cantidad_guias' => count($request->guias),
                'subtotal'       => $recepcion->subtotal,
                'descuento'      => $recepcion->descuento,
                'total'          => $recepcion->total,
                'metodo'         => $recepcion->metodo
            ];

            // 6. Generar PDF usando la plantilla ticketcobros.blade.php
            $pdf = Pdf::loadView('recepcion.ticketcobros', compact('ticket'));

            // Opcional: Si quieres que se descargue o se abra en el navegador
            $customPaper = array(0,0,360,850);
            return $pdf->setPaper($customPaper)->stream('Ticket_' . $recepcion->codigo . '.pdf');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function show(Recepcion $recepcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Recepcion $recepcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recepcion $recepcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recepcion $recepcion)
    {
        //
    }
}
