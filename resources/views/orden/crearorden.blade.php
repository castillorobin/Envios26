@extends('layouts.app')

@section('content')


<div class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Crear Orden</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('comercios.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="input-group">
                                    <input type="text" name="guia" class="form-control" placeholder="Ingrese el numero de guia" required>
                                    <span class="input-group-text">
                                        <i class="bx bx-qr fs-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                            
                        </div>

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
                                <label class="form-label">Destinatario</label>
                                <input type="text" name="destinatario" class="form-control" placeholder="Ingrese el nombre del destinatario">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Tipo de paquete</label>
                                <select name="tipo_paquete" id="tipo_paquete" class="form-control">
                                    <option value="" disabled selected>Seleccione el tipo de paquete</option>
                                    <option value="Personalizado">Personalizado</option>
                                    <option value="Personalizado departamental">Personalizado departamental</option>
                                    <option value="Casillero">Casillero</option>
                                    <option value="Punto fijo">Punto fijo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Destinoo</label>
                                <input type="text" name="destino" class="form-control" placeholder="Ingrese el destino">
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
                                <label class="form-label">Fecha de entrega</label>
                                <input type="date" name="fecha_entrega" class="form-control" placeholder="Ingrese la fecha de entrega">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Total a cobrar</label>
                                <input type="text" name="total" class="form-control" placeholder="Ingrese el total a cobrar">
                            </div>
                            
                        </div>

                                            

                        



                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('comercios.inicio') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
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