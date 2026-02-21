<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use App\Models\Recepcion;
use App\Models\Orden;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    public function actualizarOrdenInline(Request $request)
{
    try {
        $orden = \App\Models\Orden::findOrFail($request->id);
        $orden->update([
            'cobro'  => $request->cobro,
            'precio' => $request->precio,
            'envio'  => $request->envio,
            'total'  => $request->total,
        ]);

        return response()->json(['success' => true, 'message' => 'Datos de la guía actualizados.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

    public function guardarRegistro(Request $request)
{
    $request->validate([
        'ids_ordenes' => 'required',
        'subtotal'    => 'required|numeric',
        'total'       => 'required|numeric',
        'estado_pago' => 'required|in:Pagado,Revisado' // Validación de las nuevas opciones
    ]);

    try {
        DB::beginTransaction();

        $ids = json_decode($request->ids_ordenes);

        if (empty($ids)) {
            return back()->with('error', 'No se seleccionaron órdenes.');
        }

        // 1. Crear el registro de Pago
        $pago = new Pago();
        $pago->usuario_id     = Auth::id();
        $pago->fecha_pago     = now();
        $pago->subtotal       = $request->subtotal;
        $pago->descuento      = $request->descuento ?? 0;
        $pago->nota_descuento = $request->nota_descuento;
        $pago->total          = $request->total;
        $pago->estado         = $request->estado_pago; // Aquí guarda "Pagado" o "Revisado"
        $pago->comercio       = $request->comercio; // Guardar el nombre del comercio
        $pago->recepcion_id    = $request->recepcion_id; // Guardar la relación con la recepción
        $pago->save();

        Recepcion::whereIn('id', $request->recepcion_id)->update([
                
                'status' => $request->estado_pago
            ]);


        // 2. Actualizar las Órdenes de forma masiva
        // Si el estado del pago es 'Pagado', marcamos las órdenes como 'Cobrado'
        $estadoCobro = $request->estado_pago; 
//dd($estadoCobro);
        Orden::whereIn('id', $ids)->update([
            'pago' => $estadoCobro,
            'pago_id' => $pago->id
        ]);

        DB::commit();

        return redirect()->route('pagos.inicio')->with('success', 'El registro se ha guardado como ' . $request->estado_pago);

    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Error: ' . $e->getMessage());
    }
}

    public function reparto()
    {
        //$repartos = Pago::with('usuario')->where('estado', 'Pagado')->get();
        return view('pago.reparto');
    }
    public function crearreparto(Request $request)
    {
        // Aquí puedes implementar la lógica para crear un nuevo reparto
        // Por ejemplo, podrías mostrar un formulario para ingresar los detalles del reparto
        $idticket = $request->query('caja'); // Obtener el número de ticket desde la URL
        //$ticket = Recepcion::where('codigo', $idticket)->first(); // Buscar el ticket en la base de datos
        $ticket = Recepcion::with('datosComercio')->where('codigo', $idticket)->first();
        return view('pago.crearreparto', compact('ticket')  );
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
