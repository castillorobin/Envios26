<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unidad;
use App\Models\Caja;
use App\Models\DetalleCaja;
use Illuminate\Support\Str;



class ReportesController extends Controller
{
    
    public function reportecajas()
    {
        // Lógica para generar el reporte de cajas
        $usuarios = User::all(); // Ejemplo de obtención de datos, puedes ajustar según tus necesidades
       // $unidades = Unidad::all(); // Ejemplo de obtención de datos, puedes ajustar según tus necesidades
        return view('reportes.buscarreporte', compact('usuarios'));
       
    }
  public function crearreportecaja(Request $request)
{
    $usuario = $request->input('usuario');
    $fecha = $request->input('fecha');

    $detalles = DetalleCaja::where('cajero', $usuario)
                ->whereDate('created_at', $fecha)
                ->get();

    // --- 1. Totales Específicos (Filtros por concepto) ---
    $totalPagos = $detalles->filter(fn($item) => Str::startsWith($item->concepto, 'Pago'))->sum('valor');
    $totalEntregas = $detalles->filter(fn($item) => Str::startsWith($item->concepto, 'Entrega'))->sum('valor');
    $totalRecepciones = $detalles->filter(fn($item) => Str::startsWith($item->concepto, 'Recepción'))->sum('valor');

    // --- 2. Otros Movimientos (Excluyendo los anteriores) ---
    $otrosMovimientos = $detalles->reject(function ($item) {
        return Str::startsWith($item->concepto, 'Pago') || 
               Str::startsWith($item->concepto, 'Entrega') || 
               Str::startsWith($item->concepto, 'Recepción');
    });

    $otrosIngresos = $otrosMovimientos->where('tipo', 'Entrada')->sum('valor');
    $otrosGastos = $otrosMovimientos->where('tipo', 'Salida')->sum('valor');

    // --- 3. GRAN TOTAL DE TODO (Sin excepciones) ---
    // Sumamos todo lo que entró y todo lo que salió de la caja
    $totalGeneralEntradas = $detalles->where('tipo', 'Entrada')->sum('valor');
    $totalGeneralSalidas = $detalles->where('tipo', 'Salida')->sum('valor');
    
    // El balance neto que debería haber en caja
    $balanceCaja = $totalGeneralEntradas - $totalGeneralSalidas;

    $caja = Caja::where('cajero', $usuario)
                ->whereDate('created_at', $fecha)
                ->get();
//dd($usuario, $fecha);
    return view('reportes.caja', compact(
        'usuario', 'fecha', 'detalles', 
        'totalPagos', 'totalEntregas', 'totalRecepciones',
        'otrosIngresos', 'otrosGastos',
        'totalGeneralEntradas', 'totalGeneralSalidas', 'balanceCaja', 'caja'
    ));
}

    public function reporteunidades()
    {
         $unidades = Unidad::all(); // Ejemplo de obtención de datos, puedes ajustar según tus necesidades
        return view('reportes.buscarreporteunidad', compact('unidades'));
    }
}
