<?php

use Illuminate\Support\Facades\Route;
//agregue controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RecolectaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\EstatusController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ComercioController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
 
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/facturasfiltro', [App\Http\Controllers\FacturacionController::class, 'filtro'])->name('facturasfiltro');
Route::get('/facturasfiltro2', [App\Http\Controllers\FacturacionController::class, 'filtrocomer'])->name('facturasfiltro2');
Route::get('/comerfiltro', [App\Http\Controllers\PedidoController::class, 'comerfiltro'])->name('comerfiltro');
Route::get('/comerfiltropf', [App\Http\Controllers\PedidoController::class, 'comerfiltropf'])->name('comerfiltropf');
Route::get('/comerfiltroca', [App\Http\Controllers\PedidoController::class, 'comerfiltroca'])->name('comerfiltroca');
 
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('recolecta', RecolectaController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('repartidores', RepartidorController::class);
    Route::resource('vendedores', VendedorController::class);
    Route::resource('facturas', FacturacionController::class);
    Route::resource('estatus', EstatusController::class);
     
}); 
Route::group(['middleware' => ['auth']], function() {
Route::get('pedido/noretirado', [App\Http\Controllers\PedidoController::class, 'noretirado'] )->name('noretirado') ;
Route::get('pedido/noretiradofiltro', [App\Http\Controllers\PedidoController::class, 'noretiradofiltro'] )->name('noretiradofiltro') ;
Route::get('pedido/cambiarnt/{id}', [App\Http\Controllers\PedidoController::class, 'cambiarnt'] )->name('cambiarnt') ;

Route::get('pedido/desdeenvio', [App\Http\Controllers\PedidoController::class, 'desdeenvio'] )->name('desdeenvio') ;
Route::get('pedido/comerperso', [App\Http\Controllers\PedidoController::class, 'comerperso'] )->name('comerperso') ;
Route::get('pedido/comerpfijo', [App\Http\Controllers\PedidoController::class, 'comerpfijo'] )->name('comerpfijo') ;
Route::get('pedido/comercasi', [App\Http\Controllers\PedidoController::class, 'comercasi'] )->name('comercasi') ;

Route::get('pedido/editando/{id}', [App\Http\Controllers\PedidoController::class, 'editando'] )->name('editando') ;
Route::get('pedido/editarlo/{id}', [App\Http\Controllers\PedidoController::class, 'editarlo'] )->name('editarlo') ;
Route::get('pedido/crearp', [App\Http\Controllers\PedidoController::class, 'crearp'] )->name('crearp') ;
Route::get('pedido/crearpf', [App\Http\Controllers\PedidoController::class, 'crearpf'] )->name('crearpf') ;
Route::get('pedido/crearcas', [App\Http\Controllers\PedidoController::class, 'crearcas'] )->name('crearcas') ;
Route::get('pedido/guardarperso', [App\Http\Controllers\PedidoController::class, 'guardarperso'] )->name('guardarpers') ;   




Route::get('pedido/indexfiltro', [App\Http\Controllers\PedidoController::class, 'indexfiltro'] )->name('indexfiltro') ;
Route::get('pedido/indexfiltrocomer', [App\Http\Controllers\PedidoController::class, 'indexfiltrocomer'] )->name('indexfiltrocomer') ;   

Route::get('pedido/indexdigitadofiltro', [App\Http\Controllers\PedidoController::class, 'indexdigitadofiltro'] )->name('indexdigitadofiltro') ;
Route::get('pedido/indexdigitado/', [App\Http\Controllers\PedidoController::class, 'indexdigitado'] )->name('indexdigitado') ;


 
Route::get('facturas', [App\Http\Controllers\FacturacionController::class, 'index'] )->name('facturacion') ;
Route::get('factura/facturando', [App\Http\Controllers\FacturacionController::class, 'index'] )->name('factura.facturando') ;
Route::get('factura/facturapdf/{pedidos}', [App\Http\Controllers\FacturacionController::class, 'facturapdf'] )->name('pedido.facturapdf') ;
Route::get('factura/listado', [App\Http\Controllers\FacturacionController::class, 'listado'] )->name('factura.listado') ;
Route::get('factura/listado2', [App\Http\Controllers\FacturacionController::class, 'listado2'] )->name('factura.listado2') ;
Route::get('factura/listadofiltro/', [App\Http\Controllers\FacturacionController::class, 'listadofiltro'] )->name('factura.listadofiltro') ;

Route::get('factura/listadopagos', [App\Http\Controllers\FacturacionController::class, 'listadopagos'] )->name('factura.listadopagos') ;
Route::get('factura/listadopagosfiltro/', [App\Http\Controllers\FacturacionController::class, 'listadopagosfiltro'] )->name('factura.listadopagosfiltro') ;
Route::get('factura/detalles/{id}', [App\Http\Controllers\FacturacionController::class, 'detalles'] )->name('factura.detalles') ;

Route::get('estado/estadomanual', [App\Http\Controllers\EstatusController::class, 'emanual'] )->name('estado.emanual') ;
Route::get('estado/manualfiltro', [App\Http\Controllers\EstatusController::class, 'manualfiltro'] )->name('estado.manualfiltro') ;
Route::get('estado/cestadomanual/', [App\Http\Controllers\EstatusController::class, 'cestadomanual'] )->name('estado.cestadomanual') ;
 
Route::get('estado/estadolote', [App\Http\Controllers\EstatusController::class, 'elote'] )->name('estado.elote') ;
Route::get('estado/lotefiltro', [App\Http\Controllers\EstatusController::class, 'lotefiltro'] )->name('estado.lotefiltro');
Route::get('estado/cestadolote', [App\Http\Controllers\EstatusController::class, 'cestadolote'] )->name('estado.cestadolote') ;


Route::get('pedidos/etiqueta/{id}', [App\Http\Controllers\PedidoController::class, 'etiqueta'] )->name('pedido.etiqueta') ; 
Route::get('pedidos/imprimire', [App\Http\Controllers\PedidoController::class, 'imprimire'] )->name('imprimire'); 

Route::get('pedido/estado', [App\Http\Controllers\PedidoController::class, 'estado'] )->name('estado') ;
Route::get('pedido/cestado', [App\Http\Controllers\PedidoController::class, 'cestado'] )->name('cestado') ;

Route::get('pedido/listaestatus', [App\Http\Controllers\EstatusController::class, 'listaestatus'] )->name('listaestatus') ;
Route::get('pedido/cambiando', [App\Http\Controllers\EstatusController::class, 'cambiando'] )->name('cambiando') ;
 
Route::get('pedido/verpedido/{id}', [App\Http\Controllers\PedidoController::class, 'verpedido'] )->name('verpedido') ;



Route::get('descargar-respaldo', [App\Http\Controllers\PedidoController::class, 'descargarRespaldo'] )->name('descargarRespaldo') ; 

Route::get('repofiltro', [App\Http\Controllers\PedidoController::class, 'repofiltro'] )->name('repofiltro') ;

Route::get('printfiltro/{filtro}/{ftipo}', [App\Http\Controllers\PedidoController::class, 'printfiltro'] )->name('printfiltro') ;

Route::get('pedido/editrepa', [App\Http\Controllers\PedidoController::class, 'editrepa'] )->name('editrepa') ;

Route::get('pedido/camara', [App\Http\Controllers\PedidoController::class, 'camara'] )->name('camara') ;

Route::get('estatus/agregar', [App\Http\Controllers\EstatusController::class, 'agregar'] )->name('agregar') ;

}); 




Route::get('reportes', [App\Http\Controllers\PedidoController::class, 'reporte'] )->name('reporte')->middleware('auth') ;
Route::get('reportes/envio', [App\Http\Controllers\PedidoController::class, 'reporteenvio'] )->name('reporteenvio') ;
Route::get('reportes/ganancia', [App\Http\Controllers\PedidoController::class, 'reporteganancia'] )->name('reportegananciass') ;
Route::get('reportes/cobros', [App\Http\Controllers\PedidoController::class, 'reportecobros'] )->name('reportecobros') ;
Route::get('reportes/enviofiltro', [App\Http\Controllers\PedidoController::class, 'reporteenviof'] )->name('reporteenviof') ;
Route::get('reportes/gananfiltro', [App\Http\Controllers\PedidoController::class, 'reportegananciaff'] )->name('reportegananciaff') ;
Route::get('reportes/cobrofiltro', [App\Http\Controllers\PedidoController::class, 'reportecobrof'] )->name('reportecobrof') ;

Route::get('reportes/repobodega', [App\Http\Controllers\PedidoController::class, 'repobodega'] )->name('repobodega') ;
Route::get('reportes/repofiltrobodega', [App\Http\Controllers\PedidoController::class, 'repofiltrobodega'] )->name('repofiltrobodega')->middleware('auth') ;
Route::get('reportes/cambiarbodega', [App\Http\Controllers\PedidoController::class, 'cambiarbodega'] )->name('cambiarbodega') ;

Route::get('reportes/repobodegafecha', [App\Http\Controllers\PedidoController::class, 'repobodegafecha'] )->name('repobodegafecha') ;
Route::get('reportes/repofiltrobodegafecha', [App\Http\Controllers\PedidoController::class, 'repofiltrobodegafecha'] )->name('repofiltrobodegafecha') ;



//Entregas

Route::get('entrega', [App\Http\Controllers\EntregaController::class, 'index'] )->name('entrega');


//Usuarios
Route::get('usuarios', [App\Http\Controllers\UsuarioController::class, 'index'] )->name('usuarios.inicio') ;

// Ruta para ver el detalle del usuario
Route::get('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show');
Route::get('/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update');



//Comercios
Route::get('comercios', [App\Http\Controllers\ComercioController::class, 'index'] )->name('comercios.inicio') ;
Route::get('/comercios/{id}', [App\Http\Controllers\ComercioController::class, 'show'])->name('comercios.show');
Route::get('/comercios/{id}/edit', [App\Http\Controllers\ComercioController::class, 'edit'])->name('comercios.edit');
Route::put('/comercios/{id}', [App\Http\Controllers\ComercioController::class, 'update'])->name('comercios.update');
Route::get('/comercios/crear', [App\Http\Controllers\ComercioController::class, 'guardar'] )->name('comercios.guardar') ;
