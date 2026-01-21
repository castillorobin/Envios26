@extends('layouts.app')

@section('content')


<div class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Crear Comercio</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('comercios.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Comercio</label>
                                <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del comercio" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Dirección de origen</label>
                                <input type="text" name="direccion" class="form-control" placeholder="Ingrese la dirección de origen" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Telefono</label>
                                <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Whatsapp</label>
                                <input type="text" name="whatsapp" class="form-control" placeholder="Ingrese el Whatsapp">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Ingrese el email">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" placeholder="Ingrese la contraseña">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Fecha de incorporación</label>
                                <input type="text" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                              <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label><br>
                                                            
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status" id="altaStatus" value="Alta" 
                                                                     >
                                                                <label class="form-check-label" for="altaStatus">Alta</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status" id="bajaStatus" value="Baja" 
                                                                     >
                                                                <label class="form-check-label" for="bajaStatus">Baja</label>
                                                            </div>
                                                        </div>
                                                    </div>
                        </div>

                       

                        



                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('comercios.inicio') }}" class="btn btn-secondary">Cerrar</a>
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