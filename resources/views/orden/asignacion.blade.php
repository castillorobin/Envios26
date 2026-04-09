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
                                <h4 class="mb-0 fw-semibold">Asignación de caja</h4>
                                
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
        // --- REFERENCIAS DE ELEMENTOS ---
        const inputGuia = document.getElementById('input-guia');
        const btnAgregar = document.getElementById('btn-agregar');
        const btnActivarQr = document.getElementById('btn-activar-qr');
        const btnCerrarCamara = document.getElementById('btn-cerrar-camara');
        const readerContainer = document.getElementById('reader-container');
        
        // --- VARIABLES DE CONTROL ---
        let html5QrCode;
        let isProcessing = false;    // Evita múltiples peticiones simultáneas
        let lastScannedCode = null;  // Evita leer el mismo código repetidamente

        // 1. Inicializar DataTable
        var table = $('#tabla-asignacion').DataTable({
            "dom": 'tip',
            "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" },
            "drawCallback": function() {
                $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
                // Limpiar y re-adjuntar contenedores de info/paginación
                $('#dt-info-container').empty().append($(this.api().table().container()).find('.dataTables_info'));
                $('#dt-pagination-container').empty().append($(this.api().table().container()).find('.dataTables_paginate'));
            }
        });

        // 2. Función Principal para agregar a la lista (Manual y QR)
        async function agregarGuiaALista(codigo) {
            const guiaLimpia = codigo.trim();
            
            // Validaciones básicas de entrada y estado
            if (!guiaLimpia || isProcessing) return;

            // Bloqueamos procesamiento
            isProcessing = true;

            // Verificar si ya está en la tabla localmente
            let duplicado = false;
            table.rows().every(function() {
                if (this.data()[0] === guiaLimpia) duplicado = true;
            });

            if (duplicado) {
                // Solo mostrar alerta si no es un re-escaneo accidental del QR
                if (lastScannedCode !== guiaLimpia) {
                    Swal.fire('¡Atención!', 'Esta guía ya fue agregada a la lista actual.', 'warning');
                }
                inputGuia.value = '';
                isProcessing = false; // Liberamos para que el usuario intente otra
                return;
            }

            // Guardamos el código actual para evitar spam del QR
            lastScannedCode = guiaLimpia;

            try {
                // Consultar al servidor
                const response = await fetch(`{{ route('ordenes.buscar_guia_ajax') }}?guia=${encodeURIComponent(guiaLimpia)}`);
                const res = await response.json();

                if (res.success) {
                    const d = res.data;
                    
                    // Agregamos la fila a la tabla
                    table.row.add([
                        d.guia,
                        d.comercio,
                        d.destinatario,
                        d.destino,
                        d.fecha_entrega || 'N/A',
                        `<span class="badge bg-soft-primary text-primary">${d.estado}</span>`,
                        `<div class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar" title="Quitar">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>`
                    ]).draw(false);

                    inputGuia.value = '';
                    inputGuia.focus();
                    
                    // Vibración de confirmación en móviles
                    if (navigator.vibrate) navigator.vibrate(100);

                } else {
                    Swal.fire('Error', res.message, 'error');
                    inputGuia.value = '';
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Hubo un problema de conexión.', 'error');
            } finally {
                // Delay de 1.2 segundos antes de permitir el siguiente escaneo
                // Esto da tiempo al operario de mover el celular al siguiente paquete
                setTimeout(() => {
                    isProcessing = false;
                }, 1200);
            }
        }

        // 3. Eventos de Interfaz
        btnAgregar.addEventListener('click', () => agregarGuiaALista(inputGuia.value));

        inputGuia.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                agregarGuiaALista(this.value);
            }
        });

        // Eliminar fila de la tabla
        $('#tabla-asignacion tbody').on('click', '.btn-eliminar', function () {
            const row = table.row($(this).parents('tr'));
            row.remove().draw();
        });

        // 4. Lógica del Escáner QR
        btnActivarQr.addEventListener('click', function() {
            readerContainer.classList.remove('d-none');
            lastScannedCode = null; // Resetear historial de escaneo al abrir
            
            html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start(
                { facingMode: "environment" },
                { 
                    fps: 10,    // Velocidad moderada para estabilidad
                    qrbox: 250 
                },
                (decodedText) => {
                    // Solo disparamos si no estamos procesando y el código es distinto al anterior
                    if (!isProcessing && decodedText !== lastScannedCode) {
                        agregarGuiaALista(decodedText);
                    }
                }
            ).catch(err => {
                console.error(err);
                Swal.fire('Cámara', 'No se pudo acceder a la cámara. Verifique permisos.', 'error');
            });
        });

        btnCerrarCamara.addEventListener('click', function() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                    readerContainer.classList.add('d-none');
                });
            } else {
                readerContainer.classList.add('d-none');
            }
        });

        // 5. Envío Final de Datos (Guardar Asignación)
        const btnFinalizar = document.getElementById('btn-finalizar-asignacion');
        
        btnFinalizar.addEventListener('click', function() {
            let guias = [];
            table.rows().every(function() {
                guias.push(this.data()[0]);
            });

            if (guias.length === 0) {
                Swal.fire('Atención', 'La lista de guías está vacía.', 'info');
                return;
            }

            Swal.fire({
                title: '¿Confirmar guardado?',
                text: `Se procesarán ${guias.length} guías.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    enviarDatosAlServidor(guias);
                }
            });
        });

        async function enviarDatosAlServidor(guias) {
            Swal.fire({ title: 'Guardando...', didOpen: () => { Swal.showLoading(); } });

            try {
                const response = await fetch("{{ route('ordenes.confirmar_asignacion') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        guias: guias,
                        tipo: "{{ $tipo }}",
                        caja: "{{ $caja }}"
                    })
                });

                const res = await response.json();

                if (res.success) {
                    Swal.fire('¡Éxito!', res.message, 'success').then(() => {
                        window.location.href = "{{ route('ordenes.asignar_mercancia') }}";
                    });
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
            }
        }
    });
</script>

@endsection

