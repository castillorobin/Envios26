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
                        <table class="table text-nowrap mb-0" id="tabla-guias-dinamica">
                            <thead>
                                <tr>
                                    <th style="display: none;">Orden</th> <th style="width: 35%;">Guia</th>
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
                                    <div class="mb-3">
                                        <label for="metodo_pago" class="form-label">Metodo de pago</label>
                                        <select name="metodo_pago" id="metodo_pago" class="form-select">
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Transferencia bancaria">Transferencia bancaria</option>
                                            
                                        </select>
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
    // Variable para llevar el orden (un simple contador que aumenta)
    let contadorOrden = 0;

    const tableGuias = $('#tabla-guias-dinamica').DataTable({
        "paging": true,
        "pageLength": 5,
        "lengthChange": false,
        "searching": false,
        "info": true,
        // 1. Configuramos el orden inicial por la columna 0 (la oculta) de forma descendente
        "order": [[0, "desc"]], 
        "columnDefs": [
            { "targets": [0], "visible": false, "searchable": false } // Ocultar columna 0
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
        }
    });

    const btnAgregar = document.getElementById('btn-agregar');
    const inputGuia = document.getElementById('input-guia');
    const hiddenInputsContainer = document.getElementById('hidden-inputs');

    function agregarGuia() {
        const guiaValue = inputGuia.value.trim();
        if (guiaValue === "") return;

        // Validación de duplicados... (mismo código anterior)
        const guiasExistentes = Array.from(hiddenInputsContainer.querySelectorAll('input[name="guias[]"]'))
                                     .map(input => input.value);
        if (guiasExistentes.includes(guiaValue)) {
            Swal.fire({ icon: 'error', title: 'Duplicada', text: 'Esta guía ya está en la lista.' });
            inputGuia.value = "";
            return;
        }

        // Incrementamos el contador para que esta fila sea "mayor" que la anterior
        contadorOrden++;

        // 2. AGREGAR A DATATABLE
        // El primer valor es el contadorOrden para que al ordenar 'desc' quede arriba
        tableGuias.row.add([
            contadorOrden, 
            `<strong>${guiaValue}</strong>`,
            "{{ $comercio->nombre }}",
            "{{ date('d/m/Y') }}",
            `<span class="badge bg-success-subtle text-success">Recepcionado</span>`,
            `<button type="button" class="btn btn-sm btn-danger btn-eliminar" data-guia="${guiaValue}">
                <i class="bx bx-trash"></i>
            </button>`
        ]).draw(false);

        // 3. Forzamos a la tabla a mostrar la página 1 (donde estará el nuevo registro)
        tableGuias.page('first').draw(false);

        // Crear input oculto... (mismo código anterior)
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'guias[]';
        hiddenInput.value = guiaValue;
        hiddenInput.id = `input-hidden-${guiaValue}`;
        hiddenInputsContainer.appendChild(hiddenInput);

        inputGuia.value = "";
        inputGuia.focus();
    }

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

