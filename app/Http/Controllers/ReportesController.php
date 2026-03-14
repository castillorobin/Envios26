<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    
    public function reportecajas()
    {
        // Lógica para generar el reporte de cajas
        return view('reportes.caja');
    }
}
