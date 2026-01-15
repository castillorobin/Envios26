<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Vendedor;
use App\Models\Repartidor;
use App\Models\Filtroganan;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use \PDF; 
use Illuminate\Support\Facades\Response;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$pedidos = Pedido::all();
        $pedidos = Pedido::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
               // $repartidores = Repartidor::all();
        $vendedores = Vendedor::all();
        $nota= ' ';
        return view('pedido.index', compact('pedidos','vendedores','nota'));


    }
	
    public function noretirado()
    {
        //$pedidos = Pedido::all();
        //$pedidos = Pedido::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        $repartidores = Repartidor::all();
        //$vendedores = Vendedor::all();
        $nota= ' ';
        return view('pedido.reporteestado', compact('repartidores','nota'));


    }
    public function noretiradofiltro(Request $request)
    {
        
        //$pedidos = Pedido::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        $repartidores = Repartidor::all();
        //$vendedores = Vendedor::all();

        $repartidor = $request->input('repartidor');
        $rango = $request->input('rango');
        $estado = $request->input('estado');

           
        $pedidos = Pedido::where('repartidor', $repartidor)->get();   


        if($rango=="ahora")
        {    
        $pedidos = $pedidos->intersect(Pedido::whereIn('fecha_entrega', [Carbon::today()])->get());    
        }
        if($rango=="semana")
        {    
            $pedidos = Pedido::where('repartidor', $repartidor)
            ->whereBetween('fecha_entrega', [Carbon::now()->subWeek()->format("Y-m-d"), Carbon::now()])
            ->get();

       
        }

        if($rango=="semana2")
        {    
            $pedidos = Pedido::where('repartidor', $repartidor)
            //->whereMonth('fecha_entrega', '>', [Carbon::now()->subDays(30)->format("Y-m-d"), Carbon::now()])
            ->where('fecha_entrega', '>', Carbon::now()->subDays(30))
            ->get();

        
        } 
        if($rango=="mes")
        {    
            $pedidos = Pedido::where('repartidor', $repartidor)
            ->whereMonth('fecha_entrega', Carbon::now()->month)
            ->get();

        
        }  

        if($estado != "estado")
        {    
        $pedidos = $pedidos->intersect(Pedido::whereIn('estado', [$estado])->get());    
        }



       
        return view('pedido.noretiradofiltro', compact('repartidores', 'pedidos'));


    }

    public function cambiarnt($id)
    {
        
        $pedido = Pedido::find($id);
        $pedido->estado = "No retirado";
        $pedido->save();

        return redirect()->back();





    }
	
    public function indexdigitado()
    {
        
       //$pedidos = Pedido::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
             
        $vendedores = Vendedor::all();
        $nota= ' ';

        
        return view('pedido.indexdigitado', compact('vendedores','nota'));


    }

    public function indexfiltrocomer(Request $request)
    {
        
        $nota= ' ';
        $comercio = $request->input('comercio');
       // $rango = $request->input('rango');
      //  $fecha = $request->input('fecha');
       
      // $pedidos = Pedido::where('vendedor', $comercio)->get();
      
       $vendedores = DB::table('vendedors')
       ->where('nombre', 'like', '%' . $comercio . '%')
       ->get();
       // $vendedores = Vendedor::where('vendedor', $comercio)->get();
        return view('pedido.indexfil', compact('vendedores','nota'));
    }



    public function indexfiltro(Request $request)
    {
        
        $nota= ' ';
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
        $vendedores = Vendedor::all();
        return view('pedido.indexfiltro', compact('pedidos','vendedores','nota'));
    }

    public function indexdigitadofiltro(Request $request)
    {
        
        $nota= ' ';
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
        $vendedores = Vendedor::all();
        return view('pedido.indexdigitadofiltro', compact('pedidos','vendedores','nota'));
        


    }


    public function descargarRespaldo()
{
    // Configuración de la base de datos
    $servername = config('database.connections.mysql.host');
    $username = config('database.connections.mysql.username');
    $password = config('database.connections.mysql.password');
    $database = config('database.connections.mysql.database');

    // Nombre del archivo de respaldo
    $backupFilename = 'respaldo.sql';

    // Comando mysqldump
    $command = [
        'mysqldump',
        '--opt',
        "-h$servername",
        "-u$username",
        "-p$password",
        $database,
    ];

    try {
        // Ejecutar el comando
        $process = new Process($command);
        $process->mustRun();
        $backupContent = $process->getOutput();

        // Configurar las cabeceras para la descarga
        return Response::make($backupContent, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $backupFilename . '"',
        ]);
    } catch (ProcessFailedException $exception) {
       // return response()->json(['message' => 'Error al crear el respaldo'], 500);
       return response()->json(['message' => 'Error al crear el respaldo: ' . $exception->getMessage()], 500);
    }
}


    public function camara()
    {
        
       return view('pedido.camara');

    }

    public function listaestatus()
    {

        //$pedidos = Pedido::all();
       // $repartidores = Repartidor::all();
        return view('pedido.listaestatus');

        

    }

    public function reporte()
    {

        //$pedidos = Pedido::all();

       $repartidores = Repartidor::all();
        return view('pedido.reportes', compact('repartidores'));

    }
    public function reporteenvio()
    {


        $pedidos = Pedido::all();

       $repartidores = Repartidor::all();
        return view('pedido.reporteenvio', compact('pedidos','repartidores'));

        

    }
    public function reporteenviof(Request $request)
    {

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $pedidos = Pedido::whereBetween('fecha_entrega', [$desde, $hasta])->get();

        $tipo = $request->get('tipo');
        if($tipo!="tipo"){
            $pedidos = $pedidos->intersect(Pedido::whereIn('tipo', [$tipo])->get());
        }

        $repartidor = $request->get('repartidor');
        if($repartidor!="repartidor"){
            $pedidos = $pedidos->intersect(Pedido::whereIn('repartidor', [$repartidor])->get());
           
        }
  
        $estado = $request->get('estado');
        if($estado != "estado"){

            
            $pedidos = $pedidos->intersect(Pedido::whereIn('estado', [$estado])->get());

        }

       $repartidores = Repartidor::all();
        return view('pedido.repofiltroenvio', compact('pedidos','repartidores'));

        

    }
    public function reportegananciaff(Request $request)
    {

        // 1. Inicializa el Query Builder
    $query = Pedido::query();

    // Obtener parámetros de la solicitud
    $estado = $request->estado;
    $repartidor = $request->repartidor;
    $desde = $request->input('desde');
    $hasta = $request->input('hasta');
    $tipo = $request->get('tipo');

    // 2. Aplica filtros de estado/repartidor
    if ($estado) {
        $query->whereIn('estado', $estado);
    }
    
    if ($repartidor) {
        $query->whereIn('repartidor', $repartidor);
    }

    // 3. Aplica filtros de fecha (si 'desde' tiene valor)
    if (!empty($desde)) {
        // Asumiendo que 'hasta' también se envía, si no, usa una fecha futura o la fecha actual.
        $query->whereBetween('fecha_entrega', [$desde, $hasta ?? now()]);
    }
    
    // 4. Aplica filtro de tipo
    if ($tipo && $tipo !== "tipo") {
        $query->where('tipo', $tipo);
    }

    // 5. Ejecuta la consulta UNA SOLA VEZ
    $pedidos = $query->get(); // $pedidos ahora es la Colección final

    // 6. Calcular Totales (El foreach está bien si $pedidos es una Colección)
    $cantidad = 0;
    $tprecio = 0;
    $tenvio = 0;
    $total = 0;

    foreach($pedidos as $pedido){
        $cantidad += 1;
        $tprecio += $pedido->precio;
        $tenvio += $pedido->envio;
        $total += $pedido->total;
    }

    $repartidores = Repartidor::all();
    
    return view('pedido.repofiltroganan', compact('pedidos', 'repartidores', 'cantidad', 'tprecio', 'tenvio', 'total'));
        

    }

    public function reportegananciaf(Request $request)
{

        $pedidosga = Filtroganan::all();
        foreach($pedidosga as $ganancia){
         $ganancia->delete();
     }
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        //$pedidos = Pedido::whereBetween('fecha_entrega', [$desde, $hasta])->get();
        $pedidos1 = Pedido::whereBetween('fecha_entrega', [$desde, $hasta])
        ->selectRaw('fecha_entrega,tipo,estado, sum(envio) as suma')
        ->groupby('fecha_entrega', 'tipo')
        ->get();

        $tipo = $request->get('estado');
        if($tipo!="estado"){
            $pedidos1 = Pedido::whereBetween('fecha_entrega', [$desde, $hasta])
            ->where('estado', $tipo)
        ->selectRaw('fecha_entrega,tipo,estado, sum(envio) as suma')
        ->groupby('fecha_entrega', 'tipo')
        ->get();
           // $pedidos1 = $pedidos1->intersect(Pedido::whereIn('estado', [$tipo])->get());
        }
        

        //$pedidosga = Filtroganan::all();
        

       foreach($pedidos1 as $ganancia){
        $gananciare = new Filtroganan();
        $gananciare->fecha_entrega = $ganancia->fecha_entrega;
        if($ganancia->tipo == "Personalizado"){
            $gananciare->Personalizado = $ganancia->suma ;
        }
        if($ganancia->tipo == "Punto fijo"){
            $gananciare->Punto_fijo = $ganancia->suma ;
        }
        if($ganancia->tipo == "Casillero"){
            $gananciare->Casillero = $ganancia->suma ;
        }

        if($ganancia->tipo == "Personalizado departamental"){
            $gananciare->Casillero_depa = $ganancia->suma ;
        }
        
        $gananciare->save();
    }


       //$pedidos = Filtroganan::orderBy('fecha_entrega', 'asc')->groupBy('fecha_entrega')->get();
       $pedidos = Filtroganan::selectRaw('fecha_entrega, sum(Personalizado) as sumap, sum(Punto_fijo) as sumapf, sum(Casillero) as sumac, sum(Casillero_depa) as sumacd')
       ->groupBy('fecha_entrega')->get();


       $repartidores = Repartidor::all();
        return view('pedido.repofiltroganan', compact('pedidos','repartidores'));

}

    public function reportecobrof(Request $request)
{

        $pedidosga = Filtroganan::all();
        foreach($pedidosga as $ganancia){
         $ganancia->delete();
     }
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        //$pedidos = Pedido::whereBetween('fecha_entrega', [$desde, $hasta])->get();
        $pedidos1 = Pedido::whereBetween('fecha_entrega', [$desde, $hasta])
        ->selectRaw('fecha_entrega,tipo,estado, sum(total) as suma')
        ->groupby('fecha_entrega', 'tipo')
        ->get();

        $tipo = $request->get('estado');
        if($tipo!="estado"){
            $pedidos1 = Pedido::whereBetween('fecha_entrega', [$desde, $hasta])
            ->where('estado', $tipo)
        ->selectRaw('fecha_entrega,tipo,estado, sum(total) as suma')
        ->groupby('fecha_entrega', 'tipo')
        ->get();
           // $pedidos1 = $pedidos1->intersect(Pedido::whereIn('estado', [$tipo])->get());
        }
        

        //$pedidosga = Filtroganan::all();
        

       foreach($pedidos1 as $ganancia){
        $gananciare = new Filtroganan();
        $gananciare->fecha_entrega = $ganancia->fecha_entrega;
        if($ganancia->tipo == "Personalizado"){
            $gananciare->Personalizado = $ganancia->suma ;
        }
        if($ganancia->tipo == "Punto fijo"){
            $gananciare->Punto_fijo = $ganancia->suma ;
        }
        if($ganancia->tipo == "Casillero"){
            $gananciare->Casillero = $ganancia->suma ;
        }

        if($ganancia->tipo == "Personalizado departamental"){
            $gananciare->Casillero_depa = $ganancia->suma ;
        }
        
        $gananciare->save();
    }


       //$pedidos = Filtroganan::orderBy('fecha_entrega', 'asc')->groupBy('fecha_entrega')->get();
       $pedidos = Filtroganan::selectRaw('fecha_entrega, sum(Personalizado) as sumap, sum(Punto_fijo) as sumapf, sum(Casillero) as sumac, sum(Casillero_depa) as sumacd')
       ->groupBy('fecha_entrega')->get();


       $repartidores = Repartidor::all();
        return view('pedido.repofiltrocobro', compact('pedidos','repartidores'));

}

    public function reporteganancia()

{
        
        $pedidosga = Filtroganan::all();
       foreach($pedidosga as $ganancia){
        $ganancia->delete();
        }

      //  $pedidos = Pedido::all();


$fechaInicio = Carbon::now()->subMonths(3);
$fechaFin = Carbon::now();

$pedidos = Pedido::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();
//dd("Mensaje2");
       $repartidores = Repartidor::all();
        return view('pedido.reporteganan', compact('pedidos','repartidores'));

        

}
    public function reportecobros()
    {


       // $pedidos = Pedido::all();

        $fechaInicio = Carbon::now()->subMonths(6);
$fechaFin = Carbon::now();

$pedidos = Pedido::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();

       $repartidores = Repartidor::all();
        return view('pedido.reportecobro', compact('pedidos','repartidores'));

        

    }
    
    public function printfiltro(Request $request,$filtro,$ftipo)
    {

        
        //$pedidos = Pedido::where('estado', $filtro)->get();
        $total= 0;
        $cant=0;
        $tenvi=0;
        $cobrado=0;

        $checked = $request->input('checked');
        if($request->input('checked')){
           //$cant = $cant + 1;
        }
        $pedidos = Pedido::query()->find($checked);
        foreach($pedidos as $suma){
            $cobrado = $cobrado + $suma->precio;
            $total = $total + $suma->total;
            $tenvi = $tenvi + $suma->envio;
            $cant = $cant + 1;
        }

        $pdf = PDF::loadView('pedido.imprimirfiltro', ['pedidos'=>$pedidos, 'total'=>$total, 'cant'=>$cant, 'tenvi'=>$tenvi, 'cobrado'=>$cobrado]);
            $pdf->setPaper('letter', 'landscape');
            return $pdf->stream();
        


    }
    
    public function repofiltro(Request $request)
    {
        $filtro = 1;
        $ftipo= 1;
        $pedidos = new Pedido();
        
        //$pedidosall = new Pedido();
        //$pedidosall = Pedido::all();
        //$pedidosf = collect([$pedidosall]) ;
        $fecha = $request->get('fecha');
        //$pedidos = $pedidosall;
       
        $estado = $request->estado;
        $repartidor = $request->repartidor;
        if(!$request->repartidor && $request->estado){      
            $pedidos = Pedido::wherein('estado', $estado)->get();
        }else if ($request->repartidor && !$request->estado){
            $pedidos = Pedido::wherein('repartidor', $repartidor)->get();
        }else if ($request->repartidor && $request->estado){
            $pedidos = Pedido::wherein('estado', $estado)->wherein('repartidor', $repartidor)->get();
        }else{
            $pedidos = Pedido::all();
        }
        

        /*
        $estado = $request->estado;
        $repartidor = $request->repartidor;
        if(!$request->repartidor && $request->estado){      
            $pedidos = Pedido::wherein('estado', $estado)->get();
        }else if ($request->repartidor && !$request->estado){
            $pedidos = Pedido::wherein('repartidor', $repartidor)->get();
        }else if ($request->repartidor && $request->estado){
            $pedidos = Pedido::wherein('estado', $estado)->wherein('repartidor', $repartidor)->get();
        }
*/
        $pedidos = $pedidos->intersect(Pedido::whereIn('fecha_entrega', [$fecha])->get());
        /*
        if($fecha != ""){
            $pedidos = $pedidos->intersect(Pedido::whereIn('fecha_entrega', [$fecha])->get());

        }else{
            $pedidos = $pedidosall;
           
      
        }
*/
         //$tipo = $request->get('tipo');
         $tipo = $request->tipo;

         if($tipo!="tipo"){
             $pedidos = $pedidos->intersect(Pedido::whereIn('tipo', [$tipo])->get());
         }
 

        $ruta = $request->get('ruta');
        if($ruta!="ruta"){
            $pedidos = $pedidos->intersect(Pedido::whereIn('ruta', [$ruta])->get());
        }

       
        

        $total = $request->get('total');

        /*
        
*/
       // $pedidos = Pedido::where('fecha_entrega', 'LIKE', "%{$fecha}%")->where('estado', 'LIKE', "%{$estado}%")
       // ->where('ruta', 'LIKE', "%{$ruta}%")->where('tipo', 'LIKE', "%{$tipo}%")->where('repartidor', 'LIKE', "%{$repartidor}%")->get();
        $repartidores = Repartidor::all();
        return view('pedido.repofiltro', compact('pedidos','repartidores', 'filtro', 'ftipo'));

        

    }

    public function repobodega()
    {

        //$pedidos = Pedido::all();

       $repartidores = Vendedor::all();
        return view('pedido.reportebodega', compact('repartidores'));

    }

    public function repofiltrobodega(Request $request)
    {
        $filtro = 1;
        $ftipo= 1;
        $pedidos = new Pedido();
        $pedidosall = new Pedido();
        $pedidosall = Pedido::all();
        $pedidosf = collect([$pedidosall]) ;
        //$fecha = $request->get('fecha');
        //$pedidos = $pedidosall;
       
        $estado = $request->estado;
        $repartidor = $request->repartidor;
        if(!$request->repartidor && $request->estado){      
            $pedidos = Pedido::wherein('estado', $estado)->get();
        }else if ($request->repartidor && !$request->estado){
            $pedidos = Pedido::wherein('vendedor', $repartidor)->get();
        }else if ($request->repartidor && $request->estado){
            $pedidos = Pedido::wherein('estado', $estado)->wherein('vendedor', $repartidor)->get();
        }
        
        $repartidores = Vendedor::all();
        return view('pedido.repofiltrobodega', compact('pedidos','repartidores', 'filtro', 'ftipo'));

        

    }
    
    public function cambiarbodega(Request $request)
    {

        $id = $request->get('proba') ;
        //$fecha = $request->get('fecham') ;
        $estado = $request->estadom ;
        //$repartidor2 = $request->repartidorm ;

        $pedido = Pedido::find($id);
       
        $pedido->estado = $estado;
        
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


    public function repobodegafecha()
    {

        //$pedidos = Pedido::all();

       $repartidores = Vendedor::all();
        return view('pedido.reportebodegafecha', compact('repartidores'));

    }

    public function repofiltrobodegafecha(Request $request)
    {
        $filtro = 1;
        $ftipo= 1;
        //$pedidos = new Pedido();
        $pedidosall = new Pedido();
        $pedidosall = Pedido::all();
        $pedidosf = collect([$pedidosall]) ;
        //$fecha = $request->get('fecha');
        //$pedidos = $pedidosall;

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
       // $cajero = $request->input('usuario');
        $pedidos = Pedido::whereBetween('fecha_entrega', [$desde, $hasta])->get();


       
        $estado = $request->estado;
        $repartidor = $request->repartidor;
        if(!$request->repartidor && $request->estado){      
            $pedidos = Pedido::wherein('estado', $estado)->get();
        }else if ($request->repartidor && !$request->estado){
            $pedidos = Pedido::wherein('vendedor', $repartidor)->get();
        }else if ($request->repartidor && $request->estado){
            $pedidos = Pedido::wherein('estado', $estado)->wherein('vendedor', $repartidor)->get();
        }
        
        $repartidores = Vendedor::all();
        return view('pedido.repofiltrobodegafecha', compact('pedidos','repartidores', 'filtro', 'ftipo'));

        

    }

    public function editrepa(Request $request)
    {

        $id = $request->get('idpe') ;

        $pedido = Pedido::find($id);

        if(isset($_GET['entre']))
        {
            $pedido->estado="Entregado";
        }elseif(isset($_GET['repro'])){
            $pedido->estado="Reprogramado";
            $pedido->nota=$request->get('nota');
        }else{
            $pedido->estado="No entregado";
            $pedido->nota=$request->get('nota');
        }

        $pedido->save();
        return view('home');
        //return $id;

        

    }
    
    public function verpedido($id)
    {

        //$pedidos = Pedido::all();
       // $repartidores = Repartidor::all();
       $pedido = Pedido::find($id);

        return view('pedido.ver', compact('pedido'));

        

    }

    public function cambiarestatus(Request $request)
    {

        //$pedidos = Pedido::all();
       // $repartidores = Repartidor::all();
       
       $id = $request->get('codigo') ;
       //$pedidos = new Pedido(); 

       $pedido = Pedido::find($id);
       //$pedidos = collect([$pedido]);
       $pedidos = collect([$pedido]);
      //$pedidos->add($pedido);

       //return $pedidos;
       return view('pedido.cambiarestatus', compact('pedidos'));


    }

    public function estado()
    {
        
        //$pedidos = Pedido::all();
       // $repartidores = Repartidor::all();
       $pedidos = Pedido::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        return view('pedido.repartir', compact('pedidos'));


    }
    public function cestado(Request $request)
    {
        
        //$pedidos = Pedido::all();
       // $repartidores = Repartidor::all();
        //return view('pedido.repartir', compact('pedidos'));

        $id = $request->get('proba') ;
        

        $pedido = Pedido::find($id);
       
        $pedido->estado = $request->get('estado');
        $pedido->nota = $request->get('fpago');





        $pedido->save();
  
        $pedidos = Pedido::all();
        // $repartidores = Repartidor::all();
         return view('pedido.repartir', compact('pedidos'));


        


    }

    public function etiqueta($id)
    {
        $pedido = Pedido::find($id);
        $fecha= $pedido->fecha_entrega;
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = Carbon::parse($pedido->fecha_entrega);
$mes = $meses[($fecha->format('n')) - 1];
$fechal = $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        //$fechal = date('l d F Y',strtotime($fecha));
        //$fechal = strftime('%A %e de %B de %Y', $fecha);
        //$fecha = Carbon::parse($fecha);
       // $fechal = $fecha->format('l jS F Y');

       
        $pdf = PDF::loadView('pedido.etiqueta', ['pedido'=>$pedido, 'fechal'=>$fechal ]);
        //return view('pedido.etiqueta')->with('pedido', $pedido);

        $customPaper = array(0,0,283.80,283.80);
        $pdf->setPaper($customPaper, 'landscape');
        return $pdf->stream();


    }
 
    public function imprimire(Request $request)
    {

        $pedidos = new Pedido();
        
        $pedidos->vendedor = $request->get('comer');
        $pedidos->destinatario = $request->get('desti');
        $pedidos->telefono = $request->get('telefono');
        $pedidos->direccion = $request->get('direccion');
        $pedidos->fecha_entrega = $request->get('fentrega');
        $pedidos->precio = $request->get('precio');
        $pedidos->envio = $request->get('envio');
        $pedidos->total = $request->get('total');
        $pedidos->estado = $request->get('estado');
        $pedidos->pagado = $request->get('pagado');
        $pedidos->servicio = $request->get('servicio');
        $pedidos->tipo = $request->get('tenvio');
        $pedidos->nota = $request->get('nota');
        $pedidos->ingresado = $request->get('ingresado');
        $pedidos->agencia = $request->get('agencia');
        $pedidos->repartidor = $request->get('repartidor');
        $pedidos->ruta = $request->get('ruta');
        $pedidos->estante = $request->get('estante');
        //$pedidos->foto = $request->get('foto');

        if($request->hasFile('foto')){
            
            $imagen = $request->file("foto");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $pedidos->foto = $nombreimagen;
            $ruta = public_path("imgs/fotos/");
            $imagen->move($ruta,$nombreimagen);

        } 
        if($request->hasFile('foto2')){
            
            $imagen = $request->file("foto2");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $pedidos->foto2 = $nombreimagen;
            $ruta = public_path("imgs/fotos/");
            $imagen->move($ruta,$nombreimagen);

        }



        $pedidos->save();

        //$pedido = Pedido::latest()->first();
       // $pdf = PDF::loadView('pedido.etiqueta', ['pedido'=>$pedido]);
        //return view('pedido.etiqueta')->with('pedido', $pedido);


        #$pedido = Pedido::find($id);
        $pedido = Pedido::latest()->first();
        $pdf = PDF::loadView('pedido.etiqueta', ['pedido'=>$pedido]);
        //return view('pedido.etiqueta')->with('pedido', $pedido);
        $customPaper = array(0,0,10,10);
        $pdf->setPaper($customPaper);
        return $pdf->stream();


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::all();
        $last = Pedido::latest('id')->first();
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        $repartidores = Repartidor::all();
        $fecha = Carbon::today();
        //$date = $date->format('l jS F Y');
        $fecha = strftime("%A %d de %B %Y");
        return view('pedido.create')->with(['vendedores'=>$vendedores, 'fecha'=>$fecha, 'repartidores'=>$repartidores, 'last'=>$last, 'usuarios'=>$usuarios]);
    }
    public function crearp()
    {
        $usuarios = User::all();
        $last = Pedido::latest('id')->first();
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        $repartidores = Repartidor::all();
        $fecha = Carbon::today();
        //$date = $date->format('l jS F Y');
        $fecha = strftime("%A %d de %B %Y");
        return view('pedido.personalizado')->with(['vendedores'=>$vendedores, 'fecha'=>$fecha, 'repartidores'=>$repartidores, 'last'=>$last, 'usuarios'=>$usuarios]);
    }
   
    public function crearpf()
    {
        $usuarios = User::all();
        $last = Pedido::latest('id')->first();
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        $repartidores = Repartidor::all();
        $fecha = Carbon::today();
        //$date = $date->format('l jS F Y');
        $fecha = strftime("%A %d de %B %Y");
        return view('pedido.puntofijo')->with(['vendedores'=>$vendedores, 'fecha'=>$fecha, 'repartidores'=>$repartidores, 'last'=>$last, 'usuarios'=>$usuarios]);
    }

    public function crearcas()
    {
        $usuarios = User::all();
        $last = Pedido::latest('id')->first();
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        $repartidores = Repartidor::all();
        $fecha = Carbon::today();
        //$date = $date->format('l jS F Y');
        $fecha = strftime("%A %d de %B %Y");
        return view('pedido.casillero')->with(['vendedores'=>$vendedores, 'fecha'=>$fecha, 'repartidores'=>$repartidores, 'last'=>$last, 'usuarios'=>$usuarios]);
    }

    public function desdeenvio()
    {
        $last = Pedido::latest('id')->first();
        $lastid = $last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        
        
        $repartidores = Repartidor::all();
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");

       
        return view('pedido.denvio')->with(['vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid]);

        //return view('pedido.create')->with('vendedores', $vendedores);
    }
    public function comerperso()
    {
        $last = Pedido::latest('id')->first();
        $lastid = $last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        
        
        $repartidores = Repartidor::all();
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");

       
        return view('pedido.guardarpe')->with(['vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid]);

        //return view('pedido.create')->with('vendedores', $vendedores);
    }

    public function comerpfijo()
    {
        $last = Pedido::latest('id')->first();
        $lastid = $last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        
        
        $repartidores = Repartidor::all();
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");

       
        return view('pedido.guardarfijo')->with(['vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid]);

        //return view('pedido.create')->with('vendedores', $vendedores);
    }
    public function comercasi()
    {
        $last = Pedido::latest('id')->first();
        $lastid = $last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        setlocale(LC_TIME, "spanish");
        $vendedores = Vendedor::all();
        
        
        $repartidores = Repartidor::all();
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");

       
        return view('pedido.guardarcasi')->with(['vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid]);

        //return view('pedido.create')->with('vendedores', $vendedores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	

	public function guardarperso(Request $request)
    {

        $pedidos = new Pedido();
        
        $pedidos->vendedor = $request->get('comer');
        $pedidos->destinatario = $request->get('desti');
        $pedidos->telefono = $request->get('telefono');
        $pedidos->direccion = $request->get('direccion');
        $pedidos->fecha_entrega = $request->get('fentrega');
        $pedidos->precio = $request->get('precio');
        $pedidos->envio = $request->get('envio');
        $pedidos->total = $request->get('total');
        $pedidos->estado = $request->get('estado');
        $pedidos->pagado = $request->get('pagado');
        $pedidos->servicio = $request->get('servicio');
        $pedidos->tipo = $request->get('tenvio');
        $pedidos->nota = $request->get('nota');
        $pedidos->ingresado = $request->get('ingresado');
        $pedidos->agencia = $request->get('agencia');
        $pedidos->repartidor = $request->get('repartidor');
        $pedidos->ruta = $request->get('ruta');
        $pedidos->estante = $request->get('estante');
        //$pedidos->foto = $request->get('foto');

        if($request->hasFile('foto')){
            
            $imagen = $request->file("foto");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $pedidos->foto = $nombreimagen;
            $ruta = public_path("imgs/fotos/");
            $imagen->move($ruta,$nombreimagen);

        } 
        if($request->hasFile('foto2')){
            
            $imagen = $request->file("foto2");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $pedidos->foto2 = $nombreimagen;
            $ruta = public_path("imgs/fotos/");
            $imagen->move($ruta,$nombreimagen);

        }



        $pedidos->save();

        return redirect()->back();


    }







    public function store(Request $request)
    {
        $last = Pedido::latest('id')->first();
        $lastid =$last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        $rutaf='seleccionar';
        $pedidof='1970-01-01';
        $repaf='';
        $pedido = new Pedido();
        
        $pedido->vendedor = $request->get('comer');
        $pedido->destinatario = $request->get('desti');
        $pedido->telefono = $request->get('telefono');
        $pedido->direccion = $request->get('direccion');
        $pedido->fecha_entrega = $request->get('fentrega');
        $pedido->precio = $request->get('precio');
        $pedido->envio = $request->get('envio');
        $pedido->total = $request->get('total');
        $pedido->estado = $request->get('estado');
        $pedido->pagado = $request->get('pagado');
        $pedido->servicio = $request->get('servicio');
        $pedido->tipo = $request->get('tenvio');
        $pedido->nota = $request->get('nota');
        $pedido->cobroenvio = $request->get('cenvio');
        $pedido->ingresado = $request->get('ingresado');
        $pedido->agencia = $request->get('agencia');
        $pedido->repartidor = $request->get('repartidor');
        $pedido->ruta = $request->get('ruta');
        $pedido->estante = $request->get('estante');
        //$pedidos->foto = $request->get('foto');

       // if($request->hasFile('foto')){
        if($request->foto){
            $imagen = $request->foto;
           // $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $nombreimagen = uniqid() . '.png';
            $pedido->foto = $nombreimagen;
            $ruta = "/public/";
            $image_parts = explode(";base64,", $imagen);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            
            $image_base64 = base64_decode($image_parts[1]);
           // $fileName = uniqid() . '.png';
            
            $file = $ruta . $nombreimagen;
            Storage::put($file, $image_base64);

            //$imagen->move($ruta,$nombreimagen);

        }
            //$folderPath = "uploads/";
        /*
        $image_parts = explode(";base64,", $img);
      

*/




       // } 
        if($request->hasFile('foto2')){
            
            $imagen = $request->file("foto2");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $pedido->foto2 = $nombreimagen;
            $ruta = public_path("/");
            $imagen->move($ruta,$nombreimagen);

        }



        $pedido->save();
  
        setlocale(LC_TIME, "spanish");
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");
        $vendedores = Vendedor::all();
        $repartidores = Repartidor::all();
        $pedidos = Pedido::all();

        if(isset($_POST['impri']))
        {
            $pedido = Pedido::latest('id')->first();
        $fecha= $pedido->fecha_entrega;
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = Carbon::parse($pedido->fecha_entrega);
$mes = $meses[($fecha->format('n')) - 1];
$fechal = $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        //$fechal = date('l d F Y',strtotime($fecha));
        //$fechal = strftime('%A %e de %B de %Y', $fecha);
        //$fecha = Carbon::parse($fecha);
       // $fechal = $fecha->format('l jS F Y');

        $pdf = PDF::loadView('pedido.etiqueta', ['pedido'=>$pedido, 'fechal'=>$fechal ]);
        //return view('pedido.etiqueta')->with('pedido', $pedido);

        $customPaper = array(0,0,283.80,283.80);
        $pdf->setPaper($customPaper, 'landscape');
        return $pdf->stream();
        }elseif(isset($_POST['personali'])){
            return view('pedido.personalizado')->with(['vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid, 'pedidof'=>$pedidof, 'rutaf'=>$rutaf, 'repaf'=>$repaf, 'last'=>$last]);
	    //return redirect()->back();
        }elseif(isset($_POST['puntof'])){
            return view('/pedido/puntofijo')->with(['pedidos'=>$pedidos, 'vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid, 'pedidof'=>$pedidof, 'rutaf'=>$rutaf, 'repaf'=>$repaf, 'last'=>$last]);
	//return redirect()->back();
        }elseif(isset($_POST['casi'])){
            return view('/pedido/casillero')->with(['pedidos'=>$pedidos, 'vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid, 'pedidof'=>$pedidof, 'rutaf'=>$rutaf, 'repaf'=>$repaf, 'last'=>$last]);
        }
        
        else{
            return view('/pedido/create')->with(['pedidos'=>$pedidos, 'vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid, 'pedidof'=>$pedidof, 'rutaf'=>$rutaf, 'repaf'=>$repaf, 'last'=>$last]);
        }

        
       //return redirect('/pedido/etiqueta')->with('id', $pedidos->id);
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
        $repartidores = Repartidor::all();
        $vendedores = Vendedor::all();
        $pedido = Pedido::find($id);
        return view('pedido.edit')->with(['pedido'=>$pedido, 'vendedores'=>$vendedores, 'repartidores'=>$repartidores]);
    }
    public function editando($id)
    {
        $repartidores = Repartidor::all();
        $vendedores = Vendedor::all();
        $pedido = Pedido::find($id);
        return view('pedido.editarlo')->with(['pedido'=>$pedido, 'vendedores'=>$vendedores, 'repartidores'=>$repartidores]);
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
        $last = Pedido::latest('id')->first();
        $lastid = $last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        $pedido = Pedido::find($id);
        $rutaf='seleccionar';
        $pedidof='1970-01-01';
        $repaf='';
        $pedido->vendedor = $request->get('comer');
        $pedido->destinatario = $request->get('desti');
        $pedido->telefono = $request->get('telefono');
        $pedido->direccion = $request->get('direccion');
        $pedido->fecha_entrega = $request->get('fentrega');
        $pedido->precio = $request->get('precio');
        $pedido->envio = $request->get('envio');
        $pedido->cobroenvio = $request->get('cenvio');
        $pedido->total = $request->get('total');
        $pedido->estado = $request->get('estado');
        $pedido->pagado = $request->get('pagado');
        $pedido->servicio = $request->get('servicio');
        $pedido->tipo = $request->get('tenvio');
        $pedido->nota = $request->get('nota');
        $pedido->ingresado = $request->get('ingresado');
        $pedido->agencia = $request->get('agencia');
        $pedido->repartidor = $request->get('repartidor');
        $pedido->ruta = $request->get('ruta');
        $pedido->estante = $request->get('estante');
      

        if($request->hasFile('foto')){
           
            if($pedido->foto==''){
                $imagen = $request->file("foto");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $pedido->foto = $nombreimagen;
            $ruta = public_path("imgs/fotos/");
            $imagen->move($ruta,$nombreimagen);
            }elseif($pedido->foto2==''){
                $imagen = $request->file("foto");
                $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
                $pedido->foto2 = $nombreimagen;
                $ruta = public_path("imgs/fotos/");
                $imagen->move($ruta,$nombreimagen);
            }elseif($pedido->foto3==''){
                $imagen = $request->file("foto");
                $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
                $pedido->foto3 = $nombreimagen;
                $ruta = public_path("imgs/fotos/");
                $imagen->move($ruta,$nombreimagen);
            }elseif($pedido->foto4==''){
                $imagen = $request->file("foto");
                $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
                $pedido->foto4 = $nombreimagen;
                $ruta = public_path("imgs/fotos/");
                $imagen->move($ruta,$nombreimagen);
            }
            
            
            
            

        }





        $pedido->save();
  
        setlocale(LC_TIME, "spanish");
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");
        $vendedores = Vendedor::all();
        $repartidores = Repartidor::all();
        //$pedidos = Pedido::all();
        $pedidos = Pedido::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        $nota=" ";
        return view('/pedido/index')->with(['pedidos'=>$pedidos, 'vendedores'=>$vendedores, 'date'=>$date, 'repartidores'=>$repartidores, 'uid'=>$uid, 'pedidof'=>$pedidof, 'rutaf'=>$rutaf, 'repaf'=>$repaf, 'nota'=>$nota]);
        //return view('pedido.index', compact('pedidos'));
    }

    public function comerfiltro(Request $request)
    {
        $comercio = $request->input('busc');

        $vendedores = DB::table('vendedors')
        ->where('nombre', 'like', '%' . $comercio . '%')
        ->get();
       $repartidores = Repartidor::all();
       $nota=" ";
       return view('pedido.personalizado2')->with([ 'vendedores'=>$vendedores, 'nota'=>$nota, 'repartidores'=>$repartidores    ]);
 
    }

    public function comerfiltropf(Request $request)
    {
        $comercio = $request->input('busc');

        $vendedores = DB::table('vendedors')
        ->where('nombre', 'like', '%' . $comercio . '%')
        ->get();
       $repartidores = Repartidor::all();
       $nota=" ";
       return view('pedido.puntofijo2')->with([ 'vendedores'=>$vendedores, 'nota'=>$nota, 'repartidores'=>$repartidores    ]);
 
    }

    public function comerfiltroca(Request $request)
    {
        $comercio = $request->input('busc');

        $vendedores = DB::table('vendedors')
        ->where('nombre', 'like', '%' . $comercio . '%')
        ->get();
       $repartidores = Repartidor::all();
       $nota=" ";
       return view('pedido.casillero2')->with([ 'vendedores'=>$vendedores, 'nota'=>$nota, 'repartidores'=>$repartidores    ]);
 
    }

    public function editarlo(Request $request, $id)
    {
        $last = Pedido::latest('id')->first();
        $lastid = $last->id;
        $uid=0;
        if($lastid < 1){
            $uid=1;
        }else{
            $uid= $lastid + 1;
        }
        $pedido = Pedido::find($id);
        $rutaf='seleccionar';
        $pedidof='1970-01-01';
        $repaf='';
        $pedido->vendedor = $request->get('comer');
        $pedido->destinatario = $request->get('desti');
        $pedido->telefono = $request->get('telefono');
        $pedido->direccion = $request->get('direccion');
        $pedido->fecha_entrega = $request->get('fentrega');
        $pedido->precio = $request->get('precio');
        $pedido->envio = $request->get('envio');
        $pedido->cobroenvio = $request->get('cenvio');
        $pedido->total = $request->get('total');
        $pedido->estado = $request->get('estado');
        $pedido->pagado = $request->get('pagado');
        $pedido->servicio = $request->get('servicio');
        $pedido->tipo = $request->get('tenvio');
        $pedido->nota = $request->get('nota');
        $pedido->ingresado = $request->get('ingresado');
        $pedido->agencia = $request->get('agencia');
        $pedido->repartidor = $request->get('repartidor');
        $pedido->ruta = $request->get('ruta');
        $pedido->estante = $request->get('estante');
      

        if($request->hasFile('foto')){
           
            if($pedido->foto==''){
                $imagen = $request->file("foto");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $pedido->foto = $nombreimagen;
            $ruta = public_path("imgs/fotos/");
            $imagen->move($ruta,$nombreimagen);
            }elseif($pedido->foto2==''){
                $imagen = $request->file("foto");
                $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
                $pedido->foto2 = $nombreimagen;
                $ruta = public_path("imgs/fotos/");
                $imagen->move($ruta,$nombreimagen);
            }elseif($pedido->foto3==''){
                $imagen = $request->file("foto");
                $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
                $pedido->foto3 = $nombreimagen;
                $ruta = public_path("imgs/fotos/");
                $imagen->move($ruta,$nombreimagen);
            }elseif($pedido->foto4==''){
                $imagen = $request->file("foto");
                $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
                $pedido->foto4 = $nombreimagen;
                $ruta = public_path("imgs/fotos/");
                $imagen->move($ruta,$nombreimagen);
            }
            
            
            
            

        }





        $pedido->save();
  
        setlocale(LC_TIME, "spanish");
        $date = Carbon::today();
        //$date = $date->format('l jS F Y');
        $date = strftime("%A %d de %B %Y");
        $vendedores = Vendedor::all();
        //$repartidores = Repartidor::all();
        //$pedidos = Pedido::all();
        $pedidos = Pedido::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        $nota=" ";
        return view('/factura/index')->with(['pedidos'=>$pedidos, 'vendedores'=>$vendedores, 'nota'=>$nota]);
        //return view('pedido.index', compact('pedidos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return redirect('/pedidos');
    }
}
