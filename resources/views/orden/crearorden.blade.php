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
                    <h5 class="card-title">Crear Orden</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('ordenes.store') }}" method="POST">
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
                                <select name="comercio" id="comercio" class="form-control">
                                    <option value="" disabled selected>Seleccione un comercio</option>
                                    @foreach($comercios as $comercio)
                                        <option value="{{ $comercio->nombre }}">{{ $comercio->nombre }}</option>
                                    @endforeach
                                </select>
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
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="" disabled selected>Seleccione el tipo de paquete</option>
                                    <option value="Personalizado">Personalizado</option>
                                    <option value="Personalizado departamental">Personalizado departamental</option>
                                    <option value="Casillero">Casillero</option>
                                    <option value="Punto fijo">Punto fijo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mb-3" id="contenedor_direccion">
                                <label class="form-label">Dirección de Destino</label>
                                <input type="text" name="destino" id="input_destino" class="form-control" placeholder="Ingrese la dirección exacta">
                            </div>

                            <div class="col-lg-12 mb-3 d-none" id="contenedor_puntos">
                                <label class="form-label" id="label_punto">Seleccionar Ubicación</label>
                                <select name="destino" id="select_puntos" class="form-control">
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    @foreach($puntos as $punto)
                                        <option value="{{ $punto->id }}" data-tipo="{{ $punto->tipo }}">
                                            {{ $punto->nombre }}
                                        </option>
                                    @endforeach
                                </select>
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

                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Nota</label>
                                <input type="text" name="nota" class="form-control" placeholder="Ingrese la nota">
                            </div>
                        </div>


                                            

                        



                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('ordenes.inicio') }}" class="btn btn-secondary">Cancelar</a>
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



    document.addEventListener('DOMContentLoaded', function() {
    const selectTipoPaquete = document.getElementById('tipo');
    const contenedorDireccion = document.getElementById('contenedor_direccion');
    const contenedorPuntos = document.getElementById('contenedor_puntos');
    const inputDestino = document.getElementById('input_destino');
    const selectPuntos = document.getElementById('select_puntos');
    const labelPunto = document.getElementById('label_punto');

    // Guardamos todas las opciones originales de puntos para filtrar luego
    const opcionesPuntosOriginales = Array.from(selectPuntos.options);

    selectTipoPaquete.addEventListener('change', function() {
        const valor = this.value;

        if (valor === 'Personalizado' || valor === 'Personalizado departamental') {
            // Mostrar Dirección, Ocultar Puntos
            contenedorDireccion.classList.remove('d-none');
            contenedorPuntos.classList.add('d-none');
            inputDestino.required = true;
            selectPuntos.required = false;
            selectPuntos.value = ""; 
        } 
        else if (valor === 'Punto fijo' || valor === 'Casillero') {
            // Mostrar Puntos, Ocultar Dirección
            contenedorDireccion.classList.add('d-none');
            contenedorPuntos.classList.remove('d-none');
            inputDestino.required = false;
            inputDestino.value = "";
            selectPuntos.required = true;

            // Determinar qué tipo de punto filtrar
            // Si el paquete es 'Punto fijo' busca tipo 'Punto'
            // Si el paquete es 'Casillero' busca tipo 'Agencia'
            const tipoABuscar = (valor === 'Punto fijo') ? 'Punto' : 'Agencia';
            labelPunto.textContent = (valor === 'Punto fijo') ? 'Seleccionar Punto Fijo' : 'Seleccionar Agencia/Casillero';

            // Filtrar las opciones del select
            filtrarPuntos(tipoABuscar);
        }
    });

    function filtrarPuntos(tipo) {
        // Limpiamos el select
        selectPuntos.innerHTML = '<option value="" disabled selected>Seleccione una opción</option>';
        
        // Agregamos solo las que coinciden con el tipo
        opcionesPuntosOriginales.forEach(option => {
            if (option.getAttribute('data-tipo') === tipo) {
                selectPuntos.appendChild(option.cloneNode(true));
            }
        });
    }
});
</script>

@endsection