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
    /* FORZAR GRIS CLARO: Atacamos el TD para que el fondo azul de la fila no se vea */
    #tabla-usuarios tbody tr.selected td {
        background-color: #f2f2f2 !important;
        color: #333 !important;
        box-shadow: none !important;
    }

    /* ICONO DE CHECK */
    #tabla-usuarios tbody tr.selected td:first-child {
        padding-left: 30px !important;
        position: relative;
    }

    #tabla-usuarios tbody tr.selected td:first-child::before {
        content: '\eb21'; 
        font-family: 'boxicons';
        position: absolute;
        left: 8px;
        top: 50%;
        transform: translateY(-50%);
        color: #198754;
        font-size: 1.1rem;
    }

    /* Quitar el azul de selección de texto */
    #tabla-usuarios {
        user-select: none;
        -webkit-user-select: none;
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
                                                <th>To. a remunerar</th>
                                                <th>Est. del pago</th>
                                                <th>Acciones</th>

                                            </tr>
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>
                                            @foreach($ordenes as $orden)
                                            @if($orden->pago != 'Pagado')
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
                                                <td class="col-total-valor" data-valor="{{ $orden->total }}">
                                                    {{ number_format($orden->total, 2) }}
                                                </td>
                                                <td class="col-pago" data-value="{{ $orden->pago }}">
                                                    @switch($orden->pago)
                                                        @case('Pendiente') <span class="badge text-bg-danger">Pendiente</span> @break
                                                        @case('Pagado') <span class="badge text-bg-success">Pagado</span> @break
                                                        @default <span class="badge text-bg-light">{{ $orden->pago }}</span>
                                                    @endswitch  
                                                </td>

                                                
                                                <td class="acciones">
                                                    <button class="btn btn-sm btn-warning btn-editar">Editar</button>
                                                    <button class="btn btn-sm btn-success btn-guardar d-none">Guardar</button>
                                                    <button class="btn btn-sm btn-secondary btn-cancelar d-none">Cancelar</button>

                                                </td>
                                            </tr>
                                            @endif
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
                                    <div style="margin-top: 10px; float: right; font-size: 1.25rem;">
                                    Total a remunerar: <strong id="total-pagar">$ 0.00</strong>
                                    <button class="btn btn-md btn-success" id="btn-pagar" style="margin-left: 10px;">Pago</button>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- end card -->
                        </div>

                       
                    </div>
                </div>











                <div class="modal fade" id="modalConfirmarPago" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title text-white"><i class="bx bx-check-shield me-1"></i> Confirmar Registro de Pago</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('pago.guardar_registro') }}" method="POST">
                                @csrf
                                <input type="hidden" name="ids_ordenes" id="modal_ids_ordenes">
                                <input type="number" name="recepcion_id" value="{{ $recepcion->id }}" class="d-none">
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Usuario</label>
                                            <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Fecha y Hora</label>
                                            <input type="text" name="fecha_pago" class="form-control bg-light" value="{{ now()->format('d/m/Y H:i') }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Subtotal</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" step="0.01" name="subtotal" id="modal_subtotal" class="form-control fw-bold" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-danger">Descuento</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" step="0.01" name="descuento" id="modal_descuento" class="form-control" value="0.00">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Nota de descuento</label>
                                            <textarea name="nota_descuento" class="form-control" rows="2" placeholder="Motivo del descuento (opcional)"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-success fw-bold">Total a Remunerar</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white border-success">$</span>
                                                <input type="number" step="0.01" name="total" id="modal_total_final" class="form-control form-control-lg border-success fw-bold text-success" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Estado de Pago</label>
                                            <select name="estado_pago" class="form-select border-primary" required>
                                                <option value="Pagado" selected>Pagado</option>
                                                <option value="Revisado">Revisado</option>
                                            </select>
                                        </div>
                                        <input type="text" name="comercio" value="{{ $recepcion->datosComercio ? $recepcion->datosComercio->nombre : 'Comercio no encontrado' }}" class="d-none">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success px-4">Registrar Pago</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>












<script>
    window.onload = function() {
        if (typeof jQuery !== 'undefined') {
            $(document).ready(function() {
                // 1. Inicializar DataTable
                var table = $('#tabla-usuarios').DataTable({
                    "paging": true,
                    "info": true,
                    "pageLength": 10,
                    "lengthMenu": [5, 10, 25, 50],
                    "order": [[ 0, "asc" ]],
                    "dom": 'tip', 
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
                        "paginate": {
                            "previous": "<i class='bx bx-chevron-left'></i>",
                            "next": "<i class='bx bx-chevron-right'></i>"
                        }
                    },
                    "drawCallback": function(settings) {
                        $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
                        var container = $(this.api().table().container());
                        $('#dt-info-container').empty().append(container.find('.dataTables_info'));
                        $('#dt-pagination-container').empty().append(container.find('.dataTables_paginate'));
                    }
                });

                // 2. Estado inicial del botón pagar
                $('#btn-pagar').prop('disabled', true).addClass('btn-secondary').removeClass('btn-success');

                // 3. Buscador personalizado
                $('#search').on('keyup', function() {
                    table.search(this.value).draw();
                });

                // --- LÓGICA DE SELECCIÓN DE FILA (ESTO ES LO QUE FALTABA) ---
                $('#tabla-usuarios tbody').on('click', 'tr', function(e) {
                    // Si el clic fue en botones de acción o inputs, ignorar selección de fila
                    if ($(e.target).closest('.acciones, input, select').length) {
                        return;
                    }

                    // Alternar clase selected
                    $(this).toggleClass('selected');
                    
                    // Actualizar sumatoria
                    actualizarTotalSeleccionado();
                });

                // --- LÓGICA DE TOTALES ---
                let subtotalActual = 0;

                function actualizarTotalSeleccionado() {
                    subtotalActual = 0;
                    // Recorrer filas con clase 'selected'
                    $('#tabla-usuarios tbody tr.selected').each(function() {
                        let valor = parseFloat($(this).find('.col-total-valor').data('valor')) || 0;
                        subtotalActual += valor;
                    });

                    // Mostrar en el label de abajo
                    $('#total-pagar').text('$ ' + subtotalActual.toLocaleString('en-US', { minimumFractionDigits: 2 }));
                    
                    // Habilitar/Deshabilitar botón pagar
                    if (subtotalActual > 0) {
                        $('#btn-pagar').prop('disabled', false).removeClass('btn-secondary').addClass('btn-success');
                    } else {
                        $('#btn-pagar').prop('disabled', true).addClass('btn-secondary').removeClass('btn-success');
                    }
                }

                // --- LÓGICA DEL MODAL ---
                $('#btn-pagar').on('click', function() {
                    let idsSeleccionados = [];
                    $('#tabla-usuarios tbody tr.selected').each(function() {
                        idsSeleccionados.push($(this).data('id'));
                    });

                    if (idsSeleccionados.length === 0) return;

                    $('#modal_ids_ordenes').val(JSON.stringify(idsSeleccionados));
                    $('#modal_subtotal').val(subtotalActual.toFixed(2));
                    calcularTotalModal();

                    const modalPago = new bootstrap.Modal(document.getElementById('modalConfirmarPago'));
                    modalPago.show();
                });

                $('#modal_descuento').on('input', function() {
                    calcularTotalModal();
                });

                function calcularTotalModal() {
                    const subtotal = parseFloat($('#modal_subtotal').val()) || 0;
                    const descuento = parseFloat($('#modal_descuento').val()) || 0;
                    const total = subtotal - descuento;
                    $('#modal_total_final').val(total.toFixed(2));
                }

                // --- LÓGICA DE EDICIÓN INLINE CON CÁLCULO AUTOMÁTICO ---
$(document).on('click', '.btn-editar', function() {
    let row = $(this).closest('tr');
    let cobroVal = row.find('.col-cobro').data('value');
    
    // 1. Transformar Cobro EV en Select
    row.find('.col-cobro').html(`
        <select class="form-select form-select-sm edit-cobro">
            <option value="Pendiente" ${cobroVal == 'Pendiente' ? 'selected' : ''}>Pendiente</option>
            <option value="Cobrado" ${cobroVal == 'Cobrado' ? 'selected' : ''}>Cobrado</option>
        </select>
    `);

    row.find('.col-pago').html(`
        <select class="form-select form-select-sm edit-pago">
            <option value="Pendiente" ${cobroVal == 'Pendiente' ? 'selected' : ''}>Pendiente</option>
            <option value="Pagado" ${cobroVal == 'Pagado' ? 'selected' : ''}>Pagado</option>
        </select>
    `);

    // 2. Transformar Precio, Envio y Total en Inputs
    transformToInput(row, '.col-precio', 'edit-precio');
    transformToInput(row, '.col-envio', 'edit-envio');
    
    // El total lo ponemos como readonly porque se calcula solo
    let totalVal = row.find('.col-total-valor').data('valor');
    row.find('.col-total-valor').html(`<input type="number" step="0.01" class="form-control form-control-sm edit-total bg-light" value="${totalVal}" readonly>`);

    // 3. Alternar botones
    row.find('.btn-editar').addClass('d-none');
    row.find('.btn-guardar, .btn-cancelar').removeClass('d-none');
});

// FUNCIÓN DE CÁLCULO DINÁMICO
$(document).on('change input', '.edit-cobro, .edit-precio, .edit-envio', function() {
    let row = $(this).closest('tr');
    let cobro = row.find('.edit-cobro').val();
    let precio = parseFloat(row.find('.edit-precio').val()) || 0;
    let envio = parseFloat(row.find('.edit-envio').val()) || 0;
    let totalRemunerar = 0;

    if (cobro === 'Pendiente') {
        // Pendiente: Precio + Envío
        totalRemunerar = precio - envio;
    } else {
        // Cobrado: Solo Precio
        totalRemunerar = precio;
    }

    // Actualizar el valor en el input del total
    row.find('.edit-total').val(totalRemunerar.toFixed(2));
});

function transformToInput(row, selector, className) {
    let val = row.find(selector).data('value');
    row.find(selector).html(`<input type="number" step="0.01" class="form-control form-control-sm ${className}" value="${val}">`);
}

                $(document).on('click', '.btn-cancelar', function() {
                    location.reload();
                });

                $(document).on('click', '.btn-guardar', function() {
                    let row = $(this).closest('tr');
                    let datos = {
                        _token: "{{ csrf_token() }}",
                        id: row.data('id'),
                        cobro: row.find('.edit-cobro').val(),
                        precio: row.find('.edit-precio').val(),
                        envio: row.find('.edit-envio').val(),
                        total: row.find('.edit-total').val(),
                        pago: row.find('.edit-pago').val()
                    };

                    $.post("{{ route('pago.actualizar_orden_inline') }}", datos, function(res) {
                        if(res.success) {
                            Swal.fire('¡Éxito!', res.message, 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    });
                });
            });
        }
    };
</script>

@endsection

