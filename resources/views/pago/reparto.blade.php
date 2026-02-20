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



<div class="row justify-content-center">
                        <div class="col-6">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Pago Reparto</h4>
                                
                            </div>
                        </div>
                    </div>




    <div class="row justify-content-center">
                        
                        <!-- end col -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="/reparto/crearpago" method="GET">

                                           <div class="mb-3">
                                <label class="form-label">Escanear o Ingresar Número de Ticket</label>
                                <div class="input-group">
                                    <input type="text" name="caja" id="guia_input" 
                                           class="form-control form-control-lg" 
                                           placeholder="Ingrese # de ticket...">
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
                                             </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-centered mt-3">
                                       
                                        <!-- end table-->
                                    </div>
                                    <!-- end table responsive -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->




                        




                    </div>
</div>



<script src="https://unpkg.com/html5-qrcode"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputGuia = document.getElementById('guia_input');
    const btnActivarQr = document.getElementById('btn-activar-qr');
    const btnCerrarCamara = document.getElementById('btn-cerrar-camara');
    const readerContainer = document.getElementById('reader-container');
    const formPago = inputGuia.closest('form');
    let html5QrCode;

    btnActivarQr.addEventListener('click', function() {
        readerContainer.classList.remove('d-none');
        btnActivarQr.classList.add('d-none'); // Ocultar botón de activar mientras se usa

        html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 15, qrbox: { width: 250, height: 250 } };

        html5QrCode.start(
            { facingMode: "environment" }, 
            config,
            (decodedText) => {
                // Al detectar el código
                inputGuia.value = decodedText;
                cerrarScanner();
                formPago.submit(); // Enviar automáticamente
            }
        ).catch(err => {
            console.error("Error al iniciar cámara", err);
            alert("No se pudo acceder a la cámara.");
            cerrarScanner();
        });
    });

    function cerrarScanner() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                readerContainer.classList.add('d-none');
                btnActivarQr.classList.remove('d-none');
            });
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