<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;
use App\Models\Conceptocaja;
use App\Models\Detallecaja;
use App\Models\Empleado;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteCajasExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cajas = Detallecaja::whereDate('created_at', Carbon::today())
    ->where('cajero', Auth::user()->name)
    ->get();
    $empleado = User::where('nombre', Auth::user()->name)->get();
    $conceptos = Conceptocaja::all();
        return view('caja.movimientos', compact('cajas', 'empleado', 'conceptos'));
    }

    public function configuracion()
    {
        $cajas = Conceptocaja::all();
    
        return view('caja.configuracion', compact('cajas'));
    }

    public function cajero()
    {
         $conceptos = Conceptocaja::all();
       // $cajas = Detallecaja::all();
        
        //$cajas = Detallecaja::where('created_at', Carbon::today());

        $cajas = Detallecaja::whereDate('created_at', Carbon::today())
    ->where('cajero', Auth::user()->name)
    ->get();

        $empleado = Empleado::where('nombre', Auth::user()->name)->get();

       // dd($empleado);
         return view('caja.cajero', compact('cajas', 'conceptos', 'empleado'));
    }
    public function cuadre()
    {
        $cajas = Caja::all();
        $repartidores = User::all();
        return view('caja.cuadre', compact('cajas', 'repartidores'));
    }

    public function listado($id)
    {
         $empleado = User::where('nombre', Auth::user()->name)->get();
         $conceptos = Conceptocaja::all();
        $cajas = Detallecaja::where('idcaja', $id)
        ->get();
        $cajapr = Caja::where('id', $id)
        ->get();
         return view('caja.listado', compact('cajas', 'cajapr', 'empleado', 'conceptos'));
    }
    public function ajustes()
    {
        $cajas = Conceptocaja::all();
         return view('ruta.ajustescaja', compact('cajas'));
    }

    public function guardarconcepto(Request $request)
    {
        $tipo = $request->get('tipo') ;
        $concepto = $request->get('concepto') ;

        $conce = new Conceptocaja();
        $conce->tipo = $tipo ;
        $conce->concepto = $concepto ;
        $conce->save();
        return redirect()->back()->with('success', 'Registro guardado correctamente');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function editar($id)
    {
         $ruta = Conceptocaja::find($id);
         return view('ruta.editarajustecaja', compact('ruta'));
    }

    public function editandoconcepto(Request $request)
    {
        $id = $request->get('id') ;
        $tipo = $request->get('tipo') ;
        $concepto = $request->get('concepto') ;
        $conce = Conceptocaja::find($id);
        $conce->tipo = $tipo ;
        $conce->concepto = $concepto ;
        $conce->save();
         
         $cajas = Conceptocaja::all();
         return view('ruta.ajustescaja', compact('cajas'));
    }
    public function eliminar($id)
    {
        $ruta = Conceptocaja::find($id);
         $ruta->delete();
    
      $cajas = Conceptocaja::all();
        return redirect()->back()->with('success', 'Registro Eliminado correctamente');
    }

    public function exportarticket($id)
    {
/*
        $idcaja = Caja::where('cajero', $cajero)
        ->where('estado', 0)
        ->get();
*/
         $idcaja2= Caja::find($id);

        $pdf = PDF::loadView('caja.cierreticket', ['idcaja2'=>$idcaja2]);
           $customPaper = array(0,0,360,750);
       
           $pdf->setPaper($customPaper );
        return $pdf->stream();
     
    }

    public function exportarpdf($id)
    {
/*
        $idcaja = Caja::where('cajero', $cajero)
        ->where('estado', 0)
        ->get();
*/
         $idcaja2= Caja::find($id);

        $cajas = Detallecaja::where('idcaja', $id)->get();
        
        $pdf = PDF::loadView('caja.ticketpdf', ['idcaja2'=>$idcaja2, 'cajas'=>$cajas])->setPaper('letter', 'landscape');
         //  $customPaper = array(0,0,360,750);
       
           //$pdf->setPaper($customPaper );
        return $pdf->stream();
     
    }

    public function exportarExcel($id)
    {

         $caja = Caja::findOrFail($id);

    return Excel::download(
        new ReporteCajasExport(
            $id,
            $caja->saldo,
            $caja->descuadre,
            $caja->cajero,
            $caja->created_at->format('d/m/Y H:i A')
        ),
        'detalle_caja_' . $id . '.xlsx'
    );

    //return Excel::download(new ReporteCajasExport($idcaja), 'detalle_caja_'.$idcaja.'.xlsx');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // $tipo = $request->get('tipo') ;
        $cajero = $request->get('cajero') ;

        $conce = $request->get('concepto');
        $saldocajero = $request->get('valor_cierre');
        $saldofinal = $request->get('saldo_final');

        $conceptoreg = Conceptocaja::find($conce);

       $tipo = $conceptoreg->tipo;

      //  dd($conceptoreg->tipo);

        if ($conceptoreg->concepto == "Apertura de caja") {
           // dd("Caja inicial");
           
        $idcaja = Caja::where('cajero', $cajero)
        ->where('estado', 0)
        ->get();

        if(!$idcaja->isEmpty()){

           // dd("se fue");

          // return redirect()->back()->with('Error', 'Debe de abrir caja antes de agregar movimientos');
           return redirect()->route('cajero')->with('Error', 'Ya existe una sesion de caja abierta');
           
        }
           $caja = new Caja();
           $caja->cajero = $request->get('cajero') ;
           $caja->save();
        }


        $idcaja = Caja::where('cajero', $cajero)
        ->where('estado', 0)
        ->get();

        if($idcaja->isEmpty()){

           // dd("se fue");

          // return redirect()->back()->with('Error', 'Debe de abrir caja antes de agregar movimientos');
           return redirect()->route('cajero')->with('Error', 'Debe de abrir caja antes de agregar movimientos');
           
        }



        $ultimoMovi = Detallecaja::where('idcaja', $idcaja[0]->id)
                ->latest('id') // o cualquier columna de ordenamiento como created_at
                ->first();

       //  dd($ultimoMovi->tipo);
       if ($conceptoreg->concepto == "Apertura de caja") {
        $saldomovi = $request->get('valor') ;
       }else {
        $saldomovi = $ultimoMovi->saldo;
       }
       
$saldo = 0;
     //  dd($ultimoMovi);

    $movimiento = new Detallecaja();
    
    $movimiento->cajero = $request->get('cajero') ;
    $movimiento->agencia = $request->get('agencia') ;
    $movimiento->tipo = $conceptoreg->tipo ;
    $movimiento->concepto = $conceptoreg->concepto ;
    $movimiento->valor = $request->get('valor') ;
    
    
    
    if ($tipo == "Entrada") {
        $movimiento->saldo = $saldomovi + $request->get('valor') ;
        $saldo = $saldomovi + $request->get('valor');
    }
    if ($conceptoreg->concepto == "Apertura de caja") {
        $movimiento->saldo = $saldomovi;
        $saldo = $saldomovi;
    }

    if ($tipo == "Salida") {
        $movimiento->saldo = $saldomovi - $request->get('valor') ;
        $saldo = $saldomovi - $request->get('valor') ;
    }
    
    if ($conceptoreg->concepto == "Cierre de caja") {

       $movimiento->valor = $saldocajero ;
       $movimiento->saldo = $saldofinal;
        
    }
        

    $movimiento->idcaja = $idcaja[0]->id ;
    $movimiento->save();

    $movis = Detallecaja::where('idcaja', $idcaja[0]->id)
        ->get();

        
    if ($conceptoreg->concepto == "Cierre de caja") {

          $idcaja2= Caja::find($idcaja[0]->id);

           $idcaja2->estado = 1 ;
           
           $idcaja2->saldo = $saldo ;

           $idcaja2->saldocajero = $saldocajero ; 
            $idcaja2->descuadre = $saldofinal;
           $idcaja2->save();
/*

           $pdf = PDF::loadView('caja.cierreticket', ['idcaja2'=>$idcaja2]);
           $customPaper = array(0,0,360,750);
       
           $pdf->setPaper($customPaper );
        //return $pdf->stream('cierrecaja.pdf');
        return $pdf->download('cierrecaja.pdf');
       */
        }

    // Redirigir o mostrar mensaje
    //return redirect()->back()->with('success', 'Registro guardado correctamente');
    return redirect()->route('cajero')->with('success', 'Registro guardado correctamente');

    }


    public function listadofiltro(Request $request)
    {
        
        $rango = $request->input('rango');
        $usuario = $request->input('usuario');
        $parte1 = Str::of($rango)->explode('-');
        $fecha1 = $parte1[0];
        $fecha2 = $parte1[1];
        //$partenueva1 = Carbon::createFromFormat('m/d/Y',$fecha1)->format('Y-m-d');
        $fechacam1 = date('Y-m-d H:i:s', strtotime($fecha1)) ;
        $fechacam2 = date('Y-m-d 23:59:50', strtotime($fecha2)) ;

       // dd($fechacam1, $fechacam2);

        if($usuario == "todos")
        {
            $cajas = Caja::whereBetween('created_at', [$fechacam1, $fechacam2])
            ->get();
 
        }else{
            $cajas = Caja::whereBetween('created_at', [$fechacam1, $fechacam2])
            ->where('cajero', $usuario)
            ->get();
        }

      
        $repartidores = User::all();
        return view('caja.jefe', compact('repartidores', 'cajas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Caja $caja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Caja $caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $caja)
    {
        //
    }
}
