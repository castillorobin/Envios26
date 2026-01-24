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
                    <h5 class="card-title">Editando Usuario de Comercio: {{ $usuario->nombre }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('comercios.updateuser', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                                    <div class="row">
                                      <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Email</label>
                                                            <input type="text" class="form-control" id="email" name="email" value="{{ $usuario->email }}" >
                                                        </div>
                                                    </div>
                                                    
                                                </div>              


                                                
                                                <div class="row">
                                                    
                                                    <div class="col-lg-6 mb-3">
                                <label class="form-label fw-bold">Nueva Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('password')">
                                        <i class="bx bx-show" id="icon-password"></i>
                                    </button>
                                </div>
                                
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label fw-bold">Confirmar Nueva Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Repita la nueva contraseña">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('password_confirmation')">
                                        <i class="bx bx-show" id="icon-password_confirmation"></i>
                                    </button>
                                </div>
                            </div>
                                                </div>
                
                </div>

                       

                        



                        <div class="d-flex justify-content-end gap-2 m-3">
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
function togglePass(id) {
    const input = document.getElementById(id);
    const icon = document.getElementById('icon-' + id);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace('bx-show', 'bx-hide');
    } else {
        input.type = "password";
        icon.classList.replace('bx-hide', 'bx-show');
    }
}
</script>

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