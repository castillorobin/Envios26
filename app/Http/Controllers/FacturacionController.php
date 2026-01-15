<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Facturacion;
use App\Models\Pedido;
use App\Models\Vendedor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use \PDF; 
use Illuminate\Support\Facades\DB;
 
class FacturacionController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        //$pedidos = Pedido::all();
	
	$pedidos = " ";

        //$vendedores = Vendedor::all();
       //$vendedores = Vendedor::select('nombre')->get();
     //  $vendedores = Vendedor::with('vendedors:id,nombre')->get();
/*
     $vendedores = DB::table('vendedors')
            ->select('nombre')
            ->get();

      // dd($vendedores);



      $vendedores = DB::table('vendedors')
      ->where('nombre', 'like', '%mod%')
      ->get();
        

*/
$nota=" ";

       //$repartidores = Repartidor::all();
       return view('factura.index')->with(['pedidos'=>$pedidos, 'nota'=>$nota  ]);
//	return view('factura.mensaje);


    }

	public function iniciando()
    {
        $pedidos = Pedido::all();
        $vendedores = Vendedor::all();
        $nota=" ";
       //$repartidores = Repartidor::all();
       return view('factura.index')->with(['pedidos'=>$pedidos, 'vendedores'=>$vendedores, 'nota'=>$nota  ]);

    }	

 
    public function listado()
    {
        //$pedidos = Pedido::all();
       // $vendedores = Vendedor::all();

        $nota=" "; 
       //$repartidores = Repartidor::all();
       return view('factura.listado')->with(['nota'=>$nota  ]);

    }
    public function listado2(Request $request)
    {
        //$pedidos = Pedido::all();
       // $vendedores = Vendedor::all();
       $comercio = $request->input('comercio');
       $vendedores = DB::table('vendedors')
       ->where('nombre', 'like', '%' . $comercio . '%')
       ->get();
        $nota=" "; 
       //$repartidores = Repartidor::all();
       return view('factura.listado2')->with(['vendedores'=>$vendedores, 'nota'=>$nota  ]);

    }

    public function listadofiltro(Request $request)
    {

        $comercio = $request->input('comercio');
        $pedidos = Pedido::where('vendedor', $comercio)
        ->where('pagado', "pagado")
        
        ->get();


        
        $rango = $request->input('rango');
        $fecha = $request->input('fecha');
       
       //$pedidos = Pedido::where('vendedor', $comercio)->get();
      
        if($rango=="ahora")
        {    
        $pedidos = $pedidos->intersect(Pedido::whereIn('fecha_entrega', [Carbon::today()])->get());    
        }
        if($rango=="semana")
        {    
            $pedidos = Pedido::where('vendedor', $comercio)
            ->whereBetween('fecha_entrega', [Carbon::now()->subWeek()->format("Y-m-d"), Carbon::now()])
            ->get();

       
        }

        if($rango=="semana2")
        {    
            $pedidos = Pedido::where('vendedor', $comercio)
            //->whereMonth('fecha_entrega', '>', [Carbon::now()->subDays(30)->format("Y-m-d"), Carbon::now()])
            ->where('fecha_entrega', '>', Carbon::now()->subDays(30))
            ->get();

        
        } 
        if($rango=="mes")
        {    
            $pedidos = Pedido::where('vendedor', $comercio)
            ->whereMonth('fecha_entrega', Carbon::now()->month)
            ->get();

        
        } 

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        
        if($desde != ""){
            $pedidos = $pedidos->intersect(Pedido::whereBetween('fecha_entrega', [$desde, $hasta])->get());

        }





        $vendedores = DB::table('vendedors')
        ->where('nombre', 'like', '%' . $comercio . '%')
        ->get();
        $facturas = Facturacion::all();
        $nota=" ";
       //$repartidores = Repartidor::all();
       return view('factura.listadofiltro')->with(['pedidos'=>$pedidos,'vendedores'=>$vendedores, 'nota'=>$nota, 'facturas'=>$facturas  ]);

    }

    public function listadopagos()
    {
        //$pedidos = Pedido::all();
        $usuarios = User::all();
        $nota=" "; 
       //$repartidores = Repartidor::all();
       return view('factura.listadopagos')->with(['usuarios'=>$usuarios, 'nota'=>$nota  ]);

    }

    public function listadopagosfiltro(Request $request)
    {

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $cajero = $request->input('usuario');
        $facturas = Facturacion::whereBetween('fechapago', [$desde, $hasta])->get();
        $facturas = $facturas->intersect(Facturacion::whereIn('cajero', [$cajero])->get());
        //$facturas = Facturacion::where('cajero', $cajero)->get();
        $usuarios = User::all();
        //$facturas = Facturacion::all();
        $nota=" ";
       //$repartidores = Repartidor::all();
       return view('factura.listadopagosfiltro')->with(['usuarios'=>$usuarios, 'nota'=>$nota, 'facturas'=>$facturas  ]);

    }
    public function detalles($id)
    {
        $pedidos = Pedido::where('detallep', $id)->get();
        //$pedidos = Pedido::all();
        //$vendedores = Vendedor::all();
        //$vende = Vendedor::where('nombre', $comercio)->get();
       //$repartidores = Repartidor::all();
       return view('factura.detallespago')->with(['pedidos'=>$pedidos]);
 
    }
    
    public function filtrocomer(Request $request)
    {
        $comercio = $request->input('comercio');

        $vendedores = DB::table('vendedors')
        ->where('nombre', 'like', '%' . $comercio . '%')
        ->get();
        //$pedidos = Pedido::where('vendedor', $comercio)->get();
        //$pedidos = Pedido::all();
       // $vendedores = Vendedor::all();
       // $vende = Vendedor::where('nombre', $comercio)->get();
       //$repartidores = Repartidor::all();
       $nota=" ";
       return view('factura.index2')->with([ 'vendedores'=>$vendedores, 'nota'=>$nota   ]);
 
    }

    public function filtro(Request $request)
    {
        $comercio = $request->input('comercio');

        $rango = $request->input('rango');
        $fecha = $request->input('fecha');
       
       $pedidos = Pedido::where('vendedor', $comercio)->get();
      
        if($rango=="ahora")
        {    
        $pedidos = $pedidos->intersect(Pedido::whereIn('fecha_entrega', [Carbon::today()])->get());    
        }
        if($rango=="semana")
        {    
            $pedidos = Pedido::where('vendedor', $comercio)
            ->whereBetween('fecha_entrega', [Carbon::now()->subWeek()->format("Y-m-d"), Carbon::now()])
            ->get();

       
        }

        if($rango=="semana2")
        {    
            $pedidos = Pedido::where('vendedor', $comercio)
            //->whereMonth('fecha_entrega', '>', [Carbon::now()->subDays(30)->format("Y-m-d"), Carbon::now()])
            ->where('fecha_entrega', '>', Carbon::now()->subDays(30))
            ->get();

        
        } 


        if($rango=="mes")
        {    
            $pedidos = Pedido::where('vendedor', $comercio)
            ->whereMonth('fecha_entrega', Carbon::now()->month)
            ->get();

        
        } 

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        
        if($desde != ""){
            $pedidos = $pedidos->intersect(Pedido::whereBetween('fecha_entrega', [$desde, $hasta])->get());

        }



        //$pedidos = Pedido::where('vendedor', $comercio)->get();
        //$pedidos = Pedido::all();
        //$vendedores = Vendedor::all();
        $vendedores = Vendedor::where('nombre', $comercio)->get();
        $vende = Vendedor::where('nombre', $comercio)->get();
       //$repartidores = Repartidor::all();
       return view('factura.inicio')->with(['pedidos'=>$pedidos, 'vendedores'=>$vendedores, 'vende'=>$vende  ]);
 
    }
  
    public function facturapdf(Request $request, $comercio)
    {
  
       // $pedidos = Pedido::all();
       $total = (float)$request->get('toti');
       $medio = $request->get('medios');

       $checked = $request->input('checked');
       $pedidos = Pedido::query()->find($checked);

       $factura = new Facturacion();

       if($pedidos){
        $factura->cajero = $request->input('cajero');
        $factura->medio = $request->input('medios');
        $factura->fechapago = $request->input('fpago');
        $factura->tipo = $request->input('comp');
        $factura->numerocompro = $request->input('ncompro');
        $factura->descuento = $request->input('descu');
        $factura->nota = $request->input('ndescu');
        $factura->total = $total;
        $factura->comercio = $comercio;

        $factura->save();
        
        

       }else{
        $nota="No se seleccionaron envios";
        //$pedidos = Pedido::all();
        $vendedores = Vendedor::all();
       //$repartidores = Repartidor::all();
       return view('factura.index')->with(['vendedores'=>$vendedores, 'nota'=>$nota  ]);
       }

       $idfactura = Facturacion::latest('id')->first();


       if($pedidos){
        foreach($pedidos as $pedido){
            $pedido->pagado = "Pagado";
            $pedido->medio = $medio;
            $pedido->detallep = $idfactura->id;

            $pedido->save();

            }
       }else{
        $nota="No se seleccionaron envios";
        //$pedidos = Pedido::all();
        $vendedores = Vendedor::all();
       //$repartidores = Repartidor::all();
       return view('factura.index')->with(['vendedores'=>$vendedores, 'nota'=>$nota  ]);
       }
      
       if($request->get('comp')=='Ticket'){
        //$pedidos = Pedido::where('vendedor', $comercio)->get();
        $descuento = (float)$request->input('descu'); 
        if($descuento>0){
            $descue=$descuento;
        }else{
            $descue= 0;
        }
 

        $pdf = PDF::loadView('factura.ticket', ['pedidos'=>$pedidos, 'total'=>$total, 'descue'=>$descue]);
       
        $pdf->setPaper('b6', 'portrait');
        return $pdf->stream();

       }
       
       if($request->get('comp')=='PDF'){


        $descuento = (float)$request->input('descu'); 
        if($descuento>0){
            $descue=$descuento;
        }else{
            $descue= 0;
        }
   
        $pdf = PDF::loadView('factura.facturapdf', ['pedidos'=>$pedidos, 'total'=>$total, 'descue'=>$descue]);
   
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
       }
       
       if($request->get('comp')!='PDF' && $request->get('comp')!='Ticket'){
   
       $nota="";
        $vendedores = Vendedor::all();
 
       return view('factura.index')->with(['pedidos'=>$pedidos, 'vendedores'=>$vendedores, 'nota'=>$nota  ]);
       }

      
        //return $pdf->download('factura.pdf');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
