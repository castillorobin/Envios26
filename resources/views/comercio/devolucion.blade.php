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
                                <h4 class="mb-0 fw-semibold">Devolución Comercio</h4>
                                
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
                                            
                                            <button type="button" class="btn btn-success btn-lg">
                                                <i class="bx bx-save me-1"></i> Actualizar Devolución
                                            </button>
                                        </div>
                               
                                    </div>
                                </div>
                               
                            </div>
                            <!-- end card -->
                        </div>

                       
                    </div>
                </div>







<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputGuia = document.getElementById('input-guia');
        const btnAgregar = document.getElementById('btn-agregar');
        const btnActivarQr = document.getElementById('btn-activar-qr');
        const btnCerrarCamara = document.getElementById('btn-cerrar-camara');
        const readerContainer = document.getElementById('reader-container');
        
        let html5QrCode;

        // 1. Inicializar DataTable (Asegúrate que el ID coincida)
        var table = $('#tabla-asignacion').DataTable({
            "dom": 'tip',
            "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" },
            "drawCallback": function() {
                $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
                $('#dt-info-container').empty().append($(this.api().table().container()).find('.dataTables_info'));
                $('#dt-pagination-container').empty().append($(this.api().table().container()).find('.dataTables_paginate'));
            }
        });

        // 2. Función para agregar Guía a la lista
        async function agregarGuiaALista(codigo) {
            const guiaLimpia = codigo.trim();
            if (!guiaLimpia) return;

            // Verificar duplicados localmente en la tabla
            let duplicado = false;
            table.rows().every(function() {
                if (this.data()[0] === guiaLimpia) duplicado = true;
            });

            if (duplicado) {
                Swal.fire('¡Atención!', 'Esta guía ya fue agregada a la lista.', 'warning');
                inputGuia.value = '';
                return;
            }

            try {
                // Mostrar un pequeño indicador de carga si lo deseas
                const response = await fetch(`{{ route('ordenes.buscar_guia_ajax') }}?guia=${guiaLimpia}`);
                const res = await response.json();

                if (res.success) {
                    const d = res.data;
                    table.row.add([
                        d.guia,
                        d.comercio,
                        d.destinatario,
                        d.destino,
                        d.fecha_entrega || 'N/A',
                        `<span class="badge bg-soft-primary text-primary">${d.estado}</span>`,
                        `<div class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>`
                    ]).draw(false);

                    inputGuia.value = '';
                    inputGuia.focus();
                    
                    // Toast rápido de éxito
                    Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500
                    }).fire({ icon: 'success', title: 'Guía agregada' });

                } else {
                    Swal.fire('No encontrado', res.message || 'La guía no existe.', 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Hubo un problema al consultar el servidor.', 'error');
            }
        }

        // 3. Eventos de botones
        btnAgregar.addEventListener('click', function(e) {
            e.preventDefault();
            agregarGuiaALista(inputGuia.value);
        });

        inputGuia.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                agregarGuiaALista(this.value);
            }
        });

        // Eliminar fila
        $('#tabla-asignacion tbody').on('click', '.btn-eliminar', function () {
            table.row($(this).parents('tr')).remove().draw();
        });

        // 4. Lógica del Escáner QR
        btnActivarQr.addEventListener('click', function() {
            readerContainer.classList.remove('d-none');
            // Evitar múltiples instancias
            if (html5QrCode) {
                html5QrCode.stop().then(() => iniciarCamara());
            } else {
                iniciarCamara();
            }
        });

        function iniciarCamara() {
            html5QrCode = new Html5Qrcode("reader");
            const config = { fps: 15, qrbox: { width: 250, height: 250 } };
            
            html5QrCode.start(
                { facingMode: "environment" }, 
                config, 
                (text) => {
                    // Al detectar código
                    agregarGuiaALista(text);
                    // Opcional: detener cámara tras detectar uno
                    // detenerCamara(); 
                },
                (msg) => { /* Errores silenciosos de escaneo fallido por frame */ }
            ).catch(err => {
                Swal.fire('Error de Cámara', 'Asegúrate de dar permisos y usar HTTPS.', 'error');
            });
        }

        function detenerCamara() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    readerContainer.classList.add('d-none');
                }).catch(err => console.error("Error al detener cámara", err));
            }
        }

        btnCerrarCamara.addEventListener('click', detenerCamara);
    });
</script>

@endsection

