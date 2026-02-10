@extends('layouts.app')

@section('content')

<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">Asignación de carga</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('carga.procesar_busqueda') }}" method="POST" id="form-busqueda">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tipo </label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="" disabled selected>Seleccione tipo</option>
                                <option value="Caja">Caja</option>
                                <option value="Suelto">Guia</option>
                               
                            </select>
                        </div>

                        <div  class="d-none">
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

                            

                           
                        </div>

                        <div id="contenedor-caja" class="d-none">
                            <div class="alert alert-info border-0 shadow-sm">
                                <i class="bx bx-info-circle me-1"></i> Usted está procesando la ubicación de una Caja.
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Continuar a Asignación <i class="bx bx-right-arrow-alt ms-1"></i>
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
   
    // --- LÓGICA DE INTERFAZ DINÁMICA ---
    selectTipo.addEventListener('change', function() {
        if (this.value === 'Caja') {
            contenedorCaja.classList.remove('d-none');
            contenedorSuelto.classList.add('d-none');
           
            inputCaja.value = "Caja"; // Valor por defecto para el backend
           
        } else if (this.value === 'Suelto') {
            contenedorCaja.classList.add('d-none');
            contenedorSuelto.classList.remove('d-none');
         
            inputCaja.value = "Suelto"; 
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