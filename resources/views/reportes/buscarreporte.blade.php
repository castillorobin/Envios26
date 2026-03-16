@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Ajuste para que Select2 combine con Bootstrap 5 */
    .select2-container--default .select2-selection--single {
        height: 38px !important;
        border: 1px solid #dee2e6 !important;
        display: flex;
        align-items: center;
    }
    .select2-container {
        flex: 1 1 auto !important; /* Permite que el select ocupe el espacio en el input-group */
        width: auto !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
/* Esto asegura que Select2 responda al flex-grow-1 del padre */
.select2-container {
    width: 100% !important;
}

/* Evita que el botón se vea muy pequeño o pegado en resoluciones altas */
@media (min-width: 768px) {
    .w-md-auto {
        width: auto !important;
        white-space: nowrap; /* Evita que el texto del botón se rompa en dos líneas */
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
}
</style>

<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">Seleccionar</h5>
                </div>
                <div class="card-body">
    <form action="{{ route('ordenes.busqueda_comercio') }}" method="POST" id="form-busqueda">
        @csrf
       

        <div class="mb-3">
        <div class=" w-100">
                    <select name="repartidor" class="form-select select2" required>
                        <option value="" disabled selected>Seleccione un repartidor</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
        </div>

        <div class="mb-3">
             <div class="w-100">
                    <select name="unidad" class="form-select " required>
                        <option value="" disabled selected>Seleccione una unidad</option>
                        @foreach($unidades as $unidad)
                            <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
        </div>


        <div class="mb-3">
            <div class="w-100">
                    <input type="date" name="fecha" class="form-control">
                </div>
        </div>




       



                <button type="submit" class="btn btn-primary w-100 w-md-auto py-2">
                    <i class="bx bx-search-alt"></i> Buscar
                </button>


    </form>
</div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione el nombre del repartidor...",
            allowClear: true,
            width: '100%' // Ayuda a que herede el ancho del contenedor
        });
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