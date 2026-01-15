<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;
use App\Models\Pedido;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Repartidor;
class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedores = Vendedor::all();
        setlocale(LC_TIME, "spanish");
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");
        //return view('vendedor.index')->with(['vendedores'=>$vendedores, 'date'=>$date]);
        return view('vendedor.index', compact('vendedores'));
    }

    public function filtrado($comercio)
    {
        $vendedores = Vendedor::where('nombre', $comercio)->get();
        $vendedorestotal = Vendedor::all();
        setlocale(LC_TIME, "spanish");
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");
        //return view('vendedor.index')->with(['vendedores'=>$vendedores, 'date'=>$date]);
        return view('vendedor.inicio', compact('vendedores', 'vendedorestotal'));
    }
 
    public function comercios()
    {
        //$vendedores = Vendedor::where('nombre', $comercio)->get();
        setlocale(LC_TIME, "spanish");
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");
        //return view('vendedor.index')->with(['vendedores'=>$vendedores, 'date'=>$date]);
        return view('vendedor.comercio');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last = Vendedor::latest('id')->first();
        $lastid =$last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        $vendedores = Vendedor::all();
        setlocale(LC_TIME, "spanish");
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");
        return view('vendedor.create')->with(['vendedores'=>$vendedores, 'date'=>$date, 'uid'=>$uid]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendedor = new Vendedor();
        $vendedor->nombre = $request->get('nombre');
        $vendedor->direccion = $request->get('direccion');
        $vendedor->telefono = $request->get('telefono');
        $vendedor->whatsapp = $request->get('whatsapp');
        
        $vendedor->falta = date("Y-m-d", strtotime($request->get('falta')));
        $vendedor->fbaja = $request->get('fbaja');
        $vendedor->tipovende = $request->get('tipoven');
        $vendedor->correo = $request->get('correo');
        $vendedor->titular = $request->get('titular');
        $vendedor->banco = $request->get('banco');
        $vendedor->cuenta = $request->get('ncuenta');
        $vendedor->tcuenta = $request->get('tcuenta');
        $vendedor->chivo = $request->get('chivo');
        $vendedor->tmoney = $request->get('tmoney');
        $vendedor->empresa = $request->get('empresa');
        $vendedor->giro = $request->get('giro');
        $vendedor->dui = $request->get('dui');
        $vendedor->niva = $request->get('niva');

        $vendedor->nrc = $request->get('nrc');
        $vendedor->estado = $request->get('estado');
        
                
        $vendedor->save();

        $vendedores = Vendedor::all();
        
        setlocale(LC_TIME, "spanish");
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");
        return view('vendedor.index')->with(['vendedores'=>$vendedores, 'date'=>$date]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function guardar(Request $request)
    {  
        $vendedor = new Vendedor();
        $vendedor->nombre = $request->get('nombre');
        $vendedor->direccion = $request->get('direccion');
        $vendedor->telefono = $request->get('telefono');
        $vendedor->whatsapp = $request->get('whatsapp');
        $vendedor->falta = $request->get('falta');
        $vendedor->fbaja = $request->get('fbaja');
        $vendedor->tipovende = $request->get('tipoven');
        $vendedor->correo = $request->get('correo');
        $vendedor->titular = $request->get('titular');
        $vendedor->banco = $request->get('banco');
        $vendedor->cuenta = $request->get('ncuenta');
        $vendedor->tcuenta = $request->get('tcuenta');
        $vendedor->chivo = $request->get('chivo');
        $vendedor->tmoney = $request->get('tmoney');
        $vendedor->empresa = $request->get('empresa');
        $vendedor->giro = $request->get('giro');
        $vendedor->dui = $request->get('dui');
        $vendedor->niva = $request->get('niva');
        $vendedor->agencia = $request->get('agenr');
       
        $vendedor->nrc = $request->get('nrc');
        $vendedor->estado = $request->get('estado');
        
                
        $vendedor->save();

        //$vendedores = Vendedor::all();
        
        //setlocale(LC_TIME, "spanish");
        //$date = Carbon::today();
        //$date = $date->format('l jS F Y');
       // $date = strftime("%A %d de %B %Y");
        //return view('pedido.create')->with(['vendedores'=>$vendedores, 'date'=>$date]);

        //return redirect('/pedidos/create');
        $usuarios = User::all();
        $last = Pedido::latest('id')->first();
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        $repartidores = Repartidor::all();
        $fecha = Carbon::today();
        //$date = $date->format('l jS F Y');
        $fecha = strftime("%A %d de %B %Y");
        if(isset($_POST['person']))
        {
            return view('pedido.personalizado')->with(['vendedores'=>$vendedores, 'fecha'=>$fecha, 'repartidores'=>$repartidores, 'last'=>$last, 'usuarios'=>$usuarios]);
        }elseif(isset($_POST['pfijo']))
        {
        return view('pedido.puntofijo')->with(['vendedores'=>$vendedores, 'fecha'=>$fecha, 'repartidores'=>$repartidores, 'last'=>$last, 'usuarios'=>$usuarios]);
        }elseif(isset($_POST['casi']))
        {
        return view('pedido.casillero')->with(['vendedores'=>$vendedores, 'fecha'=>$fecha, 'repartidores'=>$repartidores, 'last'=>$last, 'usuarios'=>$usuarios]);
        }else{
            return view('pedido.create')->with(['vendedores'=>$vendedores, 'fecha'=>$fecha, 'repartidores'=>$repartidores, 'last'=>$last, 'usuarios'=>$usuarios]);
        }

        
    }
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
        $vendedor = Vendedor::find($id);
        $last = Vendedor::latest('id')->first();
        $lastid = $last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        return view('vendedor.edit')->with(['vendedor'=>$vendedor , 'uid'=>$uid]);
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
        $vendedor = Vendedor::find($id) ;
        $vendedor->nombre = $request->get('nombre');
        $vendedor->direccion = $request->get('dire');
        $vendedor->telefono = $request->get('tele');
        $vendedor->whatsapp = $request->get('what');
        $vendedor->falta =  date('Y/m/d', strtotime($request->get('falta')));
        $vendedor->fbaja = date('Y/m/d', strtotime($request->get('fbaja')));
        $vendedor->tipovende = $request->get('tipoven');
        $vendedor->correo = $request->get('correo');
        $vendedor->estado = $request->get('estado');
        $vendedor->agencia = $request->get('agenr');
        $vendedor->titular = $request->get('titular');
        $vendedor->banco = $request->get('banco');
        $vendedor->cuenta = $request->get('cuenta');
        $vendedor->tcuenta = $request->get('tcuenta');
        $vendedor->chivo = $request->get('chivo');
        $vendedor->tmoney = $request->get('money');
        $vendedor->empresa = $request->get('empresa');
        $vendedor->giro = $request->get('giro');
        $vendedor->dui = $request->get('dui');
        $vendedor->niva = $request->get('iva');
        $vendedor->nrc = $request->get('nrc');
 
        $vendedor->save();
        //return redirect('/vendedores');
        $vendedores = Vendedor::all();
        return view('vendedor.index')->with(['vendedores'=>$vendedores]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Vendedor::find($id);
        $pedido->delete();
        return redirect('/vendedores');
    }
}
