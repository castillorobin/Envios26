<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estatus;
use App\Models\Pedido;
use App\Models\Repartidor;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use \PDF;

class EstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          //$pedidos = Pedido::all();
       // $repartidores = Repartidor::all();
       $pedidosestado = Estatus::all();
       foreach($pedidosestado as $estado){
        $estado->delete();
    }
       return view('estatus.index');
    }

    public function emanual()
    {
         
        $repartidores = Repartidor::all();
       $pedidosestado = Estatus::all();
       foreach($pedidosestado as $estado){
        $estado->delete();
    }
       return view('estatus.estadomanual', compact('repartidores') );
    }

    public function elote()
    {
         
        $repartidores = Repartidor::all();
       $pedidosestado = Estatus::all();
       foreach($pedidosestado as $estado){
        $estado->delete();
        }
       return view('estatus.estadolote', compact('repartidores') );
    }

    public function manualfiltro(Request $request)
    {
        $filtro = 1;
        $ftipo= 1;
        $pedidos = new Pedido();
        $pedidosall = new Pedido();
        $pedidosall = Pedido::all();
        $pedidosf = collect([$pedidosall]) ;
        $fecha = $request->get('fecha');
        $pedidos = $pedidosall;
        
        $estado = $request->estado;
        $repartidor2 = $request->repartidor;
        if(!$request->repartidor && $request->estado){      
            $pedidos = Pedido::wherein('estado', $estado)->get();
        }else if ($request->repartidor && !$request->estado){
            $pedidos = Pedido::wherein('repartidor', $repartidor2)->get();
        }else if ($request->repartidor && $request->estado){
            $pedidos = Pedido::wherein('estado', $estado)->wherein('repartidor', $repartidor2)->get();
        }


        //$pedidos = Pedido::wherein('estado', $estado)->wherein('repartidor', $repartidor)->get();
        
        $pedidos = $pedidos->intersect(Pedido::whereIn('fecha_entrega', [$fecha])->get());
        $repartidores = Repartidor::all();
        return view('estatus.estadomanualfiltro', compact('pedidos','repartidores', 'filtro', 'ftipo', 'fecha', 'estado', 'repartidor2'));
        
       

    }

    public function lotefiltro(Request $request)
    {
        $filtro = 1;
        $ftipo= 1;
       
        $pedidos = new Pedido();
        $pedidosall = new Pedido();
        $pedidosall = Pedido::all();
        $pedidosf = collect([$pedidosall]) ;
        $fecha = $request->get('fecha');
        $pedidos = $pedidosall;
        
        $estado = $request->estado;
        $repartidor = $request->repartidor;
        if(!$request->repartidor && $request->estado){      
            $pedidos = Pedido::wherein('estado', $estado)->get();
        }else if ($request->repartidor && !$request->estado){
            $pedidos = Pedido::wherein('repartidor', $repartidor)->get();
        }else if ($request->repartidor && $request->estado){
            $pedidos = Pedido::wherein('estado', $estado)->wherein('repartidor', $repartidor)->get();
        }


        //$pedidos = Pedido::wherein('estado', $estado)->wherein('repartidor', $repartidor)->get();
        
        $pedidos = $pedidos->intersect(Pedido::whereIn('fecha_entrega', [$fecha])->get());
        $repartidores = Repartidor::all();
       /* $fecha = ' ';
        $estado = ' ';
        $repartidor = ' ';
        */
        return view('estatus.estadolotefiltro', compact('pedidos','repartidores', 'filtro', 'ftipo'));

       
        

    }



    public function listaestatus(Request $request)
    {

        //$pedidos = Pedido::all();
       // $repartidores = Repartidor::all();
       $id = $request->get('codigo') ;
       $pedido = Pedido::find($id);
       $pedidoesta = Estatus::find($id);
       $pedidos = new Estatus();
       $pedidoadd = new Estatus(); 
       
        if(Estatus::where('id', $id )->exists()){
            $nota="Registro Duplicado";
            $pedidos = Estatus::all();
            $repartidores = Repartidor::all();
            return view('estatus.cambiarestatus', compact('pedidos', 'nota','repartidores'));

        }elseif(Pedido::where('id', $id )->exists() == 0){
            $nota="El envio no existe";
            $pedidos = Estatus::all();
            $repartidores = Repartidor::all();
            return view('estatus.cambiarestatus', compact('pedidos', 'nota','repartidores'));
 
        } 
        else{

            
       $pedido = Pedido::find($id);
       //$pedidos = collect([$pedido]);
       $pedidoadd->id = $pedido->id;
       $pedidoadd->vendedor = $pedido->vendedor;
        $pedidoadd->destinatario = $pedido->destinatario;
        $pedidoadd->telefono = $pedido->telefono;
        $pedidoadd->direccion = $pedido->direccion;
        $pedidoadd->fecha_entrega = $pedido->fecha_entrega;
        $pedidoadd->precio = $pedido->precio;
        $pedidoadd->envio = $pedido->envio;
        $pedidoadd->total = $pedido->total;
        $pedidoadd->estado = $pedido->estado;
        $pedidoadd->pagado = $pedido->pagado;
        $pedidoadd->servicio = $pedido->servicio;
        $pedidoadd->tipo = $pedido->tipo;
        $pedidoadd->nota = $pedido->nota;
        $pedidoadd->ingresado = $pedido->ingresado;
        $pedidoadd->agencia = $pedido->agencia;
        $pedidoadd->repartidor = $pedido->repartidor;
        $pedidoadd->ruta = $pedido->ruta;

       $pedidoadd->save();
      //$pedidos->add($pedido);
      $repartidores = Repartidor::all();
        $pedidos = Estatus::all();
        $nota=" ";
       return view('estatus.cambiarestatus', compact('pedidos', 'nota','repartidores'));

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
    public function cestadomanual(Request $request)
    {
        
       // $repartidores = Repartidor::all();
        //return view('pedido.repartir', compact('pedidos'));

        $id = $request->get('proba') ;
        $fecha = $request->get('fecham') ;
        //$estado = $request->estadom ;
        //$repartidor2 = $request->repartidorm ;

        $pedido = Pedido::find($id);
       
        $pedido->estado = $request->get('estadom');
        if($request->get('repartidorm')){
            $pedido->repartidor = $request->get('repartidorm');
        }
        if($request->get('estante')){
            $pedido->estante = $request->get('estante');
        }
        if($request->get('nota')){
            $pedido->nota = $request->get('nota');
        }

        $pedido->save();
        return redirect()->back();



    }
    public function cestadolote(Request $request)
    {
         
      
       // $repartidores = Repartidor::all();
        //return view('pedido.repartir', compact('pedidos'));

        $id = $request->get('proba') ;
        $fecha = $request->get('fecham') ;
        //$estado = $request->estadom ;
        //$repartidor2 = $request->repartidorm ;
        $checked = $request->input('checked');
       $pedidos = Pedido::query()->find($checked);

       if($pedidos){
        foreach($pedidos as $pedido){
            $pedido->estado = $request->get('estadom');
            if($request->get('repartidorm')){
                $pedido->repartidor = $request->get('repartidorm');
            }
            if($request->get('estante')){
                $pedido->estante = $request->get('estante');
            }
            if($request->get('nota')){
                $pedido->nota = $request->get('nota');
            }
            
            


            $pedido->save();

            }
       }else{
        
        return redirect()->back();
      
       }

       // $pedido = Pedido::find($id);
       
        
        
        return redirect()->back();



    }

    public function cambiando(Request $request)
    {
        $id = $request->get('proba') ;


        $pedidosestado = Estatus::all();
        
        
        foreach($pedidosestado as $estado){
            $pedido = Pedido::find($estado->id);
            $pedidoes = Estatus::find($estado->id);
            
            $pedido->estado = $request->get('estado');
            $pedidoes->estado = $request->get('estado');


            if ($request->check2) {
                // Do something
                $pedido->repartidor = $request->get('repartidor');
                $pedidoes->repartidor = $request->get('repartidor');
            }
            if ($request->check3) {
                // Do something
                $pedido->estante = $request->get('estante');
                $pedidoes->estante = $request->get('estante');
            }
            $pedido->save();
            $pedidoes->save();
            //$estado->estado = $request->get('estado');
            //$estado->save();
        }
        $pedidos = Estatus::all();
        
        foreach($pedidosestado as $estado){
            $estado->delete();
        }
        
        if(isset($_GET['impri']))
        {

        $pdf = PDF::loadView('estatus.estatusimprimir', ['pedidos'=>$pedidos]);
       
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
        }else{
            return view('estatus.index');
        }
        

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
