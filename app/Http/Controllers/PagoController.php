<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use App\Models\Recepcion;
use App\Models\Orden;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pago.buscarticket');
    }

    public function crearPago(Request $request)
    {
        // 'caja' es el nombre que tiene el input en tu HTML
        $ticketId = $request->query('caja'); 

        // 1. Buscar el ticket de recepción
       $recepcion = Recepcion::with('datosComercio')->where('codigo', $ticketId)->first();

        if (!$recepcion) {
            return back()->with('error', 'El ticket de recepción no existe.');
        }

        // 2. Buscar las órdenes relacionadas
        // Asumiendo que el campo en Orden es recepcion_id
        $ordenes = Orden::where('recepcion_id', $recepcion->id)->get();

        // 3. Retornar la vista de detalles de pago
        return view('pago.detalles', compact('recepcion', 'ordenes'));
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
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
