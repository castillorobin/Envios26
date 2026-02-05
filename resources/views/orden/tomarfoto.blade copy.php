@extends('layouts.app')

@section('content')




<div class="container-xxl">
                    <!-- ========== Page Title Start ========== 
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Create Product</h4>
                                
                            </div>
                        </div>
                    </div>
                    -->
                    <!-- ========== Page Title End ========== -->


                    <div class="row">
                        <div class="col">
                            <div class="card" id="horizontalwizard">
                                <div class="card-header">
                                    


                                    <div class="row">
                                            <div class="col-12 col-lg-6"> 
                                                <div class="mb-3">
                                                    <label class="form-label">Escanear o Ingresar Guía</label>
                                                    
                                                    <div class="d-block d-sm-flex gap-2">
                                                        
                                                        <div class="flex-grow-1 mb-2 mb-sm-0">
                                                            <input type="text" id="guia_input" class="form-control form-control-lg" placeholder="Código de guía..." autofocus>
                                                        </div>

                                                        <div class="d-flex gap-2">
                                                            <button type="button" id="btn-buscar-guia" class="btn btn-primary px-3">
                                                                <i class="bx bx-search-alt"></i>
                                                            </button>
                                                            <button type="button" id="btn-activar-qr" class="btn btn-outline-secondary px-3">
                                                                <i class="bx bx-qr-scan"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div id="reader-container" class="d-none border rounded bg-light mt-3">
                                                        <div id="reader" style="width: 100%;"></div>
                                                        <div class="p-2 text-center">
                                                            <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger w-100">
                                                                Cerrar Cámara
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div id="info-guia-encontrada" class="alert alert-success d-none mt-3">
                                                        <i class="bx bx-check-circle me-1"></i> 
                                                        Guía encontrada: <strong id="texto-guia-confirmada"></strong> 
                                                    </div>
                                                </div>

                                            <div id="reader-container" class="d-none border rounded bg-light mb-3">
                                                <div id="reader" style="width: 100%;"></div>
                                                <div class="p-2 text-center">
                                                    <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger w-100">
                                                        Cerrar Cámara
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                        
                                    </div>


                                    







                                    <ul class="nav nav-tabs card-header-tabs border-0" role="tablist">
                                       
                                        <!-- end nav item -->
                                        <li class="nav-item" data-target-form="#productImagesForm" role="presentation">
                                            <a href="#productImages" data-bs-toggle="tab" data-toggle="tab" class="nav-link pb-3 active" aria-selected="true" role="tab">
                                                <i class="bx bx-images me-1"></i>
                                                <span class="d-none d-sm-inline">Toma de fotografia</span>
                                            </a>
                                        </li>
                                        <!-- end nav item -->
                                    
                                       
                                    </ul>
                                    <!-- nav pills -->
                                </div>
                                <div class="card-body">
                                    <div class="tab-content pt-0">
                                        
                                        <!-- end contact detail tab pane -->
                                        <div class="tab-pane active show" id="productImages" role="tabpanel">
    <h5 class="fs-14 mb-1">Fotos de la orden</h5>
    <p class="text-muted fs-13">Agregar fotos a la orden (Máximo 3).</p>
    
    <form action="{{ route('ordenes.guardar_fotos') }}" method="post" class="dropzone" id="productImagesForm">
        @csrf
        <input type="hidden" name="guia" id="guia_hidden">
        <div class="dz-message needsclick">
            <i class="h1 bx bx-cloud-upload"></i>
            <h3>Click o tab para subir fotos.</h3>
        </div>
    </form>

    <div class="d-flex flex-wrap gap-2 justify-content-end mt-3">
        <a href="/ordenes/toma-foto" class="btn btn-secondary">
            <i class="bx bx-x me-1"></i> Cancelar
        </a>
        <button type="button" id="btn-finalizar-guardado" class="btn btn-primary">
            <i class="bx bx-save me-1"></i> Guardar Fotos
        </button>
    </div>
</div>
                                    </div>
                                    <!-- end tab content-->                              </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>



            

                <script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const guiaInput = document.getElementById('guia_input');
    const btnBuscar = document.getElementById('btn-buscar-guia');
    const infoContainer = document.getElementById('info-guia-encontrada');
    const textoGuia = document.getElementById('texto-guia-confirmada');

    async function realizarBusqueda(codigo) {
        if (!codigo.trim()) return;

        // Limpiar estados previos
        infoContainer.classList.add('d-none');
        guiaInput.classList.remove('is-valid', 'is-invalid');

        try {
            const response = await fetch("{{ route('ordenes.buscar_ajax') }}?guia=" + encodeURIComponent(codigo));
            const data = await response.json();

            // Si el controlador devolvió success: true
            if (data.success) {
                infoContainer.classList.remove('d-none');
                textoGuia.innerText = data.guia;
                guiaInput.classList.add('is-valid');
                
                // Opcional: Sonido de éxito o vibración
                if (navigator.vibrate) navigator.vibrate(50);
            } 
            // Si el controlador devolvió success: false (Guía no encontrada)
            else {
                mostrarError(data.message || 'La guía ingresada no existe.');
            }

        } catch (error) {
            console.error("Error en la petición:", error);
            mostrarError('Hubo un error de conexión con el servidor.');
        }
    }

    function mostrarError(mensaje) {
        guiaInput.classList.add('is-invalid');
        Swal.fire({
            icon: 'error',
            title: 'No encontrado',
            text: mensaje,
            confirmButtonColor: '#3085d6',
        });
        guiaInput.value = ""; // Limpiar para re-intentar
        guiaInput.focus();
    }

    // Eventos
    btnBuscar.addEventListener('click', () => realizarBusqueda(guiaInput.value));
    
    guiaInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            realizarBusqueda(guiaInput.value);
        }
    });

    // Lógica QR (Asegúrate de llamar a realizarBusqueda al detectar)
    const html5QrCode = new Html5Qrcode("reader");
    document.getElementById('btn-activar-qr').addEventListener('click', () => {
        const reader = document.getElementById('reader-container');
        reader.classList.remove('d-none');
        html5QrCode.start(
            { facingMode: "environment" }, 
            { fps: 10, qrbox: 250 },
            (decodedText) => {
                guiaInput.value = decodedText;
                realizarBusqueda(decodedText);
                html5QrCode.stop().then(() => reader.classList.add('d-none'));
            }
        ).catch(err => console.error("Error cámara:", err));
    });
});
</script>

<script>
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#productImagesForm", {
    url: "{{ route('ordenes.guardar_fotos') }}",
    paramName: "file",
    maxFiles: 3,
    maxFilesize: 2,
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    autoProcessQueue: false,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    init: function() {
        var dz = this;

        // Seleccionamos el botón por ID de forma segura
        const btnGuardar = document.getElementById('btn-finalizar-guardado');

        btnGuardar.addEventListener("click", function(e) {
            console.log("¡Botón Guardar presionado!"); // Si no ves esto en F12, el ID está mal.

            const guiaInput = document.getElementById('guia_input');
            const guiaValue = guiaInput.value.trim();

            if (!guiaValue) {
                Swal.fire('Atención', 'Primero debes buscar y confirmar una guía.', 'warning');
                return;
            }

            // Verificar si hay archivos en la cola
            const archivosEnCola = dz.getQueuedFiles().length;
            console.log("Archivos listos para subir: " + archivosEnCola);

            if (archivosEnCola === 0) {
                Swal.fire('Atención', 'Debes agregar al menos una foto.', 'info');
                return;
            }

            // Sincronizar e inyectar parámetros
            document.getElementById('guia_hidden').value = guiaValue;
            dz.options.params = { guia: guiaValue };

            // Iniciar subida
            dz.processQueue();
        });

        this.on("sending", function(file, xhr, formData) {
            const g = document.getElementById('guia_input').value.trim();
            formData.append("guia", g);
            console.log("Enviando guía: " + g);
        });

        this.on("queuecomplete", function() {
            Swal.fire({
                icon: 'success',
                title: '¡Guardado!',
                text: 'Las fotos han sido procesadas.',
            }).then(() => {
                window.location.reload(); 
            });
        });

        this.on("error", function(file, response) {
            console.error("Error detallado:", response);
            let msg = (typeof response === 'object') ? (response.error || "Error de servidor") : response;
            Swal.fire('Error', msg, 'error');
        });
    }
});
</script>

@endsection