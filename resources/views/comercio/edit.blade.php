@extends('layouts.app')

@section('content')

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Errores de validación',
                html: `<ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                       </ul>`,
                confirmButtonText: 'Corregir',
                customClass: {
                    confirmButton: 'btn btn-danger'
                }
            });
        });
    </script>
@endif
<div class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Editando Comercio: {{ $comercio->nombre }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('comercios.update', $comercio->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Comercio</label>
                                <input type="text" name="nombre" class="form-control" value="{{ $comercio->nombre }}" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Dirección de origen</label>
                                <input type="text" name="direccion" class="form-control" value="{{ $comercio->direccion }}" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Telefono</label>
                                <input type="text" name="telefono" class="form-control" value="{{ $comercio->telefono }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Whatsapp</label>
                                <input type="text" name="whatsapp" class="form-control" value="{{ $comercio->whatsapp }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $comercio->email }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" value="" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Fecha de incorporación</label>
                                <input type="text" name="fecha" class="form-control" value="{{ \Carbon\Carbon::parse($comercio->created_at)->format('d/m/Y') }}" readonly>
                            </div>
                              <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Cambiar Status</label><br>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="altaEdit" value="Alta" 
                                            {{ $comercio->status == 'Alta' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="altaEdit">Alta</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="bajaEdit" value="Baja" 
                                            {{ $comercio->status == 'Baja' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bajaEdit">Baja</label>
                                    </div>
                                                    </div>
                        </div>

                       

                        



                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('comercios.inicio') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Alerta de Éxito
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Logrado!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Aceptar',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
        @endif

        // Alerta de Error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonText: 'Cerrar',
                customClass: {
                    confirmButton: 'btn btn-danger'
                }
            });
        @endif
    });
</script>

@endsection