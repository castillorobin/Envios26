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

<style>
    /* Forzar que el buscador de Select2 se muestre sobre el modal */
    .select2-search__field {
        display: block !important;
    }
    .select2-dropdown {
        z-index: 1061 !important; /* Por encima del modal de Bootstrap (1060) */
    }
</style>

<style>
    /* Igualar altura de Select2 con los inputs de Bootstrap (38px aprox) */
    .select2-container .select2-selection--single {
        height: 38px !important;
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.375rem !important;
    }

    /* Centrar el texto verticalmente dentro del select */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px !important;
        padding-left: 12px !important;
        color: #6c757d !important;
    }

    /* Ajustar la posición de la flechita lateral */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
        right: 10px !important;
    }

    /* Quitar el borde azul de enfoque original de Select2 para usar el de la plantilla */
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3e60d5 !important;
        outline: 0;
    }
</style>

<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 fw-semibold">Cuadre de paqueteria - Unidad: {{ $unidadactual }}</h4>
                
            </div>
        </div>
    </div>
        <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                        <div>
                                            <form class="d-flex flex-wrap align-items-center gap-2">
                                                <label for="inputPassword2" class="visually-hidden">Cuadre de paqueteria</label>
                                                
                                                
                                            </form>
                                        </div>

                                        
                                    </div>
                                </div>
                                <!-- end card body -->
                                <div class="table-responsive table-centered">
                                    <table class="table text-nowrap mb-0" id="tabla-usuarios">
                                        <thead class="bg-light bg-opacity-50">
                                           
                                            <tr>
                                                <th>Total de guias entregadas</th>
                                                <th>Total de guias No entregadas</th>
                                                <th>Total de Cambios</th>
                                                
                                                
                                            </tr>
                                            
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <h4 class="mt-2 text-success fw-bold">{{ $totales['entregados'] }}</h4>
                                                    <span class="text-muted small">Paquetes</span>
                                                </td>

                                                <td class="text-center">
                                                    <h4 class="mt-2 text-danger fw-bold">{{ $totales['no_entregados'] }}</h4>
                                                    <span class="text-muted small">Paquetes</span>
                                                </td>

                                                <td class="text-center">
                                                    <h4 class="mt-2 text-warning fw-bold">{{ $totales['cambios'] }}</h4>
                                                    <span class="text-muted small">Paquetes</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!-- end tbody -->
                                    </table>
                                    
                                    <!-- end table -->
                                </div>

                                

                                <div class="card-footer bg-transparent border-top">
                                   <a href="{{ route('cuadre.paqueteria') }}" class="btn btn-secondary mt-3" style="width: 150px;">
                    <i class="bx bx-arrow-back me-1"></i> Cerrar
                </a>
                                </div>
                                <!-- table responsive -->
                                <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                                    
                                   
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>          
</div>

<script>
$(document).ready(function() {
    // Inicializar la tabla de totales de forma simple
    $('#tabla-usuarios').DataTable({
        "paging": false,
        "searching": false,
        "info": false,
        "ordering": false,
        "columnDefs": [
            { "className": "text-center", "targets": "_all" }
        ]
    });
});
</script>

@endsection



