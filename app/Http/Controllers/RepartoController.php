<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\Unidad; // Asumiendo que existe el modelo
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Hestado; // Para registrar el historial de estados


class RepartoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $usuarioId = Auth::id();
    
    // 1. Buscamos la unidad que tiene asignado a este usuario como repartidor
    $unidad = Unidad::where('repartidor', $usuarioId)->first();

    // Validar si el usuario no tiene ninguna unidad a su cargo
    if (!$unidad) {
        return view('reparto.reparto', [
            'guias' => collect(),
            'totales' => (object)['total' => 0, 'entregados' => 0, 'no_entregados' => 0],
            'mensaje' => 'No tienes una unidad asignada actualmente.'
        ]);
    }

    // 2. Buscamos las órdenes vinculadas a esa unidad específica
    // El campo 'unidad' en el modelo Orden debe coincidir con el ID de la unidad encontrada
    $guias = Orden::with('comercioRel')
                ->where('unidad', $unidad->id)
                ->get();

    // 3. Calculamos los totales dinámicos
    $totales = (object)[
        'total' => $guias->count(),
        'entregados' => $guias->where('estado', 'Entregado')->count(),
        'no_entregados' => $guias->where('estado', 'No entregado')->count(),
    ];

    return view('reparto.reparto', compact('guias', 'totales', 'unidad'));
}

    public function noEntregados()
    {
        

        return view('reparto.noentregados');
    }

    public function verificarNoEntregado(Request $request)
{
    $guia = $request->guia;

    // Cargamos la relación y seleccionamos los campos necesarios
    $envio = Orden::with('comercioRel')
                  ->where('guia', $guia)
                  ->first();

    if (!$envio) {
        return response()->json(['exists' => false]);
    }

    return response()->json([
        'exists' => true,
        'envio'  => [
            'guia'            => $envio->guia,
            'comercio_rel'    => $envio->comercioRel,
            'destinatario'    => $envio->destinatario,
            'destino'         => $envio->destino, // Agregado
            'estado'          => $envio->estado,
            'agencia'         => $envio->agencia, // Agregado
            'tipo_asignacion' => $envio->tipo_asignacion, // Agregado
            'caja'            => $envio->caja // Agregado
        ]
    ]);
    
}


    public function actualizarLote(Request $request)
{
    // 1. Validar que vengan guías
    $request->validate([
        'guias' => 'required' // El JSON string del input hidden
    ]);

    try {
        DB::beginTransaction();

        // 2. Decodificar el JSON que enviamos desde el JS
        $guiasArray = json_decode($request->guias);

        if (empty($guiasArray)) {
            return back()->with('error', 'La lista de guías está vacía.');
        }

        // 3. Actualización masiva de las órdenes
        // Buscamos por el campo 'guia' y cambiamos el 'estado'
        Orden::whereIn('guia', $guiasArray)->update([
            'estado' => 'No entregado',
            // Opcional: puedes registrar qué usuario hizo el cambio o la fecha
            // 'usuario_actualiza' => auth()->id(), 
            // 'fecha_no_entregado' => now()
        ]);

        foreach ($guiasArray as $guia) {
            $orden = Orden::where('guia', $guia)->first();
            if ($orden) {
                $hestado = new Hestado();
                $hestado->idenvio = $orden->id;
                $hestado->estado = "No entregado";
                $hestado->nota = "El paquete se ha marcado como No entregado. " ;
                $hestado->usuario = Auth::user()->name;
                $hestado->save();
            }
        }

        DB::commit();

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Se han actualizado ' . count($guiasArray) . ' paquetes correctamente.');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Ocurrió un error al actualizar el lote: ' . $e->getMessage());
    }
}
}
