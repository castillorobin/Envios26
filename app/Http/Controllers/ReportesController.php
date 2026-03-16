<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unidad;

class ReportesController extends Controller
{
    
    public function reportecajas()
    {
        // Lógica para generar el reporte de cajas
        $usuarios = User::all(); // Ejemplo de obtención de datos, puedes ajustar según tus necesidades
        $unidades = Unidad::all(); // Ejemplo de obtención de datos, puedes ajustar según tus necesidades
        return view('reportes.buscarreporte', compact('usuarios', 'unidades'));
       
    }
}
