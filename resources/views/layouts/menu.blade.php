
<li class="side-menus {{ Request::is('home') ? 'active' : '' }} ">
    <a class="nav-link" href="/home">
    <i class="fas fa-home"></i><span>Inicio</span>
    </a>
    </li>
    @can('ver-envios')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-building "></i> Almacen
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/pedidos"><i class="fas fa-truck"></i> Envios</a>
       @can('ver-recolecta')
          <a class="dropdown-item" href="/recolecta"><i class="fas fa-archive"></i>Recolectas</a>
          @endcan
          @can('ver-comercios')
          <a class="dropdown-item" href="/vendedores"><i class="fas fa-shopping-cart"></i> Comercios</a>
          @endcan
          @can('editar-empleados')
          <a class="dropdown-item" href="/repartidores"><i class="fas fa-user"></i> Empleados</a>
          @endcan
        </div>
      </li>


      @can('editar-envios')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-keyboard"></i> Digitado
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/pedido/indexdigitado"><i class="fas fa-list-ul"></i>Listado</a>
          <a class="dropdown-item" href="/pedido/crearp"><i class="fas fa-dolly"></i>Personalizado</a>
          <a class="dropdown-item" href="/pedido/crearpf"><i class="fas fa-dolly"></i>Punto Fijo</a>
          <a class="dropdown-item" href="/pedido/crearcas"><i class="fas fa-dolly"></i>Casillero</a>
         
        </div>
      </li>
      @endcan

    
      @can('editar-envios')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-keyboard"></i> Estados
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/estatus"><i class="fas fa-list-ul"></i>Cambiar Estado</a>
        <a class="dropdown-item" href="/reportes/repobodega"><i class="fas fa-calendar-alt"></i>Cambiar Estado Bodega</a>
        <a class="dropdown-item" href="/reportes/repobodegafecha"><i class="fas fa-calendar-alt"></i>Cambiar Estado Fechas</a>
        <a class="dropdown-item" href="/estado/estadolote"><i class="fas fa-list-ul"></i>Cambiar en Lote</a>
        <a class="dropdown-item" href="/estado/estadomanual"><i class="fas fa-dolly"></i>Estado Manual</a>
	<a class="dropdown-item" href="/pedido/noretirado"><i class="fas fa-dolly"></i>No retirado</a>

       
         
        </div>
      </li>
      

  
     
    <li>
  
     <a class="nav-link" href="/pedido/estado">
     <i class="fas fa-truck"></i><span>Repartidores</span>
    </a>
    </li>
    @endcan
    @can('ver-factura')

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-money-bill-wave"></i> Facturación
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/factura/facturando"><i class="fas fa-money-bill-wave"></i>Pagos</a>
          
          <a class="dropdown-item" href="/factura/listado"><i class="fas fa-file-invoice"></i>Detalles de Pago</a>

          <a class="dropdown-item" href="/factura/listadopagos"><i class="fas fa-file-invoice"></i>Listado de Pagos</a>
          
        </div>
      </li>



    @endcan
    
    @can('editar-rol')

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-building "></i> Reportes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/reportes"><i class="fas fa-calendar-alt"></i>Reporte diario</a>

         
          
          <a class="dropdown-item" href="/reportes/ganancia"><i class="fas fa-money-bill-wave"></i>Reporte de ganancia</a>
          
          <a class="dropdown-item" href="/reportes/cobros"><i class="fas fa-money-check-alt"></i>Reporte de cobro</a>
          
        </div>
      </li>

      @endcan



    @can('crear-rol')
    <li>
    
     <a class="nav-link" href="/usuarios">
    <i class="fas fa-users"></i><span>Usuarios</span>
    </a>
    </li>
    @endcan
    @can('crear-rol')
    <li>
    <a class="nav-link" href="/roles">
    <i class="fas fa-user-tag"></i><span>Roles</span>
    </a>
    </li>
    @endcan
    
    @can('crear-rol')
    <li>
    
     <a class="nav-link" href="/descargar-respaldo">
    <i class="fas fa-users"></i><span>Backup</span>
    </a>
    </li>
    @endcan

    @endcan
<!--
    <li>
    
     <a class="nav-link" href="/comercio/listado">
     <i class="fas fa-truck"></i><span>Ver mis envios</span>
    </a>
    </li>
-->

    
