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

<div >
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Pago</h4>
                                
                            </div>
                        </div>
                    </div>
                    <!-- ========== Page Title End ========== -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                        <div>
                                            <form class="d-flex flex-wrap align-items-center gap-2">
                                                <label for="inputPassword2" class="visually-hidden">Buscar </label>
                                                <div class="search-bar me-3">
                                                    <span><i class="bx bx-search-alt"></i></span>
                                                    <input type="search" class="form-control" id="search" placeholder="Buscar...">
                                                </div>

                                                
                                            </form>
                                        </div>
                                        <div>
                                            <div class="d-flex flex-wrap gap-2 justify-content-md-end align-items-center">
                                               

                                            </div>
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

                    <div class="tab-content pt-0">
                        <div class="tab-pane show active" id="team-list" role="tabpanel">
                            <div class="card overflow-hidden">
                                <div class="bg-light-subtle border-bottom p-2">
                                    <label style="font-weight: bold; margin-bottom: 0;">
                                        <i class="bx bx-money-withdraw me-1 text-primary"></i>
                                        Procesando pago para: 
                                        <span class="text-primary">
                                            {{ $recepcion->datosComercio ? $recepcion->datosComercio->nombre : 'Comercio no encontrado' }}
                                        </span>
                                    </label>
                                </div>
                                <div class="table-responsive table-centered p-3">
                                    <table class="table text-nowrap mb-0" id="tabla-usuarios">
                                        <thead class="teble-light">
                                            <tr>
                                                <td># de guia</td>
                                                <th>Destinatario</th>                                                
                                                <th>Destino</th>
                                                <th>Fecha de entrega</th>
                                                <th>Tipo</th>
                                                <th>Status</th>
                                                <th>Cobro EV</th>
                                                <th>Precio</th>
                                                <th>Envio</th>
                                                <th>Total a remunerar</th>
                                                <th>Acciones</th>

                                            </tr>
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>
                                            @foreach($ordenes as $orden)
                                            <tr data-id="{{ $orden->id }}">    
                                                <td>{{ $orden->guia }}</td>
                                                <td>{{ $orden->destinatario }}</td>
                                                <td>{{ $orden->destino }}</td>
                                                <td>{{ $orden->fecha_entrega }}</td>
                                                <td><span class="badge text-bg-dark">{{ $orden->tipo }}</span></td>
                                                <td>
                                                    @switch($orden->estado)
                                                        @case('Recepcionado') <span class="badge text-bg-secondary">Recepcionado</span> @break
                                                        @case('Creado') <span class="badge text-bg-primary">Creado</span> @break
                                                        @case('No entregado') <span class="badge text-bg-danger">No entregado</span> @break
                                                        @case('Fallido') <span class="badge text-bg-warning">Fallido</span> @break
                                                        @case('Entregado') <span class="badge text-bg-success">Entregado</span> @break
                                                        @default <span class="badge text-bg-light">{{ $orden->estado }}</span>
                                                    @endswitch
                                                </td>
                                                <td class="col-cobro" data-value="{{ $orden->cobro }}">{{ $orden->cobro }}</td>
                                                <td class="col-precio" data-value="{{ $orden->precio }}">{{ number_format($orden->precio, 2) }}</td>
                                                <td class="col-envio" data-value="{{ $orden->envio }}">{{ number_format($orden->envio, 2) }}</td>
                                                <td class="col-total" data-value="{{ $orden->total }}">{{ number_format($orden->total, 2) }}</td>
                                                
                                                <td class="acciones">
                                                    <button class="btn btn-sm btn-warning btn-editar">Editar</button>
                                                    <button class="btn btn-sm btn-success btn-guardar d-none">Guardar</button>
                                                    <button class="btn btn-sm btn-secondary btn-cancelar d-none">Cancelar</button>

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
                               
                            </div>
                            <!-- end card -->
                        </div>

                       
                    </div>
                </div>

<script>
    window.onload = function() {
        if (typeof jQuery !== 'undefined') {
            $(document).ready(function() {
                var table = $('#tabla-usuarios').DataTable({
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

                $(document).on('click', '.btn-editar', function() {
        let row = $(this).closest('tr');
        
        // Transformar Cobro EV en Select
        let cobroVal = row.find('.col-cobro').data('value');
        row.find('.col-cobro').html(`
            <select class="form-select form-select-sm edit-cobro">
                <option value="Pendiente" ${cobroVal == 'Pendiente' ? 'selected' : ''}>Pendiente</option>
                <option value="Cobrado" ${cobroVal == 'Cobrado' ? 'selected' : ''}>Cobrado</option>
            </select>
        `);

        // Transformar Precio, Envio y Total en Inputs numéricos
        transformToInput(row, '.col-precio', 'edit-precio');
        transformToInput(row, '.col-envio', 'edit-envio');
        transformToInput(row, '.col-total', 'edit-total');

        // Alternar botones
        row.find('.btn-editar').addClass('d-none');
        row.find('.btn-guardar, .btn-cancelar').removeClass('d-none');
    });

    function transformToInput(row, selector, className) {
        let val = row.find(selector).data('value');
        row.find(selector).html(`<input type="number" step="0.01" class="form-control form-control-sm ${className}" value="${val}">`);
    }

    // EVENTO CANCELAR (Recargar la página o restaurar valores)
    $(document).on('click', '.btn-cancelar', function() {
        location.reload(); // La forma más segura de restaurar el estado original del DataTable
    });

    // EVENTO GUARDAR
    $(document).on('click', '.btn-guardar', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');
        
        let datos = {
            _token: "{{ csrf_token() }}",
            id: id,
            cobro: row.find('.edit-cobro').val(),
            precio: row.find('.edit-precio').val(),
            envio: row.find('.edit-envio').val(),
            total: row.find('.edit-total').val()
        };

        // Enviar vía AJAX al controlador
        $.ajax({
            url: "{{ route('pago.actualizar_orden_inline') }}", // Debes crear esta ruta
            method: 'POST',
            data: datos,
            success: function(res) {
                if(res.success) {
                    Swal.fire('¡Actualizado!', res.message, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
            }
        });
    });
            });
        }
    };
</script>

@endsection

