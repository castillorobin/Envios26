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
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Asignación de mercancía</h4>
                                
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
                                            <div class="d-flex gap-2">
                                                <input type="text" id="input-guia" class="form-control" style="max-width: 400px;" placeholder="Ingresar guía" autofocus>
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
                                        @if($tipo === 'Caja')
                                            <i class="bx bx-package me-1 text-primary"></i> Procesando Caja # <span class="text-primary">{{ $caja }}</span>
                                        @else
                                            <i class="bx bx-loader-alt me-1 text-info"></i> Procesando mercancía en suelto
                                        @endif
                                    </label>
                                </div>
                                <div class="table-responsive table-centered p-3">
                                    <table class="table text-nowrap mb-0" id="tabla-asignacion">
                                        <thead class="teble-light">
                                            <tr>
                                                <td>Guia</td>
                                                <th>Comercio</th>
                                                
                                                <th>Destinatario</th>
                                                <th>Destino</th>
                                                <th>Fecha de entrega</th>
                                                <th>Status</th>
                                                <th class="text-center">Acción</th>
                                                
                                            </tr>
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>

                                           
                                            
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
          
                                        <div class="d-flex justify-content-end mt-3 p-3">
                                            <a href="/ordenes/asignar-mercancia">
                                             <button type="button" id="btn-cancelar-asignacion" class="btn btn-secondary btn-lg" style="margin-right: 10px;">
                                                 <i class="bx bx-x me-1"></i> Cancelar
                                          
                                            </button>
                                            </a>
                                            <button type="button" id="btn-finalizar-asignacion" class="btn btn-success btn-lg">
                                                <i class="bx bx-save me-1"></i> Guardar
                                            </button>
                                        </div>
                               
                                    </div>
                                </div>
                               
                            </div>
                            <!-- end card -->
                        </div>

                       
                    </div>
                </div>







                <div class="modal fade" id="modalSuelto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de Ubicación (Suelto)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-datos-suelto">
                    <div class="mb-3">
                        <label class="form-label">Rack</label>
                        <input type="text" id="rack" class="form-control" placeholder="Ej: A1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nivel</label>
                        <input type="text" id="nivel" class="form-control" placeholder="Ej: 2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Góndola</label>
                        <input type="text" id="gondola" class="form-control" placeholder="Ej: 5" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btn-confirmar-suelto" class="btn btn-primary">Confirmar y Guardar</button>
            </div>
        </div>
    </div>
</div>


<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputGuia = document.getElementById('input-guia');
        const btnAgregar = document.getElementById('btn-agregar');
        const btnActivarQr = document.getElementById('btn-activar-qr');
        const readerContainer = document.getElementById('reader-container');
        let html5QrCode;



        // 1. Inicializar DataTable
        var table = $('#tabla-asignacion').DataTable({
            "dom": 'tip',
            "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" },
            "drawCallback": function() {
                $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
                $('#dt-info-container').append($(this.api().table().container()).find('.dataTables_info'));
                $('#dt-pagination-container').append($(this.api().table().container()).find('.dataTables_paginate'));
            }
        });

        // 2. Función principal para agregar a la lista
        async function agregarGuiaALista(codigo) {
            const guiaLimpia = codigo.trim();
            if (!guiaLimpia) return;

            // Verificar si ya está en la tabla (lado del cliente)
            let duplicado = false;
            table.rows().every(function() {
                if (this.data()[0] === guiaLimpia) duplicado = true;
            });

            if (duplicado) {
                Swal.fire('¡Atención!', 'Esta guía ya fue agregada a la lista actual.', 'warning');
                inputGuia.value = '';
                return;
            }

            try {
                // Consultar al servidor
                const response = await fetch(`{{ route('ordenes.buscar_guia_ajax') }}?guia=${guiaLimpia}`);
                const res = await response.json();

                if (res.success) {
                    const d = res.data;
                    
                    // Agregamos la fila incluyendo el botón de eliminar al final
                    table.row.add([
                        d.guia,
                        d.comercio,
                        d.destinatario,
                        d.destino,
                        d.fecha_entrega,
                        `<span class="badge bg-soft-primary text-primary">${d.estado}</span>`,
                        `<div class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar" title="Quitar de la lista">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>`
                    ]).draw(false);

                    inputGuia.value = '';
                    inputGuia.focus();
                }
                else {
                    Swal.fire('Error', res.message, 'error');
                    inputGuia.value = '';
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Hubo un problema al consultar la guía.', 'error');
            }
        }

        // 3. Eventos de Entrada
        btnAgregar.addEventListener('click', () => agregarGuiaALista(inputGuia.value));

        inputGuia.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                agregarGuiaALista(this.value);
            }
        });

        // 4. Lógica QR
        btnActivarQr.addEventListener('click', function() {
            readerContainer.classList.remove('d-none');
            html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start(
                { facingMode: "environment" },
                { fps: 15, qrbox: 250 },
                (decodedText) => {
                    agregarGuiaALista(decodedText);
                    // Opcional: No cerrar la cámara para seguir escaneando rápido
                }
            ).catch(err => Swal.fire('Error', 'No se pudo acceder a la cámara', 'error'));
        });

        document.getElementById('btn-cerrar-camara').addEventListener('click', function() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                    readerContainer.classList.add('d-none');
                });
            }
        });

        // Evento para eliminar fila de la tabla
$('#tabla-asignacion tbody').on('click', '.btn-eliminar', function () {
    const row = table.row($(this).parents('tr'));
    
    Swal.fire({
        title: '¿Quitar guía?',
        text: "La guía será eliminada de esta lista de asignación.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3e60d5',
        cancelButtonColor: '#f1536e',
        confirmButtonText: 'Sí, quitar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            row.remove().draw(); // Elimina la fila de DataTables
            Swal.fire({
                title: 'Eliminado',
                text: 'La guía ha sido removida.',
                icon: 'success',
                timer: 1000,
                showConfirmButton: false
            });
        }
    });
});




// Referencias a elementos
const btnFinalizar = document.getElementById('btn-finalizar-asignacion');
const modalSuelto = new bootstrap.Modal(document.getElementById('modalSuelto'));
const btnConfirmarSuelto = document.getElementById('btn-confirmar-suelto');

// Función para enviar los datos al servidor
async function enviarAsignacion(datosExtra = {}) {
    // 1. Obtener todas las guías actuales de la tabla
    let guias = [];
    table.rows().every(function() {
        guias.push(this.data()[0]); // El índice 0 es el código de guía
    });

    if (guias.length === 0) {
        Swal.fire('Error', 'La lista de guías está vacía.', 'error');
        return;
    }

    // 2. Preparar el paquete de datos
    const payload = {
        guias: guias,
        tipo: "{{ $tipo }}",
        caja: "{{ $caja }}",
        ...datosExtra // rack, nivel, gondola si vienen
    };

    try {
        const response = await fetch("{{ route('ordenes.confirmar_asignacion') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify(payload)
        });

        const res = await response.json();

        // Dentro de enviarAsignacion()
if (res.success) {
    Swal.fire({
        icon: 'success',
        title: '¡Proceso Completado!',
        text: res.message,
        confirmButtonColor: '#198754', // Color btn-success
        confirmButtonText: 'Aceptar',
        customClass: {
            confirmButton: 'btn btn-success'
        },
        buttonsStyling: false
    }).then(() => {
        window.location.href = "{{ route('ordenes.asignar_mercancia') }}";
    });
} else {
            Swal.fire('Error', res.message, 'error');
        }
    } catch (error) {
        Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
    }
}

// Evento principal del botón Guardar
btnFinalizar.addEventListener('click', function() {
    const tipo = "{{ $tipo }}";

    if (tipo === 'Caja') {
        Swal.fire({
            title: '¿Confirmar asignación?',
            text: `Se asignarán ${table.rows().count()} guías a la caja #{{ $caja }}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754', // Color btn-success de Bootstrap 5
            cancelButtonColor: '#6c757d',  // Color btn-secondary
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false // Permite que las clases de Bootstrap tengan prioridad
        }).then((result) => {
            if (result.isConfirmed) enviarAsignacion();
        });
    } else {
        modalSuelto.show();
    }
});

// Evento dentro del modal para Suelto
btnConfirmarSuelto.addEventListener('click', function() {
    const rack = document.getElementById('rack').value.trim();
    const nivel = document.getElementById('nivel').value.trim();
    const gondola = document.getElementById('gondola').value.trim();

    if (!rack || !nivel || !gondola) {
        Swal.fire('Campos requeridos', 'Por favor complete todos los datos de ubicación.', 'warning');
        return;
    }

    modalSuelto.hide();
    enviarAsignacion({ rack, nivel, gondola });
});






    });
</script>

@endsection

