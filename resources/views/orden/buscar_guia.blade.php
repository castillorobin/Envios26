@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">Iniciar Nueva Orden</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('ordenes.procesar_busqueda') }}" method="POST" id="form-busqueda">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Escanear o Ingresar Guía</label>
                            <div class="input-group">
                                <input type="text" name="guia" id="guia_input" 
                                       class="form-control form-control-lg" 
                                       placeholder="Código de guía..." 
                                       autofocus required>
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

                        <div class="d-grid gap-2" id="botones-iniciales">
                            <button type="button" id="btn-activar-qr" class="btn btn-outline-secondary btn-lg">
                                <i class="bx bx-qr-scan me-1"></i> Usar Cámara QR
                            </button>
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
    const guiaInput = document.getElementById('guia_input');
    const btnActivarQr = document.getElementById('btn-activar-qr');
    const btnCerrarCamara = document.getElementById('btn-cerrar-camara');
    const readerContainer = document.getElementById('reader-container');
    const formBusqueda = document.getElementById('form-busqueda');
    
    let html5QrCode;

    // --- FUNCIÓN PARA INICIAR ESCÁNER ---
    btnActivarQr.addEventListener('click', function() {
        readerContainer.classList.remove('d-none');
        btnActivarQr.parentElement.classList.add('d-none'); // Oculta el botón de activar

        html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 15, qrbox: { width: 250, height: 250 } };

        html5QrCode.start(
            { facingMode: "environment" }, 
            config,
            (decodedText) => {
                // Éxito: Ponemos el texto en el input y enviamos el formulario
                guiaInput.value = decodedText;
                cerrarScanner();
                formBusqueda.submit(); // Envío automático al detectar
            }
        ).catch(err => {
            console.error("Error cámara:", err);
            alert("No se pudo acceder a la cámara. Verifique los permisos.");
            cerrarScanner();
        });
    });

    // --- FUNCIÓN PARA DETENER/LIMPIAR ---
    function cerrarScanner() {
        if (html5QrCode && html5QrCode.isScanning) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                readerContainer.classList.add('d-none');
                btnActivarQr.parentElement.classList.remove('d-none');
            });
        } else {
            readerContainer.classList.add('d-none');
            btnActivarQr.parentElement.classList.remove('d-none');
        }
    }

    btnCerrarCamara.addEventListener('click', cerrarScanner);
});
</script>
@endsection