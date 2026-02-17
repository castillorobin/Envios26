<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use App\Models\Cajon;
use DB;
use App\Models\User;
use Carbon\Carbon;

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

    public function vistaBusqueda()
    {
        return view('carga.buscarcarga');
    }

    public function procesarBusqueda(Request $request)
{
    // Validamos que el campo 'tipo' esté presente
    // Si eliges 'Caja', validamos que el campo 'caja' también venga
    $request->validate([
        'tipo' => 'required|string',
       // 'caja' => 'required_if:tipo,Caja' 
    ]);

    $unidades = Unidad::all(); // Si necesitas pasar unidades a la vista, puedes hacerlo aquí

    $tipo = $request->input('tipo');
   // $cajaSeleccionada = $request->input('caja'); // El número de caja ingresado/escaneado
$caja = $request->input('caja'); // El número de caja ingresado/escaneado
    // Lógica de redirección por tipo
    if ($tipo === 'Suelto') {
        // Opción Suelto: Va a la vista de guías individuales
        return view('carga.asignacioncargaguia', compact('tipo', 'caja', 'unidades'));
    }




/*
    // Opción Caja: Validamos que la caja exista antes de ir a la siguiente vista
    $cajaInfo = Cajon::where('numero', $cajaSeleccionada)->first();

    if (!$cajaInfo) {
        return back()->with('error', "La caja #{$cajaSeleccionada} no existe en el sistema.");
    }
        */

    // Retorna la vista que ya tenías para Cajas
    return view('carga.ubicacioncargacaja', compact('tipo', 'unidades'));
}


    public function confirmarCarga(Request $request)
    {
        $request->validate([
        'cajas' => 'required|array',
        // Cambiamos 'unidades' por 'unidads' para que coincida con tu base de datos
        'unidad_id' => 'required|exists:unidads,id', 
        'fecha' => 'required|date',
    ]);

        try {
            // Iniciamos una transacción para asegurar que todo se guarde o nada se guarde
            DB::beginTransaction();

            $unidadId = $request->unidad_id;
            $fecha = $request->fecha;
            $numerosCajas = $request->cajas;

            // 1. Buscamos la unidad y actualizamos su fecha de ruta
            $unidad = Unidad::findOrFail($unidadId);
            $unidad->fecharuta = $fecha;
            $unidad->save();

            // 2. Actualizamos los registros de las cajas (Modelo Cajon)
            // Asignamos el ID de la unidad a cada caja que esté en el array
            Cajon::whereIn('numero', $numerosCajas)->update([
                'unidad' => $unidadId,
                // Opcional: puedes actualizar el estado de la caja aquí si lo necesitas
                'estado' => 'En transito' // Ejemplo de estado, ajusta según tu lógica de negocio
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'La carga se ha asignado correctamente a la unidad ' . $unidad->nombre
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar la carga: ' . $e->getMessage()
            ], 500);
        }
    }



    public function confirmarCargaGuias(Request $request)
{
    $request->validate([
        'guias' => 'required|array',
        'unidad_id' => 'required|exists:unidads,id', // Usando 'unidads' por tu base de datos
        'fecha' => 'required|date',
    ]);

    try {
        \DB::beginTransaction();

        $unidadId = $request->unidad_id;
        $fecha = $request->fecha;
        $codigosGuias = $request->guias;

        // 1. Actualizar la Unidad seleccionada
        $unidad = \App\Models\Unidad::findOrFail($unidadId);
        $unidad->fecharuta = $fecha;
        $unidad->save();

        // 2. Actualizar las Ordenes (Guias)
        // Asignamos el ID de la unidad a cada orden
        \App\Models\Orden::whereIn('guia', $codigosGuias)->update([
            'unidad' => $unidadId,
            'estado' => 'En transito' // Cambiamos el estado opcionalmente
        ]);

        \DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Se han asignado ' . count($codigosGuias) . ' guías a la unidad ' . $unidad->nombre
        ]);

    } catch (\Exception $e) {
        \DB::rollback();
        return response()->json([
            'success' => false,
            'message' => 'Error en la base de datos: ' . $e->getMessage()
        ], 500);
    }
}
public function asignarReparto()
{
    // 1. Definir fechas: Hoy y Mañana
    $hoy = Carbon::today()->toDateString();
    $manana = Carbon::tomorrow()->toDateString();

    // 2. Obtener solo usuarios que TIENEN unidad asignada 
    // y cuya fecharuta sea hoy o mañana
    $usuarios = User::whereHas('unidadAsignada', function($query) use ($hoy, $manana) {
        $query->whereIn('fecharuta', [$hoy, $manana]);
    })->with('unidadAsignada')->get();

    // 3. Unidades disponibles para el modal (opcional: solo las que no tienen repartidor)
    $unidades = Unidad::whereNull('repartidor')->get();

    $usuariosall = User::all();
    $unidadesall = Unidad::all();

    return view('carga.asignarreparto', compact('unidades', 'usuarios', 'usuariosall', 'unidadesall'));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaReparto()
{
    // Obtenemos las unidades con el conteo de cajas y guías directas
    $unidades = Unidad::withCount(['cajas', 'guiasDirectas'])
        ->with(['cajas.guias']) // Cargamos las guías de cada caja
        ->where('estado', 'En transito')
        ->get();

    // Calculamos el gran total de guías para cada unidad
    foreach ($unidades as $unidad) {
        // Sumamos: guías sueltas + guías dentro de cada caja cargada
        $totalGuiasEnCajas = $unidad->cajas->sum(function($caja) {
            return $caja->guias->count();
        });

        $unidad->total_real_guias = $unidad->guias_directas_count + $totalGuiasEnCajas;
    }

    return view('carga.listareparto', compact('unidades'));
}


    public function procesarAsignacionRepartidor(Request $request)
{
    $request->validate([
        'unidad_id' => 'required|exists:unidads,id',
        'repartidor_id' => 'required|exists:users,id',
    ]);

    //dd($request->all());

    try {
        $unidad = \App\Models\Unidad::findOrFail($request->unidad_id);
        //dd($unidad);
        $unidad->update([
            'repartidor' => $request->repartidor_id,
            'estado' => 'En transito'
        ]);

        return back()->with('success', "Repartidor asignado correctamente a la unidad {$unidad->nombre}.");

    } catch (\Exception $e) {
        return back()->with('error', 'Error al asignar repartidor: ' . $e->getMessage());
    }
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
