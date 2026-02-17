@extends('layouts.app')

@section('content')

<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">Cuadre de paquetería</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('cuadre.procesar_cuadre') }}" method="POST" id="form-busqueda">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Seleccionar Unidad</label>
                            <select name="unidad_id" id="unidad_select" class="form-select" required>
                                <option value="" disabled selected>Seleccione unidad</option>
                                @foreach($unidades as $unidad)
                                    <option value="{{ $unidad->id }}" data-nombre="{{ $unidad->nombre }}">
                                        {{ $unidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="contenedor-confirmacion" class="d-none">
                            <div class="alert alert-info border-0 shadow-sm">
                                <i class="bx bx-info-circle me-1"></i> 
                                Usted está procesando Cuadre de paquetería para unidad: 
                                <strong id="nombre-unidad-txt text-primary"></strong>.
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Continuar a Cuadre <i class="bx bx-right-arrow-alt ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectUnidad = document.getElementById('unidad_select');
    const contenedorConfirmacion = document.getElementById('contenedor-confirmacion');
    const txtNombreUnidad = document.getElementById('nombre-unidad-txt text-primary');

    selectUnidad.addEventListener('change', function() {
        if (this.value) {
            // Obtenemos el nombre desde el atributo data-nombre de la opción seleccionada
            const nombreSeleccionado = this.options[this.selectedIndex].getAttribute('data-nombre');
            
            // Inyectamos el nombre en el texto del alert
            txtNombreUnidad.innerText = nombreSeleccionado;
            
            // Mostramos el contenedor con el botón de continuar
            contenedorConfirmacion.classList.remove('d-none');
        } else {
            contenedorConfirmacion.classList.add('d-none');
        }
    });
});
</script>

@if(session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Atención!',
            text: "{{ session('error') }}",
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@endsection