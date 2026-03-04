@extends('layouts.app')

@section('content')

<style>
    /* Estilo para integrar DataTables con el diseño de la plantilla */
    .dataTables_length select {
        padding: 5px 10px;
        border-radius: 5px;
        border: 1px solid #e1e3ea;
    }
    .dataTables_info, .dataTables_paginate {
        margin-top: 15px !important;
    }
    /* Ocultar el buscador por defecto de DataTables */
    .dataTables_filter {
        display: none;
    }
    /* Ajuste de ancho de tu buscador personalizado */
    .search-bar input {
        width: 250px !important;
    }
</style>

<style>
    /* Forzar el estilo redondeado de Reback en los botones de DataTables */
    .pagination-rounded .page-item .page-link {
        border-radius: 50% !important;
        margin: 0 3px !important;
        border: none;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }

    .pagination-rounded .page-item.active .page-link {
        background-color: #3e60d5 !important; /* Azul primario de Reback */
        color: white !important;
        box-shadow: 0 2px 6px 0 rgba(62, 96, 213, 0.5);
    }

    /* Ajuste para los botones 'Anterior' y 'Siguiente' para que no sean círculos perfectos */
    .pagination-rounded .page-item:first-child .page-link,
    .pagination-rounded .page-item:last-child .page-link {
        border-radius: 5px !important;
        width: auto !important;
        padding: 0 15px;
    }
</style>

<style>
    /* Aseguramos que la info y paginación no tengan márgenes extra al estar fuera */
    .dataTables_info, .dataTables_paginate {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    #dt-pagination-container .dataTables_paginate {
        display: flex;
        justify-content: flex-end;
    }
    
    /* Evita que el contenedor de la tabla se vea vacío si se mueven los elementos */
    .dataTables_wrapper {
        padding: 0 !important;
    }

    /* Evitar saltos visuales al mover elementos */
    #dt-info-container, #dt-pagination-container {
        min-height: 40px;
        display: flex;
        align-items: center;
    }

    .dataTables_info {
        margin-top: 0 !important;
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>

<style>
    /* Ocultar el buscador original por si acaso */
    .dataTables_filter { display: none !important; }

    /* Forzar el estilo redondeado de Reback */
    .pagination-rounded .page-item .page-link {
        border-radius: 50% !important;
        margin: 0 3px !important;
        border: none;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }

    /* Color azul oficial de Reback para el botón activo */
    .pagination-rounded .page-item.active .page-link {
        background-color: #3e60d5 !important; 
        color: white !important;
        box-shadow: 0 2px 6px 0 rgba(62, 96, 213, 0.5);
    }

    .pagination-rounded .page-item:first-child .page-link,
    .pagination-rounded .page-item:last-child .page-link {
        border-radius: 5px !important;
        width: auto !important;
        padding: 0 15px;
    }

    /* Contenedores externos */
    #dt-info-container .dataTables_info {
        margin-top: 0 !important;
        padding: 0 !important;
        font-size: 0.875rem;
    }

    #dt-pagination-container .dataTables_paginate {
        margin-top: 0 !important;
        padding: 0 !important;
    }
</style>





<div class="container-xxl"> 



                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Cuadre de caja</h4>
                                
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                        <div>
                                             <div class="d-flex gap-2">
                                                <input type="text" id="search" class="form-control" style="max-width: 400px;" placeholder="Buscar" autofocus>
                                               
                                            </div>
                                           
                                        </div>
                                         <div>
                                           
                                        </div>
                                       
                                        <!-- end col-->
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col-->
                    </div>




                    <div class="row">
                        
                        <!-- end col -->
                                    <div class="col-xl-12">
                                         <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                        
                                        </div>
                                    </div>

                                    <div class="table-responsive table-centered mt-3">
                                       <table class="table text-nowrap mb-0" id="tabla-lote">
                                        <thead class="table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha</th>
                                                <th class="text-center">Cajero</th>
                                                <th class="text-center">Saldo</th>
                                                <th class="text-center">Estado</th>
                                                
                                            </tr>
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>
                                           @isset($cajas)
                                                        @foreach ($cajas as $caja) 
                                                            <tr class="'table-row-gray' : 'table-row-white' ">
                                                                    <td class="text-center"> 
                                                                        <a href="/caja/listado/{{ $caja->id }}" class="form-control-plaintext">
                                                                    {{ $caja->id }}
                                                                    </a>
                                                                    </td>
                                                                    <td class="text-center">{{ date('d/m/Y', strtotime($caja->created_at)) }}</td>
                                                                    <td class="text-center">{{$caja->cajero}}</td>
                                                                    <td class="text-center">$ {{$caja->saldo}}</td>
                                                                    <td class="text-center" >
                                                                        @if($caja->estado == 0)
                                                                        <span class="badge text-bg-success" ><span style="color:white; font-weight:bolder;"> Abierta</span></span>
                                                                        @endif
                                                                        @if($caja->estado == 1)
                                                                        <span class="badge text-bg-danger" > <span style="color:white; font-weight:bolder;">Cerrada</span></span>
                                                                        @endif
                                                                    </td>
                                                        
                                                            </tr>
                                                        @endforeach
                                            @endisset

                                           
                                            
                                        </tbody>
                                        <!-- end tbody -->
                                    </table>

                                       
                                    </div>

                                    <div class="card-footer bg-transparent border-top">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                                <div id="dt-info-container"></div>
                                                <div id="dt-pagination-container"></div>
                                            </div>
                                        </div>
                                    <!-- end table responsive -->
                                </div>
                                <!-- end card body -->
                            
                        </div>
                        <!-- end col -->




                        




                    </div>
</div>














<script>
    window.onload = function() {
        if (typeof jQuery !== 'undefined') {
            $(document).ready(function() {
                var table = $('#tabla-lote').DataTable({
                    "paging": true,
                    "info": true,
                    "pageLength": 10,
                    "lengthMenu": [5, 10, 25, 50],
                    "order": [[ 0, "asc" ]],
                    // 't' es tabla, 'i' es info, 'p' es paginación. 
                    // Los incluimos para que se generen y podamos moverlos.
                    "dom": 'tip', 
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
                        "paginate": {
                            "previous": "<i class='bx bx-chevron-left'></i>",
                            "next": "<i class='bx bx-chevron-right'></i>"
                        }
                    },
                    "drawCallback": function(settings) {
                        // 1. Aplicamos el diseño redondeado de Reback
                        $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
                        
                        // 2. MOVER los controles a tus contenedores externos
                        var api = this.api();
                        var container = $(api.table().container());
                        
                        // Inyectamos los elementos dentro de tus contenedores específicos
                        $('#dt-info-container').append(container.find('.dataTables_info'));
                        $('#dt-pagination-container').append(container.find('.dataTables_paginate'));
                    }
                });

                // Buscador personalizado
                $('#search').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
        }
    };
</script>

@endsection