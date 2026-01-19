@extends('layouts.app')

@section('content')
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
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Dirección de residencia</label>
                                <input type="text" name="address" class="form-control" value="{{ $usuario->address }}">
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
@endsection