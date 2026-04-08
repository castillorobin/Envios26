@extends('layouts.app')

@section('content')

<style>
    .dropzone {
        min-height: 150px;
        border: 2px dashed #ced4da;
        background: white;
        border-radius: 6px;
    }
    .dropzone.disabled {
        opacity: 0.5;
        pointer-events: none;
        background-color: #f8f9fa;
        cursor: not-allowed;
    }
    /* Estilo para el contenedor del lector QR */
    #reader-container {
        max-width: 400px;
        margin-top: 15px;
    }

    @media (max-width: 768px) {
        .dropzone {
            min-height: 250px; /* Más grande en móviles para facilitar el toque */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        .dz-message {
            margin: 2em 0 !important;
        }
    }
</style>

<div class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
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

                                <div id="reader-container" class="d-none border rounded bg-light">
                                    <div id="reader" style="width: 100%;"></div>
                                    <div class="p-2 text-center">
                                        <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger">
                                            Cerrar Cámara
                                        </button>
                                    </div>
                                </div>

                                <div id="info-guia-encontrada" class="alert alert-success d-none mt-3">
                                    <i class="bx bx-check-circle me-1"></i> 
                                    Guía encontrada: <strong id="texto-guia-confirmada"></strong> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs card-header-tabs border-0" role="tablist">
                        <li class="nav-item">
                            <a href="#productImages" data-bs-toggle="tab" class="nav-link pb-3 active">
                                <i class="bx bx-images me-1"></i> Toma de fotografía
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content pt-0">
                        <div class="tab-pane active show" id="productImages" role="tabpanel">
                            <h5 class="fs-14 mb-1">Fotos de la orden</h5>
                            <p class="text-muted fs-13">Agregar fotos a la orden (Máximo 3).</p>
                            
                            <form action="{{ route('ordenes.guardar_fotos') }}" method="post" class="dropzone disabled" id="productImagesForm">
                                @csrf
                                <input type="hidden" name="guia" id="guia_hidden">
                                <div class="dz-message needsclick">
                                    <i class="h1 bx bx-cloud-upload"></i>
                                    <h3>Click o tab para subir fotos.</h3>
                                </div>
                            </form>

                            <div class="d-flex flex-wrap gap-2 justify-content-end mt-3">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                    <i class="bx bx-x me-1"></i> Cancelar
                                </a>
                                <button type="button" id="btn-finalizar-guardado" class="btn btn-primary">
                                    <i class="bx bx-save me-1"></i> Guardar Fotos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- REFERENCIAS ---
    const guiaInput = document.getElementById('guia_input');
    const btnBuscar = document.getElementById('btn-buscar-guia');
    const btnActivarQR = document.getElementById('btn-activar-qr');
    const btnCerrarCamara = document.getElementById('btn-cerrar-camara');
    const readerContainer = document.getElementById('reader-container');
    const infoContainer = document.getElementById('info-guia-encontrada');
    const textoGuia = document.getElementById('texto-guia-confirmada');
    const dropzoneElement = document.getElementById('productImagesForm');
    const guiaHidden = document.getElementById('guia_hidden');
    const btnGuardar = document.getElementById('btn-finalizar-guardado');
    let html5QrCode;

    // --- LÓGICA DE BÚSQUEDA ---
    async function realizarBusqueda(codigo) {
        const query = codigo.trim();
        if (!query) return;

        try {
            btnBuscar.disabled = true;
            const response = await fetch("{{ route('ordenes.buscar_ajax') }}?guia=" + encodeURIComponent(query));
            const data = await response.json();

            if (data.success) {
                infoContainer.classList.remove('d-none');
                textoGuia.innerText = data.guia;
                guiaInput.classList.add('is-valid');
                guiaInput.classList.remove('is-invalid');
                dropzoneElement.classList.remove('disabled');
                guiaHidden.value = data.guia;

                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                }).fire({ icon: 'success', title: 'Guía validada' });

            } else {
                bloquearDropzone();
                Swal.fire('Error', data.message || 'Guía no encontrada', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Error de conexión', 'error');
        } finally {
            btnBuscar.disabled = false;
        }
    }

    function bloquearDropzone() {
        dropzoneElement.classList.add('disabled');
        infoContainer.classList.add('d-none');
        guiaInput.classList.remove('is-valid');
        guiaHidden.value = '';
        if (typeof myDropzone !== 'undefined') myDropzone.removeAllFiles(true);
    }

    // --- LÓGICA QR (ESTILO ENTREGA) ---
    btnActivarQR.addEventListener('click', function() {
        readerContainer.classList.remove('d-none');
        html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 15, qrbox: 250 },
            (text) => {
                guiaInput.value = text;
                detenerCamara();
                realizarBusqueda(text);
            }
        ).catch(err => Swal.fire('Error', 'No se pudo activar la cámara', 'error'));
    });

    function detenerCamara() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                readerContainer.classList.add('d-none');
            }).catch(err => console.error(err));
        }
    }

    btnCerrarCamara.addEventListener('click', detenerCamara);

    // --- EVENTOS DE INPUT ---
    btnBuscar.addEventListener('click', () => realizarBusqueda(guiaInput.value));
    guiaInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            realizarBusqueda(guiaInput.value);
        }
    });

    // --- DROPZONE ---
    Dropzone.autoDiscover = false;
    if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());

    var myDropzone = new Dropzone("#productImagesForm", {
        url: "{{ route('ordenes.guardar_fotos') }}",
    paramName: "file",
    maxFiles: 3,
    maxFilesize: 2,
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    autoProcessQueue: false,
    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
    dictDefaultMessage: "Toca aquí para tomar la foto", // Mejorar UX en móvil
    init: function() {
        this.on("addedfile", function(file) {
            // Lógica opcional al añadir
        });

        // ESTA ES LA CLAVE PARA MÓVILES:
        // Buscamos el input oculto que genera Dropzone
        const hiddenInput = document.querySelector('input[type=file].dz-hidden-input');
        if (hiddenInput) {
            hiddenInput.setAttribute('capture', 'environment'); // Fuerza cámara trasera
            hiddenInput.setAttribute('accept', 'image/*');      // Asegura solo imágenes
        }
        
        }
    });

    btnGuardar.addEventListener("click", function() {
        if (!guiaHidden.value) {
            Swal.fire('Atención', 'Valida una guía primero', 'warning');
            return;
        }
        if (myDropzone.getQueuedFiles().length === 0) {
            Swal.fire('Atención', 'Agrega fotos primero', 'info');
            return;
        }
        Swal.fire({ title: 'Guardando...', didOpen: () => Swal.showLoading() });
        myDropzone.processQueue();
    });

    myDropzone.on("sending", (file, xhr, formData) => formData.append("guia", guiaHidden.value));
    myDropzone.on("queuecomplete", () => {
        Swal.fire('Éxito', 'Fotos guardadas', 'success').then(() => window.location.reload());
    });
});
</script>
@endsection