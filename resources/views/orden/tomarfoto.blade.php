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
                            
                            <form action="{{ route('ordenes.guardar_fotos') }}" method="post" class="dropzone" id="productImagesForm">
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
    // --- LÓGICA DE BÚSQUEDA ---
    const guiaInput = document.getElementById('guia_input');
    const btnBuscar = document.getElementById('btn-buscar-guia');
    const infoContainer = document.getElementById('info-guia-encontrada');
    const textoGuia = document.getElementById('texto-guia-confirmada');

    async function realizarBusqueda(codigo) {
        if (!codigo.trim()) return;
        try {
            const response = await fetch("{{ route('ordenes.buscar_ajax') }}?guia=" + encodeURIComponent(codigo));
            const data = await response.json();
            if (data.success) {
                infoContainer.classList.remove('d-none');
                textoGuia.innerText = data.guia;
                guiaInput.classList.add('is-valid');
            } else {
                Swal.fire('Error', data.message || 'Guía no encontrada', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Error de conexión', 'error');
        }
    }

    btnBuscar.addEventListener('click', () => realizarBusqueda(guiaInput.value));

    // --- LÓGICA DROPZONE ---
    Dropzone.autoDiscover = false;
    
    // Destruir instancia previa si existe para evitar errores
    if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());

    var myDropzone = new Dropzone("#productImagesForm", {
        url: "{{ route('ordenes.guardar_fotos') }}",
        paramName: "file",
        maxFiles: 3,
        maxFilesize: 2,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        autoProcessQueue: false,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
    });

    myDropzone.on("init", function() {
        console.log("Dropzone inicializado correctamente");
    });

    // Evento del botón Guardar (Dentro del DOMContentLoaded)
    document.getElementById('btn-finalizar-guardado').addEventListener("click", function(e) {
        console.log("Clic detectado en Guardar"); // VERIFICAR EN F12

        const guiaValue = guiaInput.value.trim();
        if (!guiaValue) {
            Swal.fire('Atención', 'Primero debes buscar una guía.', 'warning');
            return;
        }

        if (myDropzone.getQueuedFiles().length === 0) {
            Swal.fire('Atención', 'Agrega fotos antes de guardar.', 'info');
            return;
        }

        // Pasar datos y procesar
        document.getElementById('guia_hidden').value = guiaValue;
        myDropzone.options.params = { guia: guiaValue };
        myDropzone.processQueue();
    });

    myDropzone.on("sending", function(file, xhr, formData) {
        formData.append("guia", guiaInput.value.trim());
    });

    myDropzone.on("queuecomplete", function() {
        Swal.fire('¡Éxito!', 'Fotos guardadas correctamente', 'success').then(() => {
            window.location.reload();
        });
    });

    myDropzone.on("error", function(file, response) {
        console.error("Error subida:", response);
        myDropzone.removeFile(file);
    });
});
</script>
@endsection