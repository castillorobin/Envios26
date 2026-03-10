<?php

namespace App\Http\Controllers;

use App\Models\Recepcion;
use Illuminate\Http\Request;
use App\Models\Comercio;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Orden;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Caja;
use App\Models\Detallecaja;
use App\Models\Hestado;




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

    // --- NUEVA VERIFICACIÓN DE CAJA ABIERTA ---
    $cajaActiva = Caja::where('cajero', Auth::user()->name)
                      ->where('estado', 0) // 0 = Abierta
                      ->latest()
                      ->first();

    if (!$cajaActiva) {
        // Si no hay caja activa, redirigir a la ruta 'cajero' con el mensaje para SweetAlert
        return redirect()->route('cajero')->with('info', 'Debe de abrir caja antes de agregar movimientos');
    }
    // ------------------------------------------

    try {
        DB::beginTransaction();

        // 2. Crear el registro de Recepción
        $recepcion = new Recepcion();
        $recepcion->comercio   = $request->comercio_id;
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

        // --- LÓGICA DE SALDOS ---
    
        // Calculamos el nuevo saldo
        // Asumiendo que el campo en la tabla Caja se llama 'saldo'
        $nuevoSaldo = $cajaActiva->saldo + $recepcion->total;

        // A. Actualizamos el registro de la Caja principal
        $cajaActiva->saldo = $nuevoSaldo;
        $cajaActiva->save();

        // --- NUEVO: GUARDAR DETALLE DE CAJA ---
        $detalleCaja = new Detallecaja();
        $detalleCaja->idcaja      = $cajaActiva->id;
        $detalleCaja->concepto     = "Recepción en Ticket: " . $recepcion->codigo;
        $detalleCaja->valor        = $recepcion->total;
        $detalleCaja->tipo         = 'Entrada'; // O según tu lógica de DB
        $detalleCaja->cajero      = Auth::user()->name;
        $detalleCaja->saldo        = $cajaActiva->saldo; 
        $detalleCaja->save();
        // --------------------------------------

        // 4. Guardar cada guía en el modelo Orden
        foreach ($request->guias as $guiaNum) {
            $orden = new Orden();
            $orden->guia     = $guiaNum;
            $orden->comercio = $request->comercio_id;
            $orden->estado   = 'Recepcionado';
            $orden->recepcion_id = $recepcion->id;
            $orden->save();

                // --- NUEVO: GUARDAR HISTORIAL DE ESTADOS ---
                $hesta = new Hestado();
                $hesta->idenvio = $orden->id;
                $hesta->estado = "Recepcionado";
                $hesta->nota = "Paquete recepcionado en el sistema.";
                $hesta->usuario =  Auth::user()->name ;
                $hesta->save();
                // --------------------------------------
        }

        DB::commit();

        // 5. Preparar datos para el Ticket PDF
        $ticket = (object)[
            'codigo'         => $recepcion->codigo,
            'comercio'       => $request->comercio_nombre ?? 'Comercio', 
            'cantidad_guias' => count($request->guias),
            'subtotal'       => $recepcion->subtotal,
            'descuento'      => $recepcion->descuento,
            'total'          => $recepcion->total,
            'metodo'         => $recepcion->metodo
        ];

        // 6. Generar PDF
        $pdf = Pdf::loadView('recepcion.ticketcobros', compact('ticket'));
        $customPaper = array(0,0,360,850);
        return $pdf->setPaper($customPaper)->stream('Ticket_' . $recepcion->codigo . '.pdf');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error al guardar: ' . $e->getMessage());
    }
}


public function verificarGuiaExistente(Request $request)
{
    $guia = $request->guia;
    
    // Verificamos si existe en la tabla ordens
    $existe = \App\Models\Orden::where('guia', $guia)->exists();

    return response()->json([
        'existe' => $existe
    ]);
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
