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



                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">No entregados</h4>
                                
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
                                                <input type="text" id="qr-input" class="form-control" style="max-width: 400px;" placeholder="Ingresar guía" autofocus>
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

                                        <div class="table-responsive table-centered mt-1">




                                            <table class="table text-nowrap mb-0" id="tabla-lote">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Guía</th>
                                                <th>Comercio</th>
                                                <th>Destinatario</th>
                                                <th>Destino</th>
                                                <th>Estado</th>
                                                <th>Ubicación</th>
                                                <th>Tipo Almac.</th>
                                                <th>N° Caja</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>

                                           
                                            
                                        </tbody>
                                        <!-- end tbody -->
                                    </table>



                                        
                                           
                                        </div>



                                        <div class="card-footer bg-transparent border-top">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                                <div id="dt-info-container"></div>
                                                <div id="dt-pagination-container"></div>
                                            </div>
                                        </div>



                                        <div class="text-end mt-4" style="margin-bottom: 20px; margin-right: 20px;">
                                            <a href="/reparto/no-entregados">
                                            <button type="button" id="btn-limpiar" class="btn btn-lg btn-secondary">Limpiar lista</button>
                                            </a>
                                            <button type="button" id="btn-entregar-lote" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalEntregarLote">
                                                <i class="fas fa-check-circle"></i> Actualizar
                                            </button>
                                        </div>
                                    <!-- end table responsive -->
                                
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->




                        




                </div>
</div>















<!-- Modal Entregar en Lote -->
<div class="modal fade" id="modalEntregarLote" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal modal-dialog-centered">
        <div class="modal-content">
            <form id="formnoentrega" method="POST" action="{{ route('noentregado.actualizar') }}">
    @csrf
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title " style="color: white;">Detalles de la Actualizacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                </div>

                <div class="modal-body">
                   
                    
                    <div class="row">
						<input type="hidden" name="guias" id="guias-lote">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Cajero</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Fecha y Hora</label>
                            <input type="text" class="form-control" value="{{ now()->format('d/m/Y H:i') }}" readonly>
                        </div>
						
                        <div class="col-md-12 mb-3">
                            <div class="alert alert-danger text-center" role="alert">
                                Estas a punto de cambiar el estado a <strong>No entregado</strong> a 
                                <span id="conteo-paquetes" class="fw-bold">0</span> paquetes. ¿Estás seguro?
                            </div>
                        </div>

                                                                                        
                        
                        
                    </div>


                   

                   
                </div>



                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" style="background-color: #a7acb1;">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>











<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let listaGuias = [];
    let isProcessing = false; 
    
    const tablaBody = document.querySelector("#tabla-lote tbody");
    const inputManual = document.getElementById("qr-input"); 
    const btnAgregarManual = document.getElementById("btn-agregar"); 
    const btnActivarQR = document.getElementById("btn-activar-qr"); 
    const readerDiv = document.getElementById("reader-container"); 
    const hiddenGuias = document.getElementById("guias-lote");
    const btnLimpiar = document.getElementById("btn-limpiar");
    const formNoEntrega = document.getElementById("formnoentrega");

    let qrScanner = null;

    function actualizarHidden() {
        if (hiddenGuias) { hiddenGuias.value = JSON.stringify(listaGuias); }
    }

    async function detenerCamara() {
        if (qrScanner) {
            try {
                await qrScanner.stop();
                qrScanner = null;
                readerDiv.classList.add('d-none');
                inputManual.placeholder = "Ingresar guía";
            } catch (e) { console.warn("Error:", e); }
        }
    }

    window.detenerCamara = detenerCamara;

    btnActivarQR.addEventListener("click", async function () {
        if (qrScanner) { detenerCamara(); return; }
        qrScanner = new Html5Qrcode("reader");
        readerDiv.classList.remove('d-none');
        try {
            await qrScanner.start(
                { facingMode: "environment" },
                { fps: 15, qrbox: { width: 250, height: 250 } },
                async codigoQR => {
                    if (isProcessing) return;
                    isProcessing = true;
                    await verificarYAgregar(codigoQR);
                    setTimeout(() => { isProcessing = false; }, 800);
                }
            );
        } catch (error) { Swal.fire("Error", "No se pudo acceder a la cámara", "error"); }
    });

    document.getElementById("btn-cerrar-camara").addEventListener("click", detenerCamara);

    btnAgregarManual.addEventListener("click", () => {
        const valor = inputManual.value.trim();
        if (valor) verificarYAgregar(valor);
        else inputManual.focus();
    });

    inputManual.addEventListener("keypress", (e) => {
        if (e.key === "Enter") { e.preventDefault(); btnAgregarManual.click(); }
    });

    async function verificarYAgregar(guia) {
        guia = guia.trim();
        if (listaGuias.includes(guia)) {
            inputManual.value = "";
            Swal.fire({ icon: "info", title: "Duplicado", text: `La guía ${guia} ya está en la lista.`, timer: 1000, showConfirmButton: false });
            return;
        }

        try {
            const res = await fetch("{{ route('noentregado.verificar') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ guia })
            });

            const data = await res.json();
            if (!data.exists) {
                Swal.fire({ icon: "error", title: "No encontrada", text: `La guía ${guia} no existe.`, timer: 1500, showConfirmButton: false });
                inputManual.value = "";
                return;
            }

            agregarFila(data.envio);
            inputManual.value = "";
            inputManual.focus();
        } catch (err) { console.error("Error:", err); }
    }



    document.getElementById("btn-entregar-lote").addEventListener("click", function() {
    // 1. Obtener la cantidad de guías en la lista
    const totalGuia = listaGuias.length;

    // 2. Insertar el número en el span del modal
    document.getElementById("conteo-paquetes").textContent = totalGuia;
    // Convertimos el array JS a una cadena JSON para el controlador
    document.getElementById("guias-lote").value = JSON.stringify(listaGuias);

    // 3. Actualizar el input hidden por seguridad antes de abrir
    actualizarHidden();

    // 4. (Opcional) Si quieres que el botón "Actualizar" del modal se bloquee si no hay nada
    const btnSubmit = document.querySelector("#modalEntregarLote button[type='submit']");
    if (totalGuia === 0) {
        btnSubmit.disabled = true;
    } else {
        btnSubmit.disabled = false;
    }
});

    function agregarFila(envio) {
    listaGuias.push(envio.guia);
    actualizarHidden();
    
    const nombreComercio = envio.comercio_rel ? envio.comercio_rel.nombre : (envio.comercio || '---');
    
   
    let badgeEstado = '';
    const estado = envio.estado;

    switch (estado) {
        case 'Recepcionado':
            badgeEstado = `<span class="badge text-bg-secondary">Recepcionado</span>`;
            break;
        case 'Creado':
            badgeEstado = `<span class="badge text-bg-primary">Creado</span>`;
            break;
        case 'No entregado':
            badgeEstado = `<span class="badge text-bg-danger">No entregado</span>`;
            break;
        case 'Fallido':
            badgeEstado = `<span class="badge text-bg-warning">Fallido</span>`;
            break;
        case 'Entregado':
            badgeEstado = `<span class="badge text-bg-success">Entregado</span>`;
            break;
        default:
            badgeEstado = `<span class="badge text-bg-light">${estado || '---'}</span>`;
    }

    // --- CONSTRUCCIÓN DE LA FILA ---
    const nuevaFila = `
        <tr data-guia="${envio.guia}">
            <td><span class="fw-bold text-primary">${envio.guia}</span></td>
            <td>${nombreComercio}</td>
            <td>${envio.destinatario ?? '---'}</td>
            <td>${envio.destino ?? '---'}</td>
            <td>${badgeEstado}</td> <td>${envio.agencia ?? '---'}</td>
            <td>${envio.tipo_asignacion ?? 'Suelto'}</td>
            <td>${envio.caja ?? '---'}</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-soft-danger btn-quitar" data-guia="${envio.guia}">
                    <i class="bx bx-trash fs-16"></i>
                </button>
            </td>
        </tr>
    `;
    tablaBody.insertAdjacentHTML("afterbegin", nuevaFila);
}

    tablaBody.addEventListener("click", function(e) {
        const btn = e.target.closest(".btn-quitar");
        if (!btn) return;
        listaGuias = listaGuias.filter(g => g !== btn.dataset.guia);
        actualizarHidden();
        btn.closest("tr").remove();
    });

    btnLimpiar.addEventListener("click", () => {
        listaGuias = []; actualizarHidden(); tablaBody.innerHTML = ""; inputManual.focus();
    });
});
</script>


@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Proceso Completado!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#198754', // Color verde success de Bootstrap
                confirmButtonText: 'Aceptar',
                timer: 3000, // Se cierra solo en 3 segundos si no interactúan
                timerProgressBar: true
            });
        });
    </script>
@endif
@endsection