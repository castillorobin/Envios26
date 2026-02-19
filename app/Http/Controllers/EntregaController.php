<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\Entrega;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
                'destinatario' => $guia->destinatario,
                'precio' => $guia->total, // Asumiendo que este es el campo total de la orden
                'fecha' => \Carbon\Carbon::parse($guia->fecha_entrega)->format('d/m/Y'),
                'estado' => $guia->estado
            ]
        ]);
    }

    public function guardar(Request $request)
    {
        // 1. Validar que al menos venga una guía
        $request->validate([
            'guias' => 'required|array|min:1',
            'subtotal' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'metodo_pago' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // 2. Crear el registro base de la entrega
            $entrega = new Entrega();
            $entrega->subtotal = $request->subtotal;
            $entrega->descuento = $request->descuento ?? 0;
            $entrega->nota = $request->nota;
            $entrega->metodo = $request->metodo_pago;
            $entrega->usuario = Auth::user()->name;
            $entrega->save();

            // 3. Generar el código (Año + ID) y actualizar el mismo registro
            $codigoGenerado = date('Y') . $entrega->id;
            $entrega->codigo = $codigoGenerado;
            $entrega->save();

            // 4. Actualizar todas las guías de la lista
            // Buscamos las guías cuyo código 'guia' esté en el array recibido
            Orden::whereIn('guia', $request->guias)->update([
                'entrega' => $codigoGenerado,
                //'estado' => 'Entregado' // Opcional: actualizar el estado a entregado
            ]);

            DB::commit();

            return redirect()->route('entrega') // O la ruta que prefieras
                ->with('success', "Entrega #{$codigoGenerado} registrada correctamente.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al procesar la entrega: ' . $e->getMessage())->withInput();
        }
    }
}
