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
                    <h5 class="card-title">Editando Usuario: {{ $usuario->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Nombre del usuario</label>
                                <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Nombre del empleado</label>
                                <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Apellido del empleado</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $usuario->last_name }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="phone" class="form-control" value="{{ $usuario->phone }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Whatsapp</label>
                                <input type="text" name="whatsapp" class="form-control" value="{{ $usuario->whatsapp }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">DUI</label>
                                <input type="text" name="dui" class="form-control" value="{{ $usuario->dui }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Rol</label>
                                <select name="rol" class="form-select">
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}" {{ $usuario->hasRole($role) ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Dirección de residencia</label>
                                <input type="text" name="address" class="form-control" value="{{ $usuario->address }}">
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Cambiar Status</label><br>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="altaEdit" value="Alta" 
                                            {{ $usuario->status == 'Alta' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="altaEdit">Alta</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="bajaEdit" value="Baja" 
                                            {{ $usuario->status == 'Baja' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bajaEdit">Baja</label>
                                    </div>
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



                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-secondary">Cerrar</a>
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