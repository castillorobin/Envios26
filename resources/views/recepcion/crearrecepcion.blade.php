@extends('layouts.app')

@section('content')
<style>
    /* Asegurar visibilidad en los contenedores del footer */
    #dt-info-container, #dt-pagination-container {
        min-height: 40px;
        display: flex;
        align-items: center;
    }

    /* Forzar que los controles de DataTables sean visibles siempre que se muevan aquí */
    #dt-pagination-container .dataTables_paginate,
    #dt-info-container .dataTables_info {
        display: block !important;
    }

    /* Ocultar los controles originales que quedan dentro del wrapper de la tabla */
    .dataTables_wrapper .dataTables_info, 
    .dataTables_wrapper .dataTables_paginate {
        display: none;
    }
</style>
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Recepción de paquetes de: <strong>{{ $comercio->nombre }}</strong></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <input type="text" id="input-guia" class="form-control" style="max-width: 300px;" placeholder="Ingresar guía" autofocus>
                                <button type="button" id="btn-agregar" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-centered mt-3">
                        <table class="table text-nowrap mb-0" id="tabla-guias-dinamica">
                            <thead>
                                <tr>
                                    <th style="display: none;">Orden</th> <th style="width: 35%;">Guia</th>
                                    <th>Comercio</th>
                                    <th>Fecha de recepcion</th>
                                    <th>Status</th>
                                    <th style="width: 50px;">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-guias-body">
                                </tbody>
                        </table>
                    </div>
                </div><div class="card-footer bg-transparent border-top">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div id="dt-info-container"></div>
                <div id="dt-pagination-container"></div>
            </div>
        </div>
            </div>
        </div>

        <div class="col-xl-3">
            <form action="{{ route('recepcion.guardar') }}" method="POST">
                @csrf
                <input type="hidden" name="comercio_id" value="{{ $comercio->id }}">
                <div id="hidden-inputs"></div>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                                        <label for="usuari" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario" value="{{ Auth::user()->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtotal" class="form-label">Subtotal</label>
                                        <input type="number" class="form-control" id="subtotal" name="subtotal" placeholder="$ 0.00">
                                    </div>

                                    <div class="mb-3">
                                        <label for="descuento" class="form-label">Descuento</label>
                                        <input type="number" class="form-control" id="descuento" name="descuento" placeholder="$ 0.00">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="nota" class="form-label">Nota</label>
                                        <input type="text" class="form-control" id="nota" name="nota" placeholder="Ingrese una nota de descuento">
                                    </div>
                                    <div class="mb-3">
                                        <label for="metodo_pago" class="form-label">Metodo de pago</label>
                                        <select name="metodo_pago" id="metodo_pago" class="form-select">
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Transferencia bancaria">Transferencia bancaria</option>
                                            
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center gap-3 mb-3">
                                        <label for="total" class="form-label mb-0">Total a cobrar</label>
                                        <input type="number" class="form-control" id="total" name="total" placeholder="$ 0.00" style="max-width: 100px;" readonly>
                                    </div>
                        <div class="row">
                            <div class="col-6">
                               <a href="{{ route('recepcion.crearrecepcion', ['comercio_id' => $comercio->id]) }}" class="btn btn-outline-primary w-100">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let contadorOrden = 0;
    const btnAgregar = document.getElementById('btn-agregar');
    const inputGuia = document.getElementById('input-guia');
    const hiddenInputsContainer = document.getElementById('hidden-inputs');
    const nombreComercio = "{{ $comercio->nombre }}";
    const fechaHoy = "{{ date('d/m/Y') }}";

    // Inicialización de DataTable
    const tableGuias = $('#tabla-guias-dinamica').DataTable({
    "paging": true,
    "pageLength": 5,
    "lengthChange": false,
    "searching": false,
    "info": true,
    "order": [[0, "desc"]], // Ordena por la columna 'Orden' aunque esté oculta
    "dom": 'rtip',
    "columnDefs": [
        {
            "targets": [0],      // La columna 'Orden' (índice 0)
            "visible": false,    // La oculta completamente del ojo humano
            "searchable": false  // No se busca por este campo
        }
    ],
    "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
        "paginate": {
            "previous": "<i class='bx bx-chevron-left'></i>",
            "next": "<i class='bx bx-chevron-right'></i>"
        }
    },
    "drawCallback": function(settings) {
            // 1. Estilo de los botones
            $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');

            // 2. Mover los controles al footer de forma segura
            // Usamos append() sobre los contenedores para "jalar" el HTML
            const nodes = $(this.api().table().container());
            
            const info = nodes.find('.dataTables_info');
            const paginate = nodes.find('.dataTables_paginate');

            $('#dt-info-container').append(info);
            $('#dt-pagination-container').append(paginate);
            
            // 3. Forzar visibilidad si hay más de una página o si queremos ver el info
            if (this.api().rows().count() > 0) {
                info.show();
                // Solo mostrar paginación si hay más de 1 página
                if (this.api().page.info().pages > 1) {
                    paginate.show();
                } else {
                    paginate.hide();
                }
            }
        }
    });

    // Función para agregar guía
    function agregarGuia() {
        const guiaValue = inputGuia.value.trim();
        if (guiaValue === "") return;

        // Verificar duplicados en los inputs ocultos
        if (document.getElementById(`input-hidden-${guiaValue}`)) {
            Swal.fire({ icon: 'error', title: 'Duplicada', text: `La guía ${guiaValue} ya está en la lista.` });
            inputGuia.value = "";
            return;
        }

        contadorOrden++;

        // Añadir a la tabla
        tableGuias.row.add([
            contadorOrden,
            `<strong>${guiaValue}</strong>`,
            nombreComercio,
            fechaHoy,
            `<span class="badge bg-success-subtle text-success">Recepcionado</span>`,
            `<button type="button" class="btn btn-sm btn-danger btn-eliminar" data-guia="${guiaValue}">
                <i class="bx bx-trash"></i>
            </button>`
        ]).draw(false);

        // Crear input oculto
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'guias[]';
        hiddenInput.value = guiaValue;
        hiddenInput.id = `input-hidden-${guiaValue}`;
        hiddenInputsContainer.appendChild(hiddenInput);

        inputGuia.value = "";
        inputGuia.focus();
    }

    // Eventos
    btnAgregar.addEventListener('click', agregarGuia);
    inputGuia.addEventListener('keypress', (e) => { if (e.key === 'Enter') { e.preventDefault(); agregarGuia(); } });

    // Eliminar registro
    $('#tabla-guias-body').on('click', '.btn-eliminar', function() {
        const row = $(this).closest('tr');
        const guia = $(this).data('guia');
        tableGuias.row(row).remove().draw();
        $(`#input-hidden-${guia}`).remove();
    });


    // --- LÓGICA DE CÁLCULOS ---
const inputSubtotal = document.getElementById('subtotal');
const inputDescuento = document.getElementById('descuento');
const inputTotal = document.getElementById('total');

function calcularTotal() {
    // Obtenemos los valores y los convertimos a número (si están vacíos, usamos 0)
    const sub = parseFloat(inputSubtotal.value) || 0;
    const desc = parseFloat(inputDescuento.value) || 0;
    
    // Calculamos la resta
    const resultado = sub - desc;
    
    // Mostramos el resultado con 2 decimales en el campo Total
    inputTotal.value = resultado.toFixed(2);
}

// Escuchamos cuando el usuario escribe en cualquiera de los dos campos
inputSubtotal.addEventListener('input', calcularTotal);
inputDescuento.addEventListener('input', calcularTotal);
});
</script>

@endsection

