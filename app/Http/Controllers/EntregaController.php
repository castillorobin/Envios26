<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;

class EntregaController extends Controller
{
    public function index()
    {
        
        return view('entrega.entrega');


    }

    public function buscarGuiaEntrega(Request $request)
    {
        $guia = \App\Models\Orden::where('guia', $request->guia)->first();

        if (!$guia) {
            return response()->json(['success' => false, 'message' => 'La guía no existe.']);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'guia' => $guia->guia,
                'comercio' => $guia->comercioRel ? $guia->comercioRel->nombre : 'S/C',
                'precio' => $guia->total, // Asumiendo que este es el campo total de la orden
                'fecha' => \Carbon\Carbon::parse($guia->fecha_entrega)->format('d/m/Y'),
                'estado' => $guia->estado
            ]
        ]);
    }
}
