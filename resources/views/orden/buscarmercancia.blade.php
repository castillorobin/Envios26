@extends('layouts.app')

@section('content')

<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">Asignar Caja</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('ordenes.asignacion') }}" method="POST" id="form-busqueda">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tipo de almacenamiento</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="" disabled selected>Seleccione tipo</option>
                                <option value="Caja">Caja</option>
                                
                            </select>
                        </div>

                        <div id="contenedor-caja" class="d-none">
                            <div class="mb-3">
                                <label class="form-label">Escanear o Ingresar Número de Caja</label>
                                <div class="input-group">
                                    <input type="text" name="caja" id="guia_input" 
                                           class="form-control form-control-lg" 
                                           placeholder="Ingrese # de caja...">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-search-alt"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="reader-container" class="d-none border rounded bg-light mb-3">
                                <div id="reader" style="width: 100%;"></div>
                                <div class="p-2 text-center">
                                    <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger">
                                        Cerrar Cámara
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="button" id="btn-activar-qr" class="btn btn-outline-secondary btn-lg">
                                    <i class="bx bx-qr-scan me-1"></i> Usar Cámara QR
                                </button>
                            </div>
                        </div>

                        <div id="contenedor-suelto" class="d-none">
                            <div class="alert alert-info border-0 shadow-sm">
                                <i class="bx bx-info-circle me-1"></i> Se procesará la mercancía de forma Suelto.
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Continuar a Asignación <i class="bx bx-right-arrow-alt ms-1"></i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectTipo = document.getElementById('tipo');
    const contenedorCaja = document.getElementById('contenedor-caja');
    const contenedorSuelto = document.getElementById('contenedor-suelto');
    const inputCaja = document.getElementById('guia_input');
    
    // --- LÓGICA DE INTERFAZ DINÁMICA ---
    selectTipo.addEventListener('change', function() {
        if (this.value === 'Caja') {
            contenedorCaja.classList.remove('d-none');
            contenedorSuelto.classList.add('d-none');
            inputCaja.required = true;
            inputCaja.value = ""; // Limpiar si venía de suelto
            inputCaja.focus();
        } else if (this.value === 'Suelto') {
            contenedorCaja.classList.add('d-none');
            contenedorSuelto.classList.remove('d-none');
            inputCaja.required = false;
            inputCaja.value = "Suelto"; // Valor por defecto para el backend
            cerrarScanner(); // Por seguridad si la cámara estaba abierta
        }
    });

    // --- LÓGICA QR (Tu código existente ajustado) ---
    const btnActivarQr = document.getElementById('btn-activar-qr');
    const btnCerrarCamara = document.getElementById('btn-cerrar-camara');
    const readerContainer = document.getElementById('reader-container');
    const formBusqueda = document.getElementById('form-busqueda');
    let html5QrCode;

    btnActivarQr.addEventListener('click', function() {
        readerContainer.classList.remove('d-none');
        btnActivarQr.classList.add('d-none'); 

        html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 15, qrbox: { width: 250, height: 250 } };

        html5QrCode.start(
            { facingMode: "environment" }, 
            config,
            (decodedText) => {
                inputCaja.value = decodedText;
                cerrarScanner();
                formBusqueda.submit();
            }
        ).catch(err => {
            console.error("Error cámara:", err);
            Swal.fire('Error', "No se pudo acceder a la cámara.", 'error');
            cerrarScanner();
        });
    });

    function cerrarScanner() {
        if (html5QrCode && html5QrCode.isScanning) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                readerContainer.classList.add('d-none');
                btnActivarQr.classList.remove('d-none');
            });
        } else {
            readerContainer.classList.add('d-none');
            btnActivarQr.classList.remove('d-none');
        }
    }

    btnCerrarCamara.addEventListener('click', cerrarScanner);
});
</script>

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: '¡Atención!',
                text: "{{ session('error') }}",
                confirmButtonText: 'Aceptar',
                customClass: { confirmButton: 'btn btn-danger' }
            });
        });
    </script>
@endif
@endsection