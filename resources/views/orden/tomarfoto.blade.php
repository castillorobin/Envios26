@extends('layouts.app')

@section('content')

<style>
    /* Evita que el área de Dropzone tape los botones */
    .dropzone {
        min-height: 150px;
        border: 2px dashed #ced4da;
        background: white;
        border-radius: 6px;
    }
    .buttons-container {
        position: relative;
        z-index: 1000; /* Asegura que el botón esté sobre cualquier capa */
    }
    .dropzone.disabled {
        opacity: 0.5;
        pointer-events: none; /* Evita clics */
        background-color: #f8f9fa;
        cursor: not-allowed;
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
                                <i class="bx bx-images me-1"></i> Toma de fotografia
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

                            <div class="d-flex flex-wrap gap-2 justify-content-end mt-3 buttons-container">
                                <a href="/ordenes/toma-foto" class="btn btn-secondary">
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
    // --- REFERENCIAS DE ELEMENTOS ---
    const guiaInput = document.getElementById('guia_input');
    const btnBuscar = document.getElementById('btn-buscar-guia');
    const infoContainer = document.getElementById('info-guia-encontrada');
    const textoGuia = document.getElementById('texto-guia-confirmada');
    const dropzoneElement = document.getElementById('productImagesForm');
    const guiaHidden = document.getElementById('guia_hidden');
    const btnGuardar = document.getElementById('btn-finalizar-guardado');

    // --- LÓGICA DE BÚSQUEDA AJAX ---
    async function realizarBusqueda(codigo) {
        const query = codigo.trim();
        if (!query) {
            Swal.fire('Atención', 'Por favor ingresa un código de guía.', 'warning');
            return;
        }

        try {
            // Bloqueamos el botón de búsqueda mientras consulta
            btnBuscar.disabled = true;
            
            const response = await fetch("{{ route('ordenes.buscar_ajax') }}?guia=" + encodeURIComponent(query));
            const data = await response.json();

            if (data.success) {
                // 1. Mostrar confirmación visual
                infoContainer.classList.remove('d-none');
                textoGuia.innerText = data.guia;
                guiaInput.classList.add('is-valid');
                guiaInput.classList.remove('is-invalid');
                
                // 2. DESBLOQUEAR DROPZONE
                dropzoneElement.classList.remove('disabled');
                guiaHidden.value = data.guia; // Asignamos el valor al input oculto

                // 3. Notificación rápida
                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                }).fire({
                    icon: 'success',
                    title: 'Guía validada correctamente'
                });

            } else {
                // Si la guía no existe, volvemos a bloquear
                bloquearDropzone();
                Swal.fire('No encontrado', data.message || 'La guía no existe en el sistema.', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Hubo un problema de conexión con el servidor.', 'error');
        } finally {
            btnBuscar.disabled = false;
        }
    }

    function bloquearDropzone() {
        dropzoneElement.classList.add('disabled');
        infoContainer.classList.add('d-none');
        guiaInput.classList.remove('is-valid');
        guiaInput.classList.add('is-invalid');
        guiaHidden.value = '';
        if (myDropzone) myDropzone.removeAllFiles(true); // Limpiar fotos si ya había
    }

    // Eventos de búsqueda
    btnBuscar.addEventListener('click', () => realizarBusqueda(guiaInput.value));
    
    guiaInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            realizarBusqueda(this.value);
        }
    });

    // --- CONFIGURACIÓN DE DROPZONE ---
    Dropzone.autoDiscover = false;
    
    // Evitar duplicados de instancia
    if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());

    var myDropzone = new Dropzone("#productImagesForm", {
        url: "{{ route('ordenes.guardar_fotos') }}",
        paramName: "file",
        maxFiles: 3,
        maxFilesize: 2, // MB
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        autoProcessQueue: false, // Importante: no subir hasta dar clic en Guardar
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        dictRemoveFile: "Quitar",
        dictMaxFilesExceeded: "Solo puedes subir hasta 3 fotos."
    });

    // --- ACCIÓN DE GUARDADO ---
    btnGuardar.addEventListener("click", function(e) {
        const guiaVal = guiaHidden.value;

        if (!guiaVal) {
            Swal.fire('Atención', 'Primero debes validar una guía válida.', 'warning');
            return;
        }

        if (myDropzone.getQueuedFiles().length === 0) {
            Swal.fire('Sin fotos', 'Por favor, agrega al menos una fotografía.', 'info');
            return;
        }

        // Mostrar cargando
        Swal.fire({
            title: 'Subiendo fotos...',
            text: 'Por favor espera',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        myDropzone.processQueue();
    });

    // Enviar la guía junto con cada archivo
    myDropzone.on("sending", function(file, xhr, formData) {
        formData.append("guia", guiaHidden.value);
    });

    // Éxito al terminar toda la cola
    myDropzone.on("queuecomplete", function() {
        Swal.fire({
            icon: 'success',
            title: '¡Completado!',
            text: 'Las fotografías han sido vinculadas a la guía.',
            confirmButtonColor: '#3e60d5'
        }).then(() => {
            window.location.reload();
        });
    });

    myDropzone.on("error", function(file, response) {
        Swal.fire('Error', 'No se pudo subir una de las imágenes.', 'error');
        myDropzone.removeFile(file);
    });
});
</script>
@endsection