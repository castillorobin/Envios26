<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use App\Models\Comercio;
use App\Models\Punto;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cajon;

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
    // 1. Validación (La misma que ya tienes)
    $request->validate([
        'guia' => 'required|exists:ordens,guia',
        'comercio' => 'required|string',
        'destinatario' => 'required|string',
        'tipo' => 'required|string',
        'destino' => 'required|string',
        'telefono' => 'required|string',
        'fecha_entrega' => 'required|date',
        'total' => 'required|numeric',
    ]);

    // 2. Buscar y Actualizar
    $orden = Orden::where('guia', $request->guia)->first();

    // Lógica del ID del Punto (La que ya tienes)
    $puntoId = null;
    if ($request->input('tipo') === 'Punto fijo' || $request->input('tipo') === 'Casillero') {
        $puntoEncontrado = \App\Models\Punto::where('nombre', $request->input('destino'))->first();
        if ($puntoEncontrado) $puntoId = $puntoEncontrado->id;
    }

    $orden->update([
        'direccion'     => $request->input('direccion'),
        'destinatario'  => $request->input('destinatario'),
        'telefono'      => $request->input('telefono'),
        'whatsapp'      => $request->input('whatsapp'),
        'tipo'          => $request->input('tipo'),
        'destino'       => $request->input('destino'),
        'fecha_entrega' => $request->input('fecha_entrega'),
        'total'         => $request->input('total'),
        'estado'        => 'Creado',
        'cobro'         => $request->input('cobro_envio'),
        'precio'        => $request->input('precio_paquete'),
        'envio'         => $request->input('precio_envio'),
        'nota'          => $request->input('nota'),
        'punto'         => $puntoId,
    ]);

    // --- LÓGICA DE RESPUESTA ---
    
    // Si el usuario presionó "Guardar e Imprimir"
    if ($request->input('accion') === 'imprimir') {
        $puntoAsociado = null;

    // Si es Punto fijo, cargamos los datos del punto usando el ID que guardamos
    if ($orden->tipo === 'Punto fijo' && $orden->punto) {
        $puntoAsociado = \App\Models\Punto::find($orden->punto);
        $pdf = Pdf::loadView('orden.ticketguia', [
        'orden' => $orden,
        'punto' => $puntoAsociado
    ]);
        $pdf->setPaper([0, 0, 170, 320], 'landscape');
        
        return $pdf->stream('ticket_'.$orden->guia.'.pdf');
    }

    if ($orden->tipo === 'Casillero' && $orden->punto) {
        
        $puntoAsociado = \App\Models\Punto::find($orden->punto);
        $pdf = Pdf::loadView('orden.ticketcasi', [
        'orden' => $orden,
        'punto' => $puntoAsociado
    ]);
        $pdf->setPaper([0, 0, 170, 320], 'landscape');
        
        return $pdf->stream('ticket_'.$orden->guia.'.pdf');
    }

    if ($orden->tipo === 'Personalizado') {
        $pdf = Pdf::loadView('orden.ticketperso', [
        'orden' => $orden
    ]);
        $pdf->setPaper([0, 0, 170, 320], 'landscape');
        
        return $pdf->stream('ticket_'.$orden->guia.'.pdf');
    }

    if ($orden->tipo === 'Personalizado departamental') {
        $pdf = Pdf::loadView('orden.ticketdepar', [
        'orden' => $orden
    ]);
        $pdf->setPaper([0, 0, 170, 320], 'landscape');
        
        return $pdf->stream('ticket_'.$orden->guia.'.pdf');
    }

   
    // Pasamos tanto la orden como el punto (si existe) a la plantilla
    



    }

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

    public function tomarfoto() {
        return view('orden.tomarfoto');
    }

    public function buscarGuiaAjax(Request $request)
{
    $guia = Orden::where('guia', $request->guia)->first();

    if ($guia) {
    return response()->json([
        'success' => true,
        'guia' => $guia->guia
    ]);
} else {
    return response()->json([
        'success' => false,
        'message' => 'La guía ingresada no existe en el sistema.'
    ]); // Quitamos el código 404 para manejarlo más fácil en el try/catch
}

}

public function guardarFotos(Request $request)
{
    // Capturamos la guía sin filtros para ver qué llega
    $guiaRecibida = $request->input('guia');
    \Log::info('--- NUEVO INTENTO ---');
    \Log::info('Guía pura del Request: ' . ($guiaRecibida ?? 'NULL'));

    $request->validate([
        'guia' => 'required|exists:ordens,guia',
        'file' => 'required|image|max:2048'
    ]);

    $orden = Orden::where('guia', $request->guia)->first();

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = $orden->guia . '_' . time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        
        // Mover archivo
        $file->move(public_path('imgs'), $filename);
        \Log::info('Archivo movido a /imgs/' . $filename);

        // ASIGNACIÓN EXPLÍCITA
        // Usamos trim() por si hay espacios en blanco accidentales en la BD
        if ($orden->foto1 == null || trim($orden->foto1) == "") {
            $orden->foto1 = $filename;
            \Log::info('Asignado a foto1');
        } elseif ($orden->foto2 == null || trim($orden->foto2) == "") {
            $orden->foto2 = $filename;
            \Log::info('Asignado a foto2');
        } elseif ($orden->foto3 == null || trim($orden->foto3) == "") {
            $orden->foto3 = $filename;
            \Log::info('Asignado a foto3');
        } else {
            return response()->json(['error' => 'Límite de 3 fotos alcanzado'], 400);
        }

        // GUARDADO CON REFRESH
        $guardado = $orden->save();
        
        if ($guardado) {
            \Log::info('Base de datos actualizada con éxito');
            return response()->json(['success' => true, 'file' => $filename]);
        } else {
            \Log::error('Fallo al ejecutar save() en el modelo');
            return response()->json(['error' => 'No se pudo actualizar la orden en la BD'], 500);
        }
    }
}

    public function asignarMercancia(Request $request)
    {
        return view('orden.buscarmercancia');
    }
    public function procesarAsignacion(Request $request)
{
    // 1. Validación básica de campos presentes
    $request->validate([
        'caja' => 'required|string',
        'tipo' => 'required|string',
    ]);

    $caja = $request->input('caja');
    $tipo = $request->input('tipo');

    //dd("Caja: {$caja}, Tipo: {$tipo}");

    // 2. Validación lógica: Si es tipo Caja, debe existir en el modelo Cajon
    if ($tipo === 'Caja') {
        // Buscamos si existe el registro con ese número (asumiendo que la columna se llama 'numero')
        $existeCaja = Cajon::where('numero', $caja)->exists();

        if (!$existeCaja) {
            return back()->with('error', "La caja #{$caja} no está registrada en el sistema. Por favor, verifique el número o cree la caja primero.");
        }
    }

    // 3. Si pasa la validación (o si es "Suelto"), procedemos a la vista de asignación
    return view('orden.asignacion', compact('caja', 'tipo'));
}

    public function buscarGuiaAsignacion(Request $request)
{
    $guia = $request->guia;
    
    // Buscamos la orden y cargamos la relación del comercio para obtener el nombre
    $orden = Orden::where('guia', $guia)
        ->with('comercioRel') // Asegúrate de tener esta relación en el modelo Orden
        ->first();

    if (!$orden) {
        return response()->json(['success' => false, 'message' => 'La guía no existe.']);
    }

    if ($orden->caja) {
        return response()->json(['success' => false, 'message' => "Ya asignada a caja #{$orden->caja}"]);
    }

    return response()->json([
        'success' => true,
        'data' => [
            'guia' => $orden->guia,
            // Si usas relación: $orden->comercioRel->nombre
            // Si el campo se llama igual pero quieres el nombre del objeto:
            'comercio' => $orden->comercioRel ? $orden->comercioRel->nombre : 'Sin Comercio', 
            'destinatario' => $orden->destinatario,
            'destino' => $orden->destino,
            'fecha_entrega' => $orden->fecha_entrega,
            'estado' => $orden->estado
        ]
    ]);
}



public function confirmarAsignacion(Request $request)
{
    $guias = $request->input('guias');
    $tipo = $request->input('tipo');

    if (empty($guias)) {
        return response()->json(['success' => false, 'message' => 'No hay guías para procesar.']);
    }

    try {
        if ($tipo === 'Caja') {
            // Actualización masiva para Caja
            Orden::whereIn('guia', $guias)->update([
                'caja' => $request->input('caja'),
                'estado' => 'Asignado' // O el estado que manejes
            ]);
            $mensaje = "Mercancía asignada a la caja correctamente.";
        } else {
            // Actualización masiva para Suelto
            Orden::whereIn('guia', $guias)->update([
                'rack' => $request->input('rack'),
                'nivel' => $request->input('nivel'),
                'gondola' => $request->input('gondola'),
                'caja' => null, // Aseguramos que no tenga caja
                'estado' => 'En Bodega'
            ]);
            $mensaje = "Mercancía ubicada en estantería correctamente.";
        }

        return response()->json(['success' => true, 'message' => $mensaje]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error al guardar: ' . $e->getMessage()]);
    }
}

    public function vistaBusquedaubicacion()
    {
        return view('ubicacion.buscarubicacion');
    }

    public function procesarBusquedaubicacion(Request $request)
{
    // Validamos que el campo 'tipo' esté presente
    // Si eliges 'Caja', validamos que el campo 'caja' también venga
    $request->validate([
        'tipo' => 'required|string',
       // 'caja' => 'required_if:tipo,Caja' 
    ]);

    $tipo = $request->input('tipo');
   // $cajaSeleccionada = $request->input('caja'); // El número de caja ingresado/escaneado
$caja = $request->input('caja'); // El número de caja ingresado/escaneado
    // Lógica de redirección por tipo
    if ($tipo === 'Suelto') {
        // Opción Suelto: Va a la vista de guías individuales
        return view('ubicacion.asignacionsuelto', compact('tipo', 'caja'));
    }
/*
    // Opción Caja: Validamos que la caja exista antes de ir a la siguiente vista
    $cajaInfo = Cajon::where('numero', $cajaSeleccionada)->first();

    if (!$cajaInfo) {
        return back()->with('error', "La caja #{$cajaSeleccionada} no existe en el sistema.");
    }
        */

    // Retorna la vista que ya tenías para Cajas
    return view('ubicacion.ubicacioncaja', compact('tipo'));
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
