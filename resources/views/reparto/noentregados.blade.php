@extends('layouts.app')

@section('content')
<style>
    /* Forzar el ancho del contenedor de Choices */
    .choices {
        width: 100% !important;
        margin-bottom: 0 !important; /* Quitar margen inferior que traen por defecto */
    }

    /* Ajustar la altura interna para que coincida con un botón estándar (aprox 38px) */
    .choices__inner {
        min-height: 38px !important;
        padding: 4px 10px !important;
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.375rem !important;
    }

    /* Centrar el texto del buscador */
    .choices__list--single {
        padding: 0 !important;
        line-height: 28px;
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
                        
                        <!-- end col -->
                        <div class="col-xl-12">
                            <div class="card">
                                    <div class="card-body">
                                             <!-- Escáner QR -->
                                        <div class="d-flex align-items-center mb-4">
                                            <input id="qr-input" type="text" placeholder="Escanear código QR" readonly
                                                class="form-control me-3" style="max-width: 300px;" />
                                        
                                        </div>

                                        <div id="qr-reader" style="width:50%; display:none;" class="border rounded p-2 mb-3"></div>
                                            <div id="camera-controls" style="width:50%; display:none;" class="mb-3 text-center">
                                                <button type="button" class="btn btn-sm btn-danger" onclick="detenerCamara()">
                                                    <i class="bx bx-camera-off"></i> Finalizar escaneo
                                                </button>
                                            </div>
                                    </div>
                                        <div class="table-responsive table-centered mt-1">
                                        
                                            <table class="table table-borderless table-hover table-nowrap align-middle"  id="tabla-lote">
                                                <thead class="bg-light bg-opacity-50 thead-sm">
                                                    <tr >
                                                        <th>Guía</th>
                                                        <th>Comercio</th>
                                                        <th>Destinatario</th>
                                                        <th>Estado</th>
                                                        
                                                        <th>Accion</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                        <div class="text-end mt-4" style="margin-bottom: 20px; margin-right: 20px;">
                                            <button type="button" id="btn-limpiar" class="btn btn-secondary">Limpiar lista</button>
                                            <button type="button" id="btn-entregar-lote" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEntregarLote">
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="formnoentrega" method="POST" action="{{ route('noentregado.actualizar') }}">
    @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Detalles de la Actualizacion</h5>
                    <button type="button" class="btn btn-icon btn-sm btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body">
                   
                    
                    <div class="row">
						<input type="hidden" name="guias" id="guias-lote">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cajero</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="text" class="form-control" value="{{ now()->format('j/n/Y') }}" readonly>
                        </div>
						<div class="col-md-6 mb-3">
                            <label class="form-label">Estado</label>
                            <input type="text" id="estado" name="estado" class="form-control" value="No entregado" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Agencia</label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            
                            <select class="form-select" name="ubicacion" required>
                                <option value="caja">Caja</option>
                                <option value="suelto">Suelto</option>
                                
                            </select>
                        </div>
                                                                
                        
                        
                    </div>


                   

                   
                </div>



                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
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
    let isProcessing = false; // 🔥 SEMÁFORO: Evita procesar múltiples lecturas a la vez
    
    const tablaBody = document.querySelector("#tabla-lote tbody");
    const inputQR = document.getElementById("qr-input");
    const readerDiv = document.getElementById("qr-reader");
    const hiddenGuias = document.getElementById("guias-lote");
    const btnLimpiar = document.getElementById("btn-limpiar");
    const formNoEntrega = document.getElementById("formnoentrega");

    let qrScanner = null;

    function actualizarHidden() {
        if (hiddenGuias) {
            hiddenGuias.value = JSON.stringify(listaGuias);
        }
    }

    async function detenerCamara() {
        if (qrScanner) {
            try {
                await qrScanner.stop();
                qrScanner = null;
                readerDiv.style.display = "none";
                inputQR.placeholder = "Escanear código QR";
                document.getElementById("camera-controls").style.display = "none";
            } catch (e) {
                console.warn("Error al detener cámara:", e);
            }
        }
    }

    // Definir detenerCamara globalmente para el botón del HTML
    window.detenerCamara = detenerCamara;

    // ======================================================
    // 📸 INICIAR ESCANEO CONTINUO
    // ======================================================
    inputQR.addEventListener("click", async function () {
        if (qrScanner) return; 

        qrScanner = new Html5Qrcode("qr-reader");
        readerDiv.style.display = "block";
        document.getElementById("camera-controls").style.display = "block";
        inputQR.placeholder = "Escaneando...";

        try {
            await qrScanner.start(
                { facingMode: "environment" },
                { 
                    fps: 10, 
                    qrbox: { width: 250, height: 250 } 
                },
                async codigoQR => {
                    // Si ya estamos procesando un código, ignoramos este frame
                    if (isProcessing) return;
                    
                    isProcessing = true; // Bloqueamos el paso
                    inputQR.value = "Procesando...";
                    
                    // Ejecutamos la verificación
                    await verificarYAgregar(codigoQR);
                    
                    // Liberamos el bloqueo después de un pequeño delay para dar tiempo a la cámara de moverse
                    setTimeout(() => { isProcessing = false; }, 500);
                }
            );
        } catch (error) {
            console.error("Error al iniciar cámara:", error);
            isProcessing = false;
        }
    });

    // ======================================================
    // 🔍 VERIFICACIÓN Y AGREGADO DINÁMICO
    // ======================================================
    async function verificarYAgregar(guia) {
        guia = guia.trim();

        // 1. Verificar duplicado localmente
        if (listaGuias.includes(guia)) {
            inputQR.value = "";
            return; // Salimos silenciosamente si ya existe para no saturar con alertas
        }

        try {
            const res = await fetch("{{ route('noentregado.verificar') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ guia })
            });

            const data = await res.json();

            if (!data.exists) {
                Swal.fire({ 
                    icon: "error", 
                    title: "No encontrada", 
                    text: `La guía ${guia} no existe.`,
                    timer: 1500,
                    showConfirmButton: false 
                });
                inputQR.value = "";
                return;
            }

            // 2. Agregar a la lista y a la tabla
            listaGuias.push(data.envio.guia);
            actualizarHidden();
            
            const nombreComercio = data.envio.comercio_rel ? data.envio.comercio_rel.nombre : (data.envio.comercio || '---');

            const nuevaFila = `
                <tr data-guia="${data.envio.guia}">
                    <td><span class="fw-bold text-primary">${data.envio.guia}</span></td>
                    <td>${nombreComercio}</td>
                    <td>${data.envio.destinatario ?? '---'}</td>
                    <td><span class="badge bg-light-warning text-warning">No entregado</span></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-soft-danger btn-quitar" data-guia="${data.envio.guia}">
                            <i class="bx bx-trash fs-16"></i>
                        </button>
                    </td>
                </tr>
            `;
            tablaBody.insertAdjacentHTML("afterbegin", nuevaFila);
            
            inputQR.value = "";
            inputQR.focus();

        } catch (err) {
            console.error("Error:", err);
            inputQR.value = "";
        }
    }

    // Quitar una sola guía
    tablaBody.addEventListener("click", function(e) {
        const btn = e.target.closest(".btn-quitar");
        if (!btn) return;
        const guia = btn.dataset.guia;
        listaGuias = listaGuias.filter(g => g !== guia);
        actualizarHidden();
        btn.closest("tr").remove();
    });

    // Limpiar toda la lista
    btnLimpiar.addEventListener("click", function () {
        listaGuias = [];
        actualizarHidden();
        tablaBody.innerHTML = "";
    });

    if (formNoEntrega) {
        formNoEntrega.addEventListener("submit", function(e) {
            if (listaGuias.length === 0) {
                e.preventDefault();
                Swal.fire({ icon: "warning", title: "Lista vacía", text: "Escanee al menos una guía." });
            }
        });
    }
});
</script>


@endsection