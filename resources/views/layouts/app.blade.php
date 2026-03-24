<!doctype html>
<html lang="en" data-menu-color="dark">
    <head>
        <!-- Title Meta -->
        <meta charset="utf-8" />
        <title>Meloexpress</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta
            name="description"
            content="A fully responsive premium admin dashboard template"
        />
        <meta name="author" content="Techzaa" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
     
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

        <!-- Vendor css (Require in all Page) -->
        <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Icons css (Require in all Page) -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css (Require in all Page) -->
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Theme Config js (Require in all Page) -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="{{ asset('assets/js/config.js') }}"></script>
    </head>

    <body>
        <!-- START Wrapper -->
        <div class="wrapper">
            <!-- ========== Topbar Start ========== -->
            <header class="topbar" style="background-color: #001d7e;">
                <div class="container-xxl">
                    <div class="navbar-header">
                        <div class="d-flex align-items-center gap-2">
                            <!-- Menu Toggle Button -->
                            <div class="topbar-item">
                                <button type="button" class="button-toggle-menu">
                                    <iconify-icon
                                        icon="iconamoon:menu-burger-horizontal"
                                        class="fs-22"
                                    ></iconify-icon>
                                </button>
                            </div>

                            <!-- App Search-->
                          
                        </div>

                        <div class="d-flex align-items-center gap-1">
                          
                            <!-- Theme Setting -->
                            

                            <!-- Activity -->
                            
                            <!-- User -->
                            <div class="dropdown topbar-item">
                                <a
                                    type="button"
                                    class="topbar-button"
                                    id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <span class="d-flex align-items-center">
                                        <img
                                            class="rounded-circle"
                                            width="32"
                                            src="{{ asset('img/avatar-1.jpg') }}"
                                            alt="avatar-3"
                                        />
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <h6 class="dropdown-header">Hola {{ Auth::user()->name }}</h6>
                                    

                                    <div class="dropdown-divider my-1"></div>

                                    <a
                                        class="dropdown-item text-danger"
                                        href="{{ url('logout') }}" onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();"
                                    >
                                        <i class="bx bx-log-out fs-18 align-middle me-1"></i
                                        ><span class="align-middle">Cerrar sesión</span>
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>


                







                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

           

            <!-- ========== Topbar End ========== -->

            <!-- ========== App Menu Start ========== -->
            <div class="main-nav" style="background-color: #001d7e; color: white !important; padding-top: 10px;">
                <!-- Sidebar Logo -->
                <div class="logo-box text-center" style="background-color: #001d7e; color: white !important; padding-bottom: 25px;">
                    <a href="/home" class="logo-dark">
                        <img
                            src="{{ asset('img/logomelo.png') }}"
                           
                             width="130px"
                            alt="logo sm"
                        />
                        
                    </a>

                    <a href="index.html" class="logo-light">
                        <img
                            src="assets/images/logo-sm.png"
                            class="logo-sm"
                            alt="logo sm"
                        />
                        <img
                            src="assets/images/logo-light.png"
                            class="logo-lg"
                            alt="logo light"
                        />
                    </a>
                </div>

                <!-- Menu Toggle Button (sm-hover) -->
                <button
                    type="button"
                    class="button-sm-hover"
                    aria-label="Show Full Sidebar"
                >
                    <iconify-icon
                        icon="iconamoon:arrow-left-4-square-duotone"
                        class="button-sm-hover-icon"
                    ></iconify-icon>
                </button>

                <div class="scrollbar" data-simplebar style="color: white !important;">
                    <ul class="navbar-nav" id="navbar-nav">
                      

                        

                     

                        <li class="nav-item">
                            <a
                                class="nav-link menu-arrow"
                                href="#sidebarEcommerce"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarEcommerce"
                            >
                                <span class="nav-icon">
                                    <iconify-icon
                                        icon="iconamoon:delivery-fill"
                                    ></iconify-icon>
                                </span>
                                <span class="nav-text"> Ordenes</span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav sub-navbar-nav">
                                      <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ordenes"
                                            >Busqueda manual</a
                                        >
                                    </li>
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ordenes/busqueda_ticket"
                                            >Busqueda por ticket</a
                                        >
                                    </li>
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ordenes/crear"
                                            >Crear orden</a
                                        >
                                    </li>
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ordenes/toma-foto"
                                            >Toma de fotografia</a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ordenes/asignar-mercancia"
                                            >Asignar mercancia</a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ubicacion/buscar"
                                            >Asignación Ubicación</a
                                        >
                                    </li>        

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/carga/buscar"
                                            >Asignación de carga </a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/carga/asignar-reparto"
                                            >Asignación de reparto </a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/carga/lista-reparto"
                                            >Lista de reparto </a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/orden/cuadre-paqueteria"
                                            >Cuadre de paqueteria </a
                                        >
                                    </li>
                                    

                                     <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ordenes/buscarfallidas"
                                            >Entregas fallidas </a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ordenes/reenvios-devoluciones"
                                            >Reenvios y Devoluciones </a
                                        >
                                    </li>
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/ordenes/listareenvios-devoluciones"
                                            >Lista Reenvios y Devoluciones </a
                                        >
                                    </li>

                                    
                                </ul>
                            </div>
                        </li>

                        


                        <li class="nav-item">
                            <a
                                class="nav-link menu-arrow"
                                href="#sidebarEcommerce3"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarEcommerce3"
                            >
                                <span class="nav-icon">
                                    <iconify-icon
                                        icon="iconamoon:shopping-card-remove-bold"
                                    ></iconify-icon>
                                </span>
                                <span class="nav-text"> Facturacion</span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce3">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/recepcion/elegircomercio"
                                            >Recepción</a
                                        >
                                    </li>
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/entrega"
                                            >Entrega de paqueteria</a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/pago"
                                            >Pago</a
                                        >
                                    </li>

                                    
                                  
                                    
                                   

                                    
                                </ul>






                                <li class="nav-item">
                            <a
                                class="nav-link menu-arrow"
                                href="#sidebarCaja"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarCaja"
                            >
                                <span class="nav-icon">
                                    <iconify-icon
                                        icon="iconamoon:invoice-duotone"
                                    ></iconify-icon>
                                </span>
                                <span class="nav-text"> Caja</span>
                            </a>
                            <div class="collapse" id="sidebarCaja">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/caja/movimientos"
                                            >Movimientos de caja</a
                                        >
                                    </li>
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/caja/cuadre"
                                            >Cuadre de caja</a
                                        >
                                    </li>

                                  
                                                            
                                </ul>







                                 <li class="nav-item">
                            <a
                                class="nav-link menu-arrow"
                                href="#sidebarEcommerce4"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarEcommerce4"
                            >
                                <span class="nav-icon">
                                    <iconify-icon
                                        icon="iconamoon:delivery-fill"
                                    ></iconify-icon>
                                </span>
                                <span class="nav-text"> Repartidores </span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce4">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/reparto"
                                            >Pagos</a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/reparto/repartidor"
                                            >Mis Repartos</a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/reparto/no-entregados"
                                            >No entregados</a
                                        >
                                    </li>
                                   
                                   

                                    
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="/usuarios">
                                <span class="nav-icon">
                                    <iconify-icon
                                        icon="iconamoon:profile-duotone"
                                    ></iconify-icon>
                                </span>
                                <span class="nav-text"> Usuarios </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/comercios">
                                <span class="nav-icon">
                                    <iconify-icon
                                        icon="iconamoon:store-duotone"
                                    ></iconify-icon>
                                </span>
                                <span class="nav-text"> Comercios </span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a
                                class="nav-link menu-arrow"
                                href="#sidebarReportes"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarReportes"
                            >
                                <span class="nav-icon">
                                    <iconify-icon
                                        icon="iconamoon:invoice-duotone"
                                    ></iconify-icon>
                                </span>
                                <span class="nav-text"> Reportes </span>
                            </a>
                            <div class="collapse" id="sidebarReportes">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/reportes/cajas"
                                            >Reporte de caja</a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/reportes/unidades"
                                            >Reporte de unidad</a
                                        >
                                    </li>
                                   

                                  
                                                            
                                </ul>

                        


                        <li class="nav-item">
                            <a
                                class="nav-link menu-arrow"
                                href="#sidebarEcommerce2"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarEcommerce2"
                            >
                                <span class="nav-icon">
                                    <iconify-icon
                                        icon="iconamoon:settings-duotone"
                                    ></iconify-icon>
                                </span>
                                <span class="nav-text"> Configuración </span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce2">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/configuracion"
                                            >Puntos</a
                                        >
                                    </li>
                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/cajones"
                                            >Cajas</a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/unidades"
                                            >Unidades</a
                                        >
                                    </li>

                                    <li class="sub-nav-item">
                                        <a
                                            class="sub-nav-link"
                                            href="/caja/configuracion"
                                            >Conceptos de caja</a
                                        >
                                    </li>
                                   

                                    
                                </ul>
                            </div>
                        </li>





                        

                       

                        
                        <!-- end Demo Menu Item -->
                    </ul>
                </div>
            </div>

            <!-- ========== App Menu End ========== -->
        </nav>


        <div class="content-wrapper p-3">
        <section class="page-content">
            @yield('content')
        </section>
    </div>



    
                <!-- ========== Footer Start ========== -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-center">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                © {{ now()->year }} - Melo Express
                               
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- ========== Footer End ========== -->

            </div>
            <!-- ==================================================== -->
            <!-- End Page Content -->
            <!-- ==================================================== -->
        </div>
        <!-- END Wrapper -->

 

<!-- Scripts -->
 <!-- Vendor Javascript (Require in all Page) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ asset('assets/js/vendor.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>
</html>