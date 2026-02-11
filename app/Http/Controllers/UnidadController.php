<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use App\Models\Cajon;
use DB;

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
                // 'estado' => 'En Ruta' 
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
