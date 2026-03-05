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
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <input type="text" id="input-guia" class="form-control" style="max-width: 300px;" placeholder="Ingresar guía" autofocus>
                                <button type="button" id="btn-agregar" class="btn btn-primary">Agregar</button>
                                <button type="button" id="btn-activar-qr" class="btn btn-outline-secondary">
                                    <i class="bx bx-qr-scan fs-4"></i>
                                </button>
                            </div>
                                <div id="reader-container" class="d-none mt-3 border rounded bg-light" style="max-width: 400px;">
                                    <div id="reader" style="width: 100%;"></div>
                                    <div class="p-2 text-center">
                                        <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger">
                                            Cerrar Cámara
                                        </button>
                                    </div>
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
            <form action="{{ route('recepcion.guardar') }}" method="POST" target="_blank" onsubmit="setTimeout(() => { window.location.href = '{{ route('recepcion.elegircomercio') }}'; }, 1000);">
                @csrf
                <input type="hidden" name="comercio_id" value="{{ $comercio->id }}">
                <div id="hidden-inputs"></div>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                                        <label for="usuari" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario" value="{{ Auth::user()->name }}" readonly>
                                    </div>
<input type="hidden" name="comercio_nombre" value="{{ $comercio->nombre }}">
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
                               <a href="{{ route('recepcion.elegircomercio') }}" class="btn btn-outline-primary w-100">
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

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("Interfaz de Recepción cargada con éxito...");

    // 1. Variables de Control
    let contadorOrden = 0;
    const btnAgregar = document.getElementById('btn-agregar');
    const inputGuia = document.getElementById('input-guia');
    const hiddenInputsContainer = document.getElementById('hidden-inputs');
    const nombreComercio = "{{ $comercio->nombre }}";
    const fechaHoy = "{{ date('d/m/Y') }}";

    // Elementos del Escáner QR
    const btnActivarQr = document.getElementById('btn-activar-qr');
    const btnCerrarCamara = document.getElementById('btn-cerrar-camara');
    const readerContainer = document.getElementById('reader-container');
    let html5QrCode;

    // 2. Inicialización de DataTable
    const tableGuias = $('#tabla-guias-dinamica').DataTable({
        "paging": true,
        "pageLength": 5,
        "lengthChange": false,
        "searching": false,
        "info": true,
        "order": [[0, "desc"]],
        "dom": 'rtip',
        "columnDefs": [{ "targets": [0], "visible": false }],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
            "paginate": {
                "previous": "<i class='bx bx-chevron-left'></i>",
                "next": "<i class='bx bx-chevron-right'></i>"
            }
        },
        "drawCallback": function(settings) {
            // 1. Aplicar estilo a los botones
            $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');

            // 2. Capturar los elementos
            var api = this.api();
            var container = $(api.table().container());
            
            var info = container.find('.dataTables_info');
            var paginate = container.find('.dataTables_paginate');

            // 3. MOVER AL FOOTER (Usamos append para asegurar el trasplante del nodo)
            $('#dt-info-container').append(info);
            $('#dt-pagination-container').append(paginate);

            // 4. FORZAR VISIBILIDAD
            // Si hay datos, mostramos la info. Si hay más de una página, mostramos paginación.
            if (api.rows().count() > 0) {
                info.attr('style', 'display: block !important'); // Forzamos con CSS inline
                if (api.page.info().pages > 1) {
                    paginate.attr('style', 'display: block !important');
                } else {
                    paginate.attr('style', 'display: none !important');
                }
            } else {
                info.hide();
                paginate.hide();
            }
        }
    });

    async function agregarGuia() {
    const guiaValue = inputGuia.value.trim();

    // Validaciones básicas de cliente
    if (guiaValue === "") {
        Swal.fire({ icon: 'warning', title: 'Campo vacío', text: 'Ingrese o escanee una guía' });
        return;
    }

    // Validación 1: ¿Ya está en la lista actual (memoria local)?
    if (document.getElementById(`input-hidden-${guiaValue}`)) {
        Swal.fire({ icon: 'error', title: 'Duplicada', text: `La guía ${guiaValue} ya está en la lista temporal.` });
        inputGuia.value = "";
        return;
    }

    // Validación 2: ¿Ya existe en la Base de Datos?
    try {
        // Bloqueamos el input y botón brevemente
        btnAgregar.disabled = true;
        inputGuia.disabled = true;

        const response = await fetch("{{ route('recepcion.verificar_guia') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ guia: guiaValue })
        });

        const data = await response.json();

        if (data.existe) {
            Swal.fire({ 
                icon: 'error', 
                title: 'Ya registrada', 
                text: `La guía ${guiaValue} ya existe en el sistema (ya fue recepcionada anteriormente).` 
            });
            inputGuia.value = "";
            inputGuia.focus();
            return;
        }

        // Si pasa ambas validaciones, agregar a la tabla
        contadorOrden++;

        tableGuias.row.add([
            contadorOrden,
            `<strong>${guiaValue}</strong>`,
            nombreComercio,
            fechaHoy,
            `<span class="badge bg-success-subtle text-success">Recepcionado</span>`,
            `<button type="button" class="btn btn-sm btn-danger btn-eliminar" data-guia="${guiaValue}"><i class="bx bx-trash"></i></button>`
        ]).draw(false);

        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'guias[]';
        hiddenInput.value = guiaValue;
        hiddenInput.id = `input-hidden-${guiaValue}`;
        hiddenInputsContainer.appendChild(hiddenInput);

        inputGuia.value = "";
        inputGuia.focus();

    } catch (error) {
        console.error("Error al verificar la guía:", error);
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo verificar la guía con el servidor.' });
    } finally {
        // Desbloqueamos los controles
        btnAgregar.disabled = false;
        inputGuia.disabled = false;
        inputGuia.focus();
    }
}

    // 4. Lógica del Escáner QR (Cierre automático)
    btnActivarQr.addEventListener('click', function() {
        readerContainer.classList.remove('d-none');
        btnActivarQr.disabled = true;
        html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 15, qrbox: { width: 250, height: 250 } };

        html5QrCode.start(
            { facingMode: "environment" }, 
            config,
            (decodedText) => {
                inputGuia.value = decodedText;
                agregarGuia();
                cerrarScanner();
            }
        ).catch(err => {
            console.error("Error cámara:", err);
            cerrarScanner();
        });
    });

    function cerrarScanner() {
        if (html5QrCode && html5QrCode.isScanning) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                readerContainer.classList.add('d-none');
                btnActivarQr.disabled = false;
            });
        } else {
            readerContainer.classList.add('d-none');
            btnActivarQr.disabled = false;
        }
    }

    btnCerrarCamara.addEventListener('click', cerrarScanner);

    // 5. Lógica de Cálculos
    const inputSubtotal = document.getElementById('subtotal');
    const inputDescuento = document.getElementById('descuento');
    const inputTotal = document.getElementById('total');

    function calcularTotal() {
        const sub = parseFloat(inputSubtotal.value) || 0;
        const desc = parseFloat(inputDescuento.value) || 0;
        const resultado = sub - desc;
        inputTotal.value = Math.max(0, resultado).toFixed(2);
    }

    inputSubtotal.addEventListener('input', calcularTotal);
    inputDescuento.addEventListener('input', calcularTotal);

    // 6. Eventos de Usuario
    btnAgregar.addEventListener('click', agregarGuia);
    
    inputGuia.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            agregarGuia();
        }
    });

    $('#tabla-guias-body').on('click', '.btn-eliminar', function() {
        const row = $(this).closest('tr');
        const guiaABorrar = $(this).data('guia');
        tableGuias.row(row).remove().draw();
        $(`#input-hidden-${guiaABorrar}`).remove();
    });
});
</script>

@endsection

