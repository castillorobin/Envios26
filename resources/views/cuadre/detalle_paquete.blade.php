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
                <h4 class="mb-0">Listado de Guías: <span class="text-primary">{{ $estado }}s</span></h4>
                <p class="mb-0 text-muted">Unidad: {{ $unidad->nombre }}</p>
            </div>
        </div>
    </div>

    <div class="card">

     <div class="card-body">
    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
        <div>
            @if($estado === 'No entregado')
                <div class="d-flex gap-2 align-items-center">
                    <div class="search-bar">
                        <span><i class="bx bx-barcode-reader"></i></span>
                        <input type="text" class="form-control" id="input-comparar" 
                               placeholder="Escanear o ingresar guía para cuadre..." autofocus
                               style="width: 350px !important; border: 2px solid #3e60d5;">
                    </div>
                    <button type="button" id="btn-qr-comparar" class="btn btn-outline-primary">
                        <i class="bx bx-qr-scan fs-4"></i>
                    </button>
                    <span class="text-muted small ms-2"><i class="bx bx-info-circle"></i> Escanee los paquetes físicos que regresaron.</span>
                </div>
                
                <div id="reader-container" class="d-none mt-3 border rounded bg-light" style="max-width: 400px;">
                    <div id="reader" style="width: 100%;"></div>
                    <div class="p-2 text-center">
                        <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger">Cerrar Cámara</button>
                    </div>
                </div>
            @else
                <form class="d-flex flex-wrap align-items-center gap-2">
                    <div class="search-bar me-3">
                        <span><i class="bx bx-search-alt"></i></span>
                        <input type="search" class="form-control" id="search" placeholder="Buscar orden ...">
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-centered mb-0" id="tabla-detalle-guias">
                    <thead class="table-light">
                        <tr>
                            <th>Guía</th>  
                            
                            <th>Comercio</th>
                            <th>Destinatario</th>
                            <th>Destino</th> 
                            <th>Status</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guias as $guia)
                        <tr>
                            <td class="fw-medium text-primary">{{ $guia->guia }}</td>
                            
                            <td>{{ $guia->comercioRel ? $guia->comercioRel->nombre : '---' }}</td>
                            <td>{{ $guia->destinatario }}</td>
                            <td>{{ $guia->destino }}</td>
                            <td>
                            {{ $guia->estado}}
                            </td>
                            
                            <td>{{ number_format($guia->precio, 2) }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <button onclick="window.history.back()" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Regresar al Cuadre
                </button>
            </div>
        </div>
    </div>
</div>





           
<script>
$(document).ready(function() {
    console.log("¡Configurando interfaz de Comercios!");

    // 1. Destruir si existe para evitar conflictos
    if ($.fn.DataTable.isDataTable('#tabla-detalle-guias')) {
        $('#tabla-detalle-guias').DataTable().destroy();
    }

    // 2. Inicialización limpia
    var table = $('#tabla-detalle-guias').DataTable({
        "paging": true,
        "info": true,
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "order": [[ 0, "asc" ]],
        // Definimos donde aparecen los elementos: t=tabla, i=info, p=paginación
        "dom": 'rtip', 
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
            "paginate": {
                "previous": "<i class='bx bx-chevron-left'></i>",
                "next": "<i class='bx bx-chevron-right'></i>"
            }
        },
        "drawCallback": function(settings) {
            // Aplicar estilo Reback a la paginación
            $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
            
            // MOVER elementos a los contenedores fijos fuera del scroll
            // Usamos append() para asegurar que el movimiento sea reactivo
            var container = $(this.api().table().container());
            
            $('#dt-info-container').empty().append(container.find('.dataTables_info'));
            $('#dt-pagination-container').empty().append(container.find('.dataTables_paginate'));
        }
    });

    // 3. Vincular el buscador personalizado
    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });

    // 4. Lógica del Modal y Select2
    $('#modalCrearUsuarioComercio').on('shown.bs.modal', function () {
        setTimeout(function() {
            $('.select2-modal').select2({
                dropdownParent: $('#modalCrearUsuarioComercio'),
                width: '100%',
                placeholder: "Seleccione un comercio...",
                allowClear: true
            });
        }, 150);
    });

    // Capturar selección para llenar Email y Nombre
    $(document).on('select2:select', '#comercio_select', function (e) {
        var element = $(e.params.data.element);
        var email = element.attr('data-email');
        var nombre = element.attr('data-nombre');

        $('#comercio_email').val(email);
        $('#comercio_name_hidden').val(nombre);
        console.log("Datos cargados en formulario:", nombre, email);
    });

    // 5. Alertas SweetAlert2
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Aceptar',
            customClass: { confirmButton: 'btn btn-primary' }
        });
    @endif


    // --- LÓGICA ESPECÍFICA PARA NO ENTREGADOS ---
    const inputComparar = document.getElementById('input-comparar');
    const btnQr = document.getElementById('btn-qr-comparar');
    let html5QrCode;

    if (inputComparar) {
        // Función procesar escaneo
        const procesarCuadreFisico = (codigo) => {
            const guiaLimpia = codigo.trim();
            if (!guiaLimpia) return;

            let encontrado = false;
            
            // Buscar en todas las filas de la tabla
            table.rows().every(function (rowIdx, tableLoop, rowLoop) {
                const data = this.data();
                // data[0] contiene el texto de la columna Guía
                // Usamos un strip de HTML por si el ID tiene clases o enlaces
                const guiaTabla = data[0].replace(/<[^>]*>?/gm, '').trim();

                if (guiaTabla === guiaLimpia) {
                    encontrado = true;
                    // Eliminar la fila de la tabla
                    table.row(rowIdx).remove().draw();
                    
                    // Notificación rápida (Toast)
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Guía ' + guiaLimpia + ' cuadrada correctamente'
                    });
                }
            });

            if (!encontrado) {
                Swal.fire({
                    title: 'No encontrada',
                    text: 'La guía ' + guiaLimpia + ' no está en la lista de pendientes de esta unidad.',
                    icon: 'warning',
                    confirmButtonColor: '#3e60d5'
                });
            }

            inputComparar.value = '';
            inputComparar.focus();
        };

        // Evento al presionar Enter (Manual o Barcode Scanner)
        inputComparar.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                procesarCuadreFisico(this.value);
            }
        });

        // Lógica para QR
        if (btnQr) {
            btnQr.addEventListener('click', function() {
                const container = document.getElementById('reader-container');
                container.classList.remove('d-none');
                html5QrCode = new Html5Qrcode("reader");
                html5QrCode.start(
                    { facingMode: "environment" },
                    { fps: 15, qrbox: 250 },
                    (decodedText) => {
                        procesarCuadreFisico(decodedText);
                    }
                ).catch(err => console.error(err));
            });

            document.getElementById('btn-cerrar-camara').addEventListener('click', () => {
                if(html5QrCode) {
                    html5QrCode.stop().then(() => {
                        document.getElementById('reader-container').classList.add('d-none');
                    });
                }
            });
        }
    }

    // El buscador normal solo funciona si existe el input 'search'
    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });



});
</script>
@endsection