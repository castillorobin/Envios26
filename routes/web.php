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
use App\Http\Controllers\PuntoController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\PagoController;






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





//Usuarios
Route::get('usuarios', [App\Http\Controllers\UsuarioController::class, 'index'] )->name('usuarios.inicio') ;

// Ruta para ver el detalle del usuario
Route::get('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show');
Route::get('/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update');


// --- SECCIÓN COMERCIOS CORREGIDA ---

// 1. Rutas de creación (Fijas)
Route::get('comercios', [ComercioController::class, 'index'])->name('comercios.inicio');
Route::get('/comercios/guardar', [ComercioController::class, 'guardar'])->name('comercios.guardar');

// 2. Rutas de edición de usuario (Más específicas que el show)
Route::get('/comercios/editaruser/{id}', [ComercioController::class, 'editaruser'])->name('comercios.editaruser');
Route::put('/comercios/updateuser/{id}', [ComercioController::class, 'updateuser'])->name('comercios.updateuser');

// 3. Rutas de procesamiento de formularios
Route::post('/comercios/usuario', [ComercioController::class, 'storeusuario'])->name('comercios.storeusuario');
Route::post('/comercios/crear', [ComercioController::class, 'store'])->name('comercios.store');

// 4. Rutas con parámetros generales (DÉJALAS AL FINAL DE LA SECCIÓN)
Route::get('/comercios/{id}', [ComercioController::class, 'show'])->name('comercios.show');
Route::get('/comercios/{id}/edit', [ComercioController::class, 'edit'])->name('comercios.edit');
Route::put('/comercios/{id}', [ComercioController::class, 'update'])->name('comercios.update');

//Configuración
Route::get('/configuracion', [App\Http\Controllers\PuntoController::class, 'index'] )->name('configuracion.index') ;
Route::post('/configuracion/crear', [App\Http\Controllers\PuntoController::class, 'store'])->name('puntos.store') ;

Route::put('/puntos/{id}', [App\Http\Controllers\PuntoController::class, 'update'])->name('puntos.update');
Route::delete('/puntos/{id}', [App\Http\Controllers\PuntoController::class, 'destroy'])->name('puntos.destroy');


//Usuarios
Route::get('ordenes', [App\Http\Controllers\OrdenController::class, 'index'] )->name('ordenes.inicio') ;
Route::get('/ordenes/crear', [App\Http\Controllers\OrdenController::class, 'create'])->name('ordenes.crear');
Route::post('/ordenes/guardar', [App\Http\Controllers\OrdenController::class, 'store'])->name('ordenes.guardar');

// 1. Vista para ingresar la guía
Route::get('ordenes/buscar', [App\Http\Controllers\OrdenController::class, 'vistaBusqueda'])->name('ordenes.buscar');

// 2. Procesar la búsqueda y redirigir
Route::post('ordenes/procesar-busqueda', [App\Http\Controllers\OrdenController::class, 'procesarBusqueda'])->name('ordenes.procesar_busqueda');

Route::get('/ordenes/toma-foto', [App\Http\Controllers\OrdenController::class, 'tomarfoto'])->name('ordenes.tomarfoto');
Route::get('/ordenes/buscar-ajax', [App\Http\Controllers\OrdenController::class, 'buscarGuiaAjax'])->name('ordenes.buscar_ajax');
Route::post('/ordenes/guardar-fotos', [App\Http\Controllers\OrdenController::class, 'guardarFotos'])->name('ordenes.guardar_fotos');

Route::get('/ordenes/asignar-mercancia', [App\Http\Controllers\OrdenController::class, 'asignarMercancia'])->name('ordenes.asignar_mercancia');
Route::post('/ordenes/procesar-asignacion', [App\Http\Controllers\OrdenController::class, 'procesarAsignacion'])->name('ordenes.asignacion');
Route::get('/ordenes/buscar-guia-ajax', [App\Http\Controllers\OrdenController::class, 'buscarGuiaAsignacion'])->name('ordenes.buscar_guia_ajax');
Route::post('/ordenes/confirmar-asignacion', [App\Http\Controllers\OrdenController::class, 'confirmarAsignacion'])->name('ordenes.confirmar_asignacion');

Route::get('/ordenes/detalle/{id}', [App\Http\Controllers\OrdenController::class, 'detalle'])->name('ordenes.detalle');


// 3. El formulario (ahora recibe los datos por sesión o query)
//Route::get('ordenes/crear', [App\Http\Controllers\OrdenController::class, 'create'])->name('ordenes.crear');

//Recepción de paquetes
Route::post('/recepcion/inicio', [App\Http\Controllers\RecepcionController::class, 'index'])->name('recepcion.inicio');
Route::get('recepcion/crearrecepcion', [App\Http\Controllers\RecepcionController::class, 'crearrecepcion'] )->name('recepcion.crearrecepcion') ;
Route::get('recepcion/elegircomercio', [App\Http\Controllers\RecepcionController::class, 'elegircomercio'] )->name('recepcion.elegircomercio') ;
Route::post('/recepcion/guardar', [App\Http\Controllers\RecepcionController::class, 'guardar'])->name('recepcion.guardar');
Route::post('/recepcion/verificar-guia', [App\Http\Controllers\RecepcionController::class, 'verificarGuiaExistente'])->name('recepcion.verificar_guia');

//Cajones
Route::get('/cajones', [App\Http\Controllers\CajonController::class, 'index'] )->name('cajones.inicio') ;
Route::post('/cajones/crear', [App\Http\Controllers\CajonController::class, 'store'])->name('cajones.store');
Route::put('/cajones/{id}', [App\Http\Controllers\CajonController::class, 'update'])->name('cajones.update');
Route::delete('/cajones/{id}', [App\Http\Controllers\CajonController::class, 'destroy'])->name('cajones.destroy');

//Ubicacion
Route::get('/ubicacion/buscar', [App\Http\Controllers\OrdenController::class, 'vistaBusquedaubicacion'])->name('ubicacion.buscar') ;
Route::post('/ubicacion/procesar-busqueda', [App\Http\Controllers\OrdenController::class, 'procesarBusquedaubicacion'])->name('ubicacion.procesar_busqueda') ;
Route::get('/ubicacion/asignar-mercancia', [App\Http\Controllers\OrdenController::class, 'asignarMercanciaubicacion'])->name('ubicacion.asignar_mercancia') ;
Route::post('/ubicacion/procesar-asignacion', [App\Http\Controllers\OrdenController::class, 'procesarAsignacionubicacion'])->name('ubicacion.asignacion') ;
Route::get('/ubicacion/buscar-guia-ajax', [App\Http\Controllers\OrdenController::class, 'buscarGuiaAsignacionubicacion'])->name('ubicacion.buscar_guia_ajax') ;
Route::post('/ubicacion/confirmar-asignacion', [App\Http\Controllers\OrdenController::class, 'confirmarAsignacionubicacion'])->name('ubicacion.confirmar_asignacion') ;


Route::get('/cajas/buscar-ajax', [App\Http\Controllers\CajonController::class, 'buscarCajaAjax'])->name('cajas.buscar_ajax');
Route::post('/cajas/confirmar-ubicacion', [App\Http\Controllers\CajonController::class, 'confirmarUbicacionCajas'])->name('cajas.confirmar_ubicacion');


//Unidades
Route::get('/unidades', [App\Http\Controllers\UnidadController::class, 'index'] )->name('unidades.inicio') ;
Route::post('/unidades/crear', [App\Http\Controllers\UnidadController::class,   'store'])->name('unidades.store');
Route::put('/unidades/{id}', [App\Http\Controllers\UnidadController::class, 'update'])->name('unidades.update');
Route::delete('/unidades/{id}', [App\Http\Controllers\UnidadController::class, 'destroy'])->name('unidades.destroy');

//Carga
Route::get('/carga/buscar', [App\Http\Controllers\UnidadController::class, 'vistaBusqueda'])->name('carga.buscar') ;
Route::post('/carga/procesar-busqueda', [App\Http\Controllers\UnidadController::class, 'procesarBusqueda'])->name('carga.procesar_busqueda') ;
Route::get('/carga/asignar-mercancia', [App\Http\Controllers\UnidadController::class, 'asignarMercancia'])->name('carga.asignar_mercancia') ;
Route::post('/carga/confirmar_carga', [App\Http\Controllers\UnidadController::class, 'confirmarCarga'])->name('carga.confirmar_carga') ;
Route::post('/carga/confirmar_carga_guias', [App\Http\Controllers\UnidadController::class, 'confirmarCargaGuias'])->name('carga.confirmar_carga_guias') ;


Route::get('/carga/asignar-reparto', [App\Http\Controllers\UnidadController::class, 'asignarReparto'])->name('carga.asignar_reparto') ;
Route::get('/carga/lista-reparto', [App\Http\Controllers\UnidadController::class, 'listaReparto'])->name('carga.lista_reparto') ;
Route::get('/carga/asignar-repartidor', [App\Http\Controllers\UnidadController::class, 'asignarRepartidor'])->name('carga.asignar_repartidor') ;
Route::post('/carga/procesar-asignacion-repartidor', [App\Http\Controllers\UnidadController::class, 'procesarAsignacionRepartidor'])->name('unidades.confirmar_repartidor') ; 
Route::get('/unidades/{id}/detalle-guias', [App\Http\Controllers\UnidadController::class, 'detalleGuias'])->name('unidades.detalle_guias');

//Cuadre de paqueteria
Route::get('/orden/cuadre-paqueteria', [App\Http\Controllers\OrdenController::class, 'cuadrePaqueteria'])->name('cuadre.paqueteria') ;
Route::post('/orden/procesar-cuadre', [App\Http\Controllers\OrdenController::class, 'procesarCuadrePaqueteria'])->name('cuadre.procesar_cuadre') ;
Route::get('/cuadre/detalle/{unidad_id}/{estado}', [App\Http\Controllers\OrdenController::class, 'detalleEstado'])->name('cuadre.detalle_estado');


//Entregas

Route::get('entrega', [App\Http\Controllers\EntregaController::class, 'index'] )->name('entrega');
Route::post('entrega/guardar', [App\Http\Controllers\EntregaController::class, 'guardar'] )->name('entrega.guardar');
Route::get('/ordenes/buscar-guia-entrega', [App\Http\Controllers\EntregaController::class, 'buscarGuiaEntrega'])->name('ordenes.buscar_guia_entrega');


//Pago de tickets
Route::get('pago', [App\Http\Controllers\PagoController::class, 'index'] )->name('pagos.inicio') ;
Route::get('/pago/crearpago', [PagoController::class, 'crearPago'])->name('pago.crearpago');
Route::post('/pago/actualizar-orden-inline', [App\Http\Controllers\PagoController::class, 'actualizarOrdenInline'])->name('pago.actualizar_orden_inline');
Route::post('/pago/guardar-registro', [App\Http\Controllers\PagoController::class, 'guardarRegistro'])->name('pago.guardar_registro');

//Reparto
Route::get('/reparto', [App\Http\Controllers\PagoController::class, 'reparto'])->name('reparto.inicio');
Route::get('/reparto/crearpago', [PagoController::class, 'crearreparto'])->name('reparto.crearreparto');
Route::get('/reparto/pagoticket/{id}', [App\Http\Controllers\PagoController::class, 'pagoticket'] )->name('reparto.pagoticket') ;
Route::post('/reparto/guardar-registro', [App\Http\Controllers\PagoController::class, 'guardarRegistroreparto'])->name('reparto.guardar_registro');

Route::get('/reparto/repartidor', [App\Http\Controllers\RepartoController::class, 'index'])->name('reparto.repartidor');
Route::get('/reparto/no-entregados', [App\Http\Controllers\RepartoController::class, 'noEntregados'])->name('reparto.no_entregados');
Route::post('/reparto/noentregado-verificar', [App\Http\Controllers\RepartoController::class, 'verificarNoEntregado'])->name('noentregado.verificar') ;
Route::post('/reparto/noentregado-actualizar', [App\Http\Controllers\RepartoController::class, 'actualizarLote'])->name('noentregado.actualizar') ;


//caja
Route::get('/caja/movimientos', [App\Http\Controllers\CajaController::class, 'index'])->name('cajero');
Route::get('/caja/cuadre', [App\Http\Controllers\CajaController::class, 'cuadre'])->name('jefe');

//Route::get('/caja/cajero', [App\Http\Controllers\CajaController::class, 'index'] )->name('cajero') ;
//Route::get('/caja/jefe', [App\Http\Controllers\CajaController::class, 'cuadre'] )->name('jefe') ;
Route::get('/caja/guardar', [App\Http\Controllers\CajaController::class, 'store'])->name('caja.store');
Route::get('/caja/listado/{id}', [App\Http\Controllers\CajaController::class, 'listado'])->name('caja.listado');
Route::get('/caja/listadofiltro', [App\Http\Controllers\CajaController::class, 'listadofiltro'])->name('caja.listadofiltro');
Route::get('/caja/ajustes', [App\Http\Controllers\CajaController::class, 'ajustes'] )->name('ajustes') ;
Route::get('/caja/guardarconcepto', [App\Http\Controllers\CajaController::class, 'guardarconcepto'] )->name('guardarconcepto') ;

Route::get('/caja/editar/{id}', [App\Http\Controllers\CajaController::class, 'editar'])->name('caja.editar');
Route::get('/caja/eliminar/{id}', [App\Http\Controllers\CajaController::class, 'eliminar'])->name('caja.eliminar');
Route::get('/caja/editandoconcepto', [App\Http\Controllers\CajaController::class, 'editandoconcepto'])->name('caja.editandoconcepto');
Route::get('/caja/exportarticket/{id}', [App\Http\Controllers\CajaController::class, 'exportarticket'])->name('caja.exportarticket');
Route::get('/caja/exportarpdf/{id}', [App\Http\Controllers\CajaController::class, 'exportarpdf'])->name('caja.exportarpdf');
Route::get('/caja/exportarexcel/{id}', [App\Http\Controllers\CajaController::class, 'exportarExcel'])->name('caja.exportarExcel');

Route::get('/caja/configuracion', [App\Http\Controllers\CajaController::class, 'configuracion'])->name('caja.configuracion');