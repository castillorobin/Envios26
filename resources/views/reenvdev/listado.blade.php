@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


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

/* --- COMPORTAMIENTO EN ESCRITORIO (PC/TABLET HORIZONTAL) --- */
@media (min-width: 768px) {
    /* El contenedor de la derecha no debe crecer más de lo necesario */
    .w-md-auto {
        width: auto !important;
    }
    
    /* Forzamos el ancho del input-group de fecha solo en pantallas grandes */
    #filtro-fecha {
        max-width: 250px;
    }
    
    .input-group {
        width: auto !important;
    }
}

/* --- COMPORTAMIENTO EN MÓVIL --- */
@media (max-width: 767.98px) {
    .search-bar, .input-group, #btn-reset-filtros {
        width: 100% !important;
        margin-bottom: 5px;
    }
}
</style>
 
<div class="container-xxl">
        <div class="row">
                        <div class="col">
                            <div class="card">
                               <div class="card-body">
                                    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3 w-100">
                                        
                                        <div class="search-bar w-100 w-md-auto" style="min-width: 250px;">
                                            <div class="position-relative">
                                                <span class="position-absolute top-50 start-0 translate-middle-y ps-2">
                                                    <i class="bx bx-search-alt"></i>
                                                </span>
                                                <input type="search" class="form-control ps-4" id="search" placeholder="Buscar...">
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <!-- end card body -->
                                <div class="table-responsive table-centered">
                                    <table class="table text-nowrap mb-0" id="tabla-usuarios">
                                        <thead class="bg-light bg-opacity-50">
                                           
                                            <tr>
                                                <th>Guía</th>
                                                <th>Fecha de entrega</th>
                                                <th>Destinatario</th>
                                                <th>Destino</th>
                                                <th>Ubicación</th>
                                                <th>Ticket</th>
                                                <th>Fecha devolucion</th>
                                                <th>Punto</th>
                                                
                                                <th>Status</th>
                                                
                                            </tr>
                                            
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>
                                             @foreach($ordenes as $orden)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('ordenes.detalle', $orden->id) }}">
                                                        {{ $orden->guia }}
                                                    </a>
                                                </td>
                                                <td>
                                                    
                                                    @if($orden->hora_entrega != "NULL" && $orden->fecha_entrega != null)
                                                         {{ date('d/m/Y', strtotime($orden->fecha_entrega)) }} 
                                                    @else
                                                         N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $orden->destinatario }}
                                                </td>
                                                <td>
                                                    {{ $orden->direccion }}
                                                </td>
                                                <td>
                                                    {{ $orden->destino }}
                                                </td>
                                                <td>
                                                    @if($orden->recepcion)
                                                        <span class="badge bg-light text-dark border">
                                                            <i class="bx bx-receipt"></i> {{ $orden->recepcion->codigo }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">Sin Ticket</span>
                                                    @endif
                                                </td>
                                                <td> {{ $orden->fdevolucion }} </td>
                                                <td>{{ $orden->pdevolucion }}</td>
                                                
                                                <td>
                                                    {{ $orden->estado }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <!-- end tbody -->
                                    </table>
                                    <!-- end table -->
                                </div>

                                <div class="card-footer bg-transparent border-top">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div id="dt-info-container"></div>
                                        <div id="dt-pagination-container"></div>
                                    </div>
                                </div>
                                <!-- table responsive -->
                                <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                                    <div class="justify-content-end w-100 d-flex">
                                   <button onclick="window.history.back()" class="btn btn-danger justify-content-end " >Regresar</button>
                                   </div>
                                </div>
                                
                            </div>
                            
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>          
</div>




<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            
<script>
    $(document).ready(function() {
    // 1. Inicialización de DataTable
    var table = $('#tabla-usuarios').DataTable({
        "dom": 'rtip',
        "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" },
        "drawCallback": function() {
            $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
            var container = $(this.api().table().container());
            $('#dt-info-container').empty().append(container.find('.dataTables_info'));
            $('#dt-pagination-container').empty().append(container.find('.dataTables_paginate'));
        }
    });

    // 2. Configuración de DateRangePicker
    var start = moment().subtract(29, 'days');
    var end = moment();

    const picker = $('#filtro-fecha').daterangepicker({
        startDate: start,
        endDate: end,
        autoUpdateInput: false, // Evita que se ponga fecha al cargar
        locale: {
            format: 'DD/MM/YYYY',
            applyLabel: "Aplicar",
            cancelLabel: "Limpiar",
            customRangeLabel: "Personalizado"
        },
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
           'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
           'Este Mes': [moment().startOf('month'), moment().endOf('month')],
           'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    // Evento al aplicar fechas
    $('#filtro-fecha').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        filtrarPorFecha(picker.startDate, picker.endDate);
    });

    // Evento al dar "cancelar" en el picker (actúa como limpiar)
    $('#filtro-fecha').on('cancel.daterangepicker', function(ev, picker) {
        resetearFiltros();
    });

    // 3. Lógica de Filtrado personalizada
    function filtrarPorFecha(startDate, endDate) {
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var dateStr = data[1]; // Columna Fecha de entrega
                if (dateStr === "N/A" || !dateStr) return false;

                var rowDate = moment(dateStr, 'DD/MM/YYYY');
                return rowDate.isBetween(startDate.startOf('day'), endDate.endOf('day'), null, '[]');
            }
        );
        table.draw();
        $.fn.dataTable.ext.search.pop();
    }

    // 4. Lógica del Botón Limpiar Todo
    function resetearFiltros() {
        $('#search').val(''); // Limpia buscador texto
        $('#filtro-fecha').val(''); // Limpia input fecha
        table.search('').draw(); // Resetea búsqueda de tabla
        
        // Elimiamos cualquier filtro de búsqueda personalizado de la pila
        $.fn.dataTable.ext.search = []; 
        table.draw();
    }

    $('#btn-reset-filtros').on('click', function() {
        resetearFiltros();
    });

    // Buscador de texto normal
    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });
});
</script>





@endsection



