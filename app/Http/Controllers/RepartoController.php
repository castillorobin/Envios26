<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\Unidad; // Asumiendo que existe el modelo
use Illuminate\Support\Facades\Auth;

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
}
