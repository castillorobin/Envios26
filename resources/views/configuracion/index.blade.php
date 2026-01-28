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


<style>
    /* Asegurar que la tabla ocupe todo el ancho y sea flexible */
    #tabla-usuarios {
        width: 100% !important;
        table-layout: auto; /* Permite que el navegador ajuste si es necesario */
    }

    /* Opcional: Si el nombre del punto es MUY largo, truncarlo con puntos suspensivos */
    .punto-nombre {
        max-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="container-xxl">
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Listado de puntos</h4>
                                
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
                                                <label for="inputPassword2" class="visually-hidden">Buscar Punto</label>
                                                <div class="search-bar me-3">
                                                    <span><i class="bx bx-search-alt"></i></span>
                                                    <input type="search" class="form-control" id="search" placeholder="Buscar Punto ...">
                                                </div>

                                                
                                            </form>
                                        </div>
                                        <div>
                                           <div class="d-flex flex-wrap gap-2 justify-content-md-end align-items-center">
    
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalAgregarPunto">
                                                <i class="bi bi-plus-circle me-1"></i> Agregar Punto
                                            </button>
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
                                    <table class="table text-nowrap mb-0" id="tabla-usuarios">
                                        <thead class="teble-light">
                                            <tr>
                                                <th style="width: 5%;">ID</th>
                                                <th style="width: 60%;">Punto</th>             
                                                <th style="width: 20%;">Tipo</th>
                                                <th style="width: 15%;" class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>

                                            @foreach ($puntos as $punto)
                                            <tr>
                                                <td>{{ $punto->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-1">
                                                        
                                                        {{ $punto->nombre }}</a>
                                                    </div>
                                                </td>

                                                <td>  
                                                    <h5><span class="badge text-bg-dark">{{ $punto->tipo }}</span></h5>
                                                </td>
                                              
                                              <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-soft-secondary me-1 btn-editar" 
                                                        data-id="{{ $punto->id }}" 
                                                        data-nombre="{{ $punto->nombre }}" 
                                                        data-tipo="{{ $punto->tipo }}"
                                                        data-bs-toggle="modal" data-bs-target="#modalEditarPunto">
                                                    <i class="bx bx-edit fs-18"></i>
                                                </button>

                                                <form action="{{ route('puntos.destroy', $punto->id) }}" method="POST" class="d-inline form-eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-soft-danger btn-borrar">
                                                        <i class="bx bx-trash fs-18"></i>
                                                    </button>
                                                </form>
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




                <div class="modal fade" id="modalAgregarPunto" tabindex="-1" aria-labelledby="modalPuntoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="modalPuntoLabel">Nuevo Punto / Agencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('puntos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select" required>
                            <option value="Punto fijo">Punto fijo</option>
                            <option value="Agencia">Agencia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Punto</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="modalEditarPunto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Editar Punto / Agencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" id="formEditarPunto">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" id="edit_tipo" class="form-select" required>
                            <option value="Punto fijo">Punto</option>
                            <option value="Agencia">Agencia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#modalAgregarPunto').on('hidden.bs.modal', function () {
    $(this).find('form')[0].reset();
});
</script>

<script>
$(document).ready(function() {
    console.log("¡Configurando interfaz de Puntos!");

    // 1. Destruir instancia previa si existe
    if ($.fn.DataTable.isDataTable('#tabla-usuarios')) {
        $('#tabla-usuarios').DataTable().destroy();
    }

    // 2. Inicializar DataTable
    var table = $('#tabla-usuarios').DataTable({
        "paging": true,
        "info": true,
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "order": [[ 0, "asc" ]],
        "dom": 'rtip', 
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
            // Limpiamos los contenedores antes de inyectar para evitar duplicados
            $('#dt-info-container').empty().append(container.find('.dataTables_info'));
            $('#dt-pagination-container').empty().append(container.find('.dataTables_paginate'));
        }
    });

    // 3. Vincular el buscador personalizado
    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });

    // 4. Lógica para EDITAR (Llenar el modal)
    // Usamos delegación de eventos $(document).on para que funcione con la paginación
    $(document).on('click', '.btn-editar', function() {
        const id = $(this).data('id');
        const nombre = $(this).data('nombre');
        const tipo = $(this).data('tipo');

        console.log("Cargando datos para editar:", nombre);

        // Actualizar el action del formulario y los campos
        $('#formEditarPunto').attr('action', '/puntos/' + id);
        $('#edit_nombre').val(nombre);
        $('#edit_tipo').val(tipo);
    });

    // 5. Lógica para ELIMINAR (SweetAlert2)
    $(document).on('click', '.btn-borrar', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará el punto de forma permanente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3e60d5',
            cancelButtonColor: '#f1556c',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // 6. Alertas SweetAlert2 de Laravel
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Logrado!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Aceptar',
            customClass: { confirmButton: 'btn btn-primary' }
        });
    @endif

    // 7. Resetear formularios de modales al cerrar
    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });
});
</script>
@endsection



