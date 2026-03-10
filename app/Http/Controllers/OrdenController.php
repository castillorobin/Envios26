<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use App\Models\Comercio;
use App\Models\Punto;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cajon;
use App\Models\Unidad;
use App\Models\Recepcion;
use App\Models\Hestado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comercios = Comercio::all();
        // $ordenes = Orden::all();
        return view('orden.index', compact('comercios'));
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
        'pago'          => $request->input('estado_pago') // Guardamos el estado del pago
    ]);

    $hesta = new Hestado();
        $hesta->idenvio = $orden->id;
        $hesta->estado = "Creado";
        $hesta->nota = "Paquete creado en el sistema.";
        $hesta->usuario =  Auth::user()->name ;
        $hesta->save();

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
    $agencia = $request->input('agencia');

    if (empty($guias)) {
        return response()->json(['success' => false, 'message' => 'No hay guías para procesar.']);
    }

    try {
        if ($tipo === 'Caja') {
            // Actualización masiva para Caja
            Orden::whereIn('guia', $guias)->update([
                'caja' => $request->input('caja'),
                'agencia' => $agencia,
                'estado' => 'Asignado' // O el estado que manejes
            ]);
            $mensaje = "Mercancía asignada a la caja correctamente.";
        } else {
            // Actualización masiva para Suelto
            Orden::whereIn('guia', $guias)->update([
                'rack' => $request->input('rack'),
                'nivel' => $request->input('nivel'),
                'gondola' => $request->input('gondola'),
                'agencia' => $agencia,
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
$agencias = Punto::where('tipo', 'Agencia')->get();
    $tipo = $request->input('tipo');
   // $cajaSeleccionada = $request->input('caja'); // El número de caja ingresado/escaneado
$caja = $request->input('caja'); // El número de caja ingresado/escaneado
    // Lógica de redirección por tipo
    if ($tipo === 'Suelto') {
        // Opción Suelto: Va a la vista de guías individuales
        return view('ubicacion.asignacionsuelto', compact('tipo', 'caja', 'agencias'));
    }
/*
    // Opción Caja: Validamos que la caja exista antes de ir a la siguiente vista
    $cajaInfo = Cajon::where('numero', $cajaSeleccionada)->first();

    if (!$cajaInfo) {
        return back()->with('error', "La caja #{$cajaSeleccionada} no existe en el sistema.");
    }
        */
    $agencias = Punto::where('tipo', 'Agencia')->get();

    // Retorna la vista que ya tenías para Cajas
    return view('ubicacion.ubicacioncaja', compact('tipo', 'agencias'));
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

    public function cuadrePaqueteria()
    {
        $unidades = \App\Models\Unidad::all();
        return view('cuadre.buscarunidad', compact('unidades'));
    }

        public function procesarCuadrePaqueteria(Request $request)
    {
        $request->validate([
        'unidad_id' => 'required|exists:unidads,id'
    ]);

    $unidad = Unidad::findOrFail($request->unidad_id);

    // 1. Obtener números de cajas asignadas a esta unidad
    $numerosCajas = Cajon::where('unidad', $unidad->id)->pluck('numero');

    // 2. Obtener todas las guías de la unidad (Sueltas + En Cajas)
    $guiasQuery = \App\Models\Orden::where(function($query) use ($unidad, $numerosCajas) {
        $query->where('unidad', $unidad->id)
              ->orWhereIn('caja', $numerosCajas);
    });

    $unidadactual = $unidad->nombre;
    $unidadid = $unidad->id;

    // 3. Hacer las sumatorias por estado
    // Usamos clone para no afectar la consulta original si necesitas el listado completo luego
    $totales = [
        'entregados'    => (clone $guiasQuery)->where('estado', 'Entregado')->count(),
        'no_entregados' => (clone $guiasQuery)->where('estado', 'No entregado')->count(),
        'cambios'       => (clone $guiasQuery)->where('estado', 'Cambio')->count(),
    ];

    // Si también necesitas pasar el listado de guías para mostrarlas abajo:
    $guias = $guiasQuery->get();

    return view('cuadre.iniciar_cuadre', compact('unidad', 'guias', 'totales', 'unidadactual', 'unidadid'));
    }

    public function detalleEstado($unidad_id, $estado)
    {
        $unidad = Unidad::findOrFail($unidad_id);

        // 1. Obtener números de cajas asignadas a esta unidad
        $numerosCajas = Cajon::where('unidad', $unidad_id)->pluck('numero');

        // 2. Obtener las guías filtradas por el estado específico
        $guias = \App\Models\Orden::where(function($query) use ($unidad_id, $numerosCajas) {
                $query->where('unidad', $unidad_id)
                    ->orWhereIn('caja', $numerosCajas);
            })
            ->where('estado', $estado) // Filtro por el estado cliqueado
            ->with('comercioRel')      // Cargar relación de comercio
            ->get();

        return view('cuadre.detalle_paquete', compact('unidad', 'guias', 'estado'));
    }

    public function detalle($id)
    {
        $orden = Orden::with('comercioRel')->findOrFail($id);
        $comercio = Comercio::find($orden->comercio);
        $hestados = Hestado::where('idenvio', $id)->get();
        return view('orden.detalleorden', compact('orden', 'comercio', 'hestados'));
    }

    public function busquedaComercio(Request $request)
    {
        $request->validate([
            'comercio' => 'required|exists:comercios,id'
        ]);

        $comercio_id = $request->comercio;

        // Obtener las órdenes asociadas al comercio seleccionado
        $ordenes = Orden::with('recepcion')->where('comercio', $comercio_id)->get();

        return view('orden.busqueda', compact('ordenes'));
    }
    public function busquedaTicket()
    {
        
        return view('orden.buscarticket');
    }
    
    public function ticketDetalles(Request $request)
    {
        $request->validate([
            'ticket' => 'required|string', // Este es el campo 'codigo' del ticket
        ]);

        $codigoTicket = $request->ticket;

        // 1. Buscamos el registro en el modelo Recepcion por su columna 'codigo'
        $recepcion = Recepcion::where('codigo', $codigoTicket)->first();

        // Validar si el ticket existe
        if (!$recepcion) {
            return back()->with('error', 'No se encontró ningún ticket con el código: ' . $codigoTicket);
        }

        // 2. Traemos todas las órdenes vinculadas a ese ID de recepción
        // Usamos with('comercioRel') para optimizar la carga si necesitas mostrar el nombre del comercio
        $ordenes = Orden::where('recepcion_id', $recepcion->id)->get();

        // 3. Si necesitas el comercio del ticket (asumiendo que Recepcion tiene comercio_id)
        $comercio = Comercio::find($recepcion->comercio); 

        return view('orden.detalleticket', compact('recepcion', 'ordenes', 'comercio'));
    }

    public function buscarfallidas()
    {
        
        return view('orden.buscarfallido');
    }


    public function fallidas(Request $request)
    {
        $request->validate([
            'guia' => 'required|string', // Este es el campo 'codigo' del ticket
        ]);
        $codigoGuia = $request->guia;
            $orden = Orden::where('guia', $codigoGuia)->first();
        
        return view('orden.aplicarfallido', compact('orden'));
    }


    public function registrarFallida(Request $request, $id)
    {
        // 1. Validar los datos básicos
        $request->validate([
            'motivo' => 'required',
            'fecha_reprogramacion' => 'required_if:motivo,Reprogramado',
            'nota_motivo' => 'required_if:motivo,Otro',
        ]);

        try {
            // 2. Buscar la orden
            $orden = Orden::findOrFail($id);

            // 3. Aplicar lógica según el motivo
            if ($request->motivo === 'Reprogramado') {
                $orden->fecha_repro = $request->fecha_reprogramacion;
                $orden->notafallido = "Reprogramado para el " . date('d/m/Y', strtotime($request->fecha_reprogramacion));
            } elseif ($request->motivo === 'Otro') {
                $orden->notafallido = $request->nota_motivo;
            } else {
                // Para otros motivos que no requieren campos extra
                $orden->notafallido = $request->motivo;
            }

            // 4. Cambiar estado a Fallido y guardar
            $orden->estado = 'Fallido';
            $orden->save();

            return redirect()->route('ordenes.buscarfallidas')->with('success', 'La guía se ha marcado como Fallida correctamente.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el registro: ' . $e->getMessage());
        }
    }
    
}
