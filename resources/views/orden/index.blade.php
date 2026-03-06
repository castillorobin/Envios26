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
</style>

<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">Búsqueda por comercio</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('ordenes.busqueda_comercio') }}" method="POST" id="form-busqueda">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Seleccionar Comercio</label>
                            <div class="input-group">
                                <select name="comercio" class="form-select select2" required>
                                    <option value="" disabled selected>Seleccione un comercio</option>
                                    @foreach($comercios as $comercio)
                                        <option value="{{ $comercio->id }}">{{ $comercio->nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-search-alt"></i> Buscar
                                </button>
                            </div>
                        </div>
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
            placeholder: "Escriba el nombre del comercio...",
            allowClear: true,
            width: 'resolve' // Ayuda a que herede el ancho del contenedor
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