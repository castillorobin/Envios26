@extends('layouts.app')

@section('content')

<style>
    /* Mantenemos tus estilos de DataTables y botones redondeados */
    .dataTables_length select { padding: 5px 10px; border-radius: 5px; border: 1px solid #e1e3ea; }
    .dataTables_info, .dataTables_paginate { margin-top: 15px !important; }
    .dataTables_filter { display: none !important; }
    .pagination-rounded .page-item .page-link { border-radius: 50% !important; margin: 0 3px !important; border: none; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; color: #6c757d; }
    .pagination-rounded .page-item.active .page-link { background-color: #3e60d5 !important; color: white !important; box-shadow: 0 2px 6px 0 rgba(62, 96, 213, 0.5); }
    .pagination-rounded .page-item:first-child .page-link, .pagination-rounded .page-item:last-child .page-link { border-radius: 5px !important; width: auto !important; padding: 0 15px; }
    #dt-info-container, #dt-pagination-container { min-height: 40px; display: flex; align-items: center; }
</style>

<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Asignación de Ubicación (Cajas)</h4>
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
                                <input type="text" id="input-caja" class="form-control" style="max-width: 400px;" placeholder="Ingresar o Escanear Caja" autofocus>
                                <button type="button" id="btn-agregar" class="btn btn-primary">Agregar</button>
                                <button type="button" id="btn-activar-qr" class="btn btn-outline-secondary">
                                    <i class="bx bx-qr-scan fs-4"></i>
                                </button>
                            </div>
                            <div id="reader-container" class="d-none mt-3 border rounded bg-light" style="max-width: 400px;">
                                <div id="reader" style="width: 100%;"></div>
                                <div class="p-2 text-center">
                                    <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger">Cerrar Cámara</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content pt-0">
        <div class="tab-pane show active" role="tabpanel">
            <div class="card overflow-hidden">
                <div class="bg-light-subtle border-bottom p-2">
                    <label style="font-weight: bold; margin-bottom: 0;">
                        <i class="bx bx-map-pin me-1 text-primary"></i> Asignando ubicación a: <span class="text-primary">{{ $tipo }}</span>
                    </label>
                </div>
                <div class="table-responsive table-centered p-3">
                    <table class="table text-nowrap mb-0" id="tabla-asignacion">
                        <thead class="table-light">
                            <tr>
                                <th>Número de Caja</th>
                                <th>Fecha de Creación</th>
                                <th>Usuario</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div id="dt-info-container"></div>
                        <div id="dt-pagination-container"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3 p-3">
                    <a href="{{ route('cajas.buscar_ajax') }}" class="btn btn-secondary btn-lg me-2">
                        <i class="bx bx-x me-1"></i> Cancelar
                    </a>
                    <button type="button" id="btn-finalizar-asignacion" class="btn btn-success btn-lg">
                        <i class="bx bx-save me-1"></i> Guardar Ubicación
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUbicacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Especificar Ubicación de Cajas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-datos-ubicacion">
                    <div class="mb-3">
                        <label class="form-label">Rack</label>
                        <input type="text" id="rack" class="form-control" placeholder="Ej: 1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nivel</label>
                        <input type="text" id="nivel" class="form-control" placeholder="Ej: 2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ubicación</label>
                        <input type="text" id="gondola" class="form-control" placeholder="Ej: 5" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btn-confirmar-guardado" class="btn btn-success">Confirmar y Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputCaja = document.getElementById('input-caja');
        const btnAgregar = document.getElementById('btn-agregar');
        const btnActivarQr = document.getElementById('btn-activar-qr');
        const readerContainer = document.getElementById('reader-container');
        const modalUbicacion = new bootstrap.Modal(document.getElementById('modalUbicacion'));
        let html5QrCode;

        // 1. DataTable inicializado para Cajas
        var table = $('#tabla-asignacion').DataTable({
            "dom": 'tip',
            "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" },
            "drawCallback": function() {
                $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
                $('#dt-info-container').append($(this.api().table().container()).find('.dataTables_info'));
                $('#dt-pagination-container').append($(this.api().table().container()).find('.dataTables_paginate'));
            }
        });

        // 2. Función para buscar y agregar caja a la lista
        async function agregarCajaALista(numero) {
            const numLimpio = numero.trim();
            if (!numLimpio) return;

            // Verificar duplicados en la tabla
            let duplicado = false;
            table.rows().every(function() {
                if (this.data()[0] === numLimpio) duplicado = true;
            });

            if (duplicado) {
                Swal.fire('¡Atención!', 'Esta caja ya está en la lista.', 'warning');
                inputCaja.value = '';
                return;
            }

            try {
                // LLAMADA AJAX (Debes crear esta ruta y método que busque en el modelo Cajon)
                const response = await fetch(`{{ route('cajas.buscar_ajax') }}?numero=${numLimpio}`);
                const res = await response.json();

                if (res.success) {
                    table.row.add([
                        res.data.numero,
                        res.data.fecha,
                        res.data.usuario,
                        `<div class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>`
                    ]).draw(false);
                    inputCaja.value = '';
                    inputCaja.focus();
                } else {
                    Swal.fire('No encontrado', res.message, 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Problema al consultar la caja.', 'error');
            }
        }

        // Eventos de entrada
        btnAgregar.addEventListener('click', () => agregarCajaALista(inputCaja.value));
        inputCaja.addEventListener('keypress', (e) => { if(e.key === 'Enter') agregarCajaALista(inputCaja.value); });

        // Eliminar de la lista
        $('#tabla-asignacion tbody').on('click', '.btn-eliminar', function () {
            table.row($(this).parents('tr')).remove().draw();
        });

        // 3. Proceso de Guardado Final
        document.getElementById('btn-finalizar-asignacion').addEventListener('click', function() {
            if (table.rows().count() === 0) {
                Swal.fire('Lista vacía', 'Agregue al menos una caja.', 'info');
                return;
            }
            modalUbicacion.show();
        });

        document.getElementById('btn-confirmar-guardado').addEventListener('click', async function() {
    // 1. Capturar datos del modal
    const rack = document.getElementById('rack').value.trim();
    const nivel = document.getElementById('nivel').value.trim();
    const gondola = document.getElementById('gondola').value.trim();

    // 2. Validación simple
    if (!rack || !nivel || !gondola) {
        Swal.fire('Atención', 'Todos los campos de ubicación son obligatorios.', 'warning');
        return;
    }

    // 3. Obtener los números de cajas de la tabla DataTable
    let cajas = [];
    table.rows().every(function() {
        cajas.push(this.data()[0]); // El índice 0 es el "Número de Caja"
    });

    // 4. Enviar al servidor
    try {
        const response = await fetch("{{ route('cajas.confirmar_ubicacion') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                cajas: cajas,
                rack: rack,
                nivel: nivel,
                gondola: gondola
            })
        });

        const res = await response.json();

        if (res.success) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: res.message,
                confirmButtonColor: '#198754',
                confirmButtonText: 'Aceptar',
                customClass: { confirmButton: 'btn btn-success' },
                buttonsStyling: false
            }).then(() => {
                // Redirigir al inicio del proceso o limpiar
                window.location.href = "/ubicacion/buscar"; 
            });
        } else {
            Swal.fire('Error', res.message, 'error');
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
    }
});

        // QR Logic (Simplificada para brevedad)
        btnActivarQr.addEventListener('click', function() {
            readerContainer.classList.remove('d-none');
            html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start({ facingMode: "environment" }, { fps: 15, qrbox: 250 }, (text) => {
                agregarCajaALista(text);
            });
        });
        document.getElementById('btn-cerrar-camara').addEventListener('click', () => {
            if(html5QrCode) html5QrCode.stop().then(() => readerContainer.classList.add('d-none'));
        });
    });
</script>
@endsection