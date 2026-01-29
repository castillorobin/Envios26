@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Recepción de paquetes de: <strong>{{ $comercio->nombre }}</strong></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <input type="text" id="input-guia" class="form-control" style="max-width: 300px;" placeholder="Ingresar guía" autofocus>
                                <button type="button" id="btn-agregar" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-centered mt-3">
                        <table class="table text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Guia</th>
                                    <th>Comercio</th>
                                    <th>Fecha de recepcion</th>
                                    <th>Status</th>
                                    <th style="width: 50px;">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-guias-body">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <form action="{{ route('recepcion.guardar') }}" method="POST">
                @csrf
                <input type="hidden" name="comercio_id" value="{{ $comercio->id }}">
                <div id="hidden-inputs"></div>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                                        <label for="usuari" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario" value="{{ Auth::user()->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtotal" class="form-label">Subtotal</label>
                                        <input type="number" class="form-control" id="subtotal" name="subtotal" placeholder="$ 0.00">
                                    </div>

                                    <div class="mb-3">
                                        <label for="descuento" class="form-label">Descuento</label>
                                        <input type="number" class="form-control" id="descuento" name="descuento" placeholder="$ 0.00">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nota" class="form-label">Nota</label>
                                        <input type="text" class="form-control" id="nota" name="nota" placeholder="Ingrese una nota de descuento">
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center gap-3 mb-3">
                                        <label for="total" class="form-label mb-0">Total a cobrar</label>
                                        <input type="number" class="form-control" id="total" name="total" placeholder="$ 0.00" style="max-width: 100px;" readonly>
                                    </div>
                        <div class="row">
                            <div class="col-6">
                               <a href="{{ route('recepcion.crearrecepcion', ['comercio_id' => $comercio->id]) }}" class="btn btn-outline-primary w-100">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnAgregar = document.getElementById('btn-agregar');
    const inputGuia = document.getElementById('input-guia');
    const tablaBody = document.getElementById('tabla-guias-body');
    const hiddenInputsContainer = document.getElementById('hidden-inputs');

    // Datos estáticos que vienen de PHP
    const nombreComercio = "{{ $comercio->nombre }}";
    const fechaHoy = "{{ date('d/m/Y') }}"; 

    function agregarGuia() {
        const guiaValue = inputGuia.value.trim();

        // 1. Validación de campo vacío
        if (guiaValue === "") {
            Swal.fire({ icon: 'warning', title: 'Campo vacío', text: 'Por favor ingrese un código de guía' });
            return;
        }

        // 2. VALIDACIÓN DE DUPLICADOS
        // Buscamos si ya existe un input oculto con ese mismo valor de guía
        const guiasExistentes = Array.from(hiddenInputsContainer.querySelectorAll('input[name="guias[]"]'))
                                     .map(input => input.value);

        if (guiasExistentes.includes(guiaValue)) {
            Swal.fire({ 
                icon: 'error', 
                title: 'Guía Duplicada', 
                text: `La guía ${guiaValue} ya ha sido agregada a la lista actual.` 
            });
            inputGuia.value = "";
            inputGuia.focus();
            return;
        }

        // 3. Crear la fila para la tabla si pasa las validaciones
        const tr = document.createElement('tr');
        tr.setAttribute('data-guia', guiaValue); // Atributo extra para facilitar eliminación
        tr.innerHTML = `
            <td><strong>${guiaValue}</strong></td>
            <td>${nombreComercio}</td>
            <td>${fechaHoy}</td>
            <td><span class="badge bg-success-subtle text-success">Recepcionado</span></td>
            <td>
                <button type="button" class="btn btn-sm btn-danger btn-eliminar">
                    <i class="bx bx-trash"></i>
                </button>
            </td>
        `;

        tablaBody.appendChild(tr);

        // 4. Crear el input oculto para el envío del formulario
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'guias[]';
        hiddenInput.value = guiaValue;
        hiddenInput.id = `input-hidden-${guiaValue}`; // ID único para borrarlo después
        hiddenInputsContainer.appendChild(hiddenInput);

        // Limpiar input y dar foco
        inputGuia.value = "";
        inputGuia.focus();
    }

    // Eventos de teclado y click
    btnAgregar.addEventListener('click', agregarGuia);
    inputGuia.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            agregarGuia();
        }
    });

    // Delegación de eventos para eliminar fila e input oculto
    tablaBody.addEventListener('click', function(e) {
        if (e.target.closest('.btn-eliminar')) {
            const row = e.target.closest('tr');
            const guiaABorrar = row.getAttribute('data-guia');
            
            // Borrar la fila visual
            row.remove();
            
            // Borrar el input oculto correspondiente para que no se envíe al servidor
            const inputOculto = document.getElementById(`input-hidden-${guiaABorrar}`);
            if (inputOculto) {
                inputOculto.remove();
            }
        }
    });
    // --- Lógica de cálculos financieros ---
const inputSubtotal = document.getElementById('subtotal');
const inputDescuento = document.getElementById('descuento');
const inputTotal = document.getElementById('total');

function calcularTotal() {
    // Obtenemos los valores, si están vacíos o no son números usamos 0
    const subtotal = parseFloat(inputSubtotal.value) || 0;
    const descuento = parseFloat(inputDescuento.value) || 0;

    // Calculamos la diferencia
    const resultado = subtotal - descuento;

    // Asignamos el valor al input total (formateado a 2 decimales)
    inputTotal.value = resultado.toFixed(2);
    
    // Opcional: Cambiar el color si el total es negativo por error
    if (resultado < 0) {
        inputTotal.classList.add('text-danger');
    } else {
        inputTotal.classList.remove('text-danger');
    }
}

// Escuchamos el evento 'input' para que el cálculo sea en tiempo real mientras escriben
inputSubtotal.addEventListener('input', calcularTotal);
inputDescuento.addEventListener('input', calcularTotal);
});
</script>


@endsection

