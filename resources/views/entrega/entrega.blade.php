@extends('layouts.app')

@section('content')
<style>
    /* Asegurar visibilidad en los contenedores del footer */
    #dt-info-container, #dt-pagination-container {
        min-height: 40px;
        display: flex;
        align-items: center;
    }

    /* Forzar que los controles de DataTables sean visibles siempre que se muevan aquí */
    #dt-pagination-container .dataTables_paginate,
    #dt-info-container .dataTables_info {
        display: block !important;
    }

    /* Ocultar los controles originales que quedan dentro del wrapper de la tabla */
    .dataTables_wrapper .dataTables_info, 
    .dataTables_wrapper .dataTables_paginate {
        display: none; 
    }
</style>
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Entrega de paquetes <strong></strong></h4>
            </div>
        </div>
    </div>
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <input type="text" id="input-guia" class="form-control" style="max-width: 300px;" placeholder="Ingresar guía" autofocus>
                                <button type="button" id="btn-agregar" class="btn btn-primary">Agregar</button>
                                <button type="button" id="btn-activar-qr" class="btn btn-outline-secondary">
                                    <i class="bx bx-qr-scan fs-4"></i>
                                </button>
                            </div>
                                <div id="reader-container" class="d-none mt-3 border rounded bg-light" style="max-width: 400px;">
                                    <div id="reader" style="width: 100%;"></div>
                                    <div class="p-2 text-center">
                                        <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger">
                                            Cerrar Cámara
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="table-responsive table-centered mt-3">
                        <table class="table text-nowrap mb-0" id="tabla-guias-dinamica">
                            <thead>
                                <tr>
                                    <th style="width: 35%;">Guia</th>
                                    <th>Comercio</th>
                                    <th>Destinatario</th>
                                    <th>Total a cobrar</th>
                                    <th>Fecha de entrega</th>
                                    <th>Status</th>
                                    <th style="width: 50px;">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-guias-body">
                                </tbody>
                        </table>
                    </div>
                </div><div class="card-footer bg-transparent border-top">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div id="dt-info-container"></div>
                <div id="dt-pagination-container"></div>
            </div>
        </div>
            </div>
        </div>

        <div class="col-xl-3">
            <form action="{{ route('entrega.guardar') }}" method="POST" >
                @csrf
           
                <div id="hidden-inputs"></div>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                                        <label for="usuari" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario" value="{{ Auth::user()->name }}" readonly>
                                    </div>
   
                                    <div class="mb-3">
                                        <label for="subtotal" class="form-label">Subtotal</label>
                                        <input type="number" class="form-control" id="subtotal" name="subtotal" placeholder="$ 0.00" readonly>
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

                                    <div class="mb-3">
                                        <label for="fecha_movimiento" class="form-label">Fecha del movimiento</label>
                                        <input type="text" class="form-control" id="fecha_movimiento" name="fecha_movimiento" value="{{ date('Y-m-d') }}" readonly>
                                    </div>


                                    <div class="d-flex justify-content-end align-items-center gap-3 mb-3">
                                        <label for="total" class="form-label mb-0">Total a cobrar</label>
                                        <input type="number" class="form-control" id="total" name="total" placeholder="$ 0.00" style="max-width: 100px;" readonly>
                                    </div>
                        <div class="row">
                            <div class="col-6">
                               <a href="#" class="btn btn-outline-primary w-100">
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



<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputGuia = document.getElementById('input-guia');
    const btnAgregar = document.getElementById('btn-agregar');
    const inputSubtotal = document.getElementById('subtotal');
    const inputDescuento = document.getElementById('descuento');
    const inputTotal = document.getElementById('total');
    const hiddenInputsContainer = document.getElementById('hidden-inputs');
    let html5QrCode;

    // 1. Inicializar DataTable
    var table = $('#tabla-guias-dinamica').DataTable({
        "dom": 'rtip',
        "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" }
    });

    // 2. Función para calcular totales
    function calcularTotales() {
    let subtotal = 0;
    // IMPORTANTE: El total a cobrar es el índice 3 en tu nueva estructura de tabla
    table.rows().every(function() {
        let data = this.data();
        let valor = parseFloat(data[3]) || 0; 
        subtotal += valor;
    });

    const descuento = parseFloat(inputDescuento.value) || 0;
    const total = subtotal - descuento;

    inputSubtotal.value = subtotal.toFixed(2);
    inputTotal.value = total.toFixed(2);
    
    actualizarInputsOcultos();
}

    // 3. Actualizar inputs ocultos para el envío del formulario
    function actualizarInputsOcultos() {
        hiddenInputsContainer.innerHTML = '';
        table.rows().every(function() {
            const data = this.data();
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'guias[]';
            input.value = data[0]; // El código de la guía
            hiddenInputsContainer.appendChild(input);
        });
    }

    // 4. Función para agregar Guía a la lista
    async function agregarGuia(codigo) {
        const guiaLimpia = codigo.trim();
        if (!guiaLimpia) return;

        // Verificar duplicados en la tabla
        let duplicado = false;
        table.rows().every(function() {
            if (this.data()[0] === guiaLimpia) duplicado = true;
        });

        if (duplicado) {
            Swal.fire('Atención', 'Esta guía ya está en la lista.', 'warning');
            inputGuia.value = '';
            return;
        }

        try {
            const response = await fetch(`{{ route('ordenes.buscar_guia_entrega') }}?guia=${guiaLimpia}`);
            const res = await response.json();

            if (res.success) {
                table.row.add([
                    res.data.guia,
                    res.data.comercio,
                    res.data.destinatario,
                    res.data.precio,
                    res.data.fecha,
                    `<span class="badge bg-soft-primary text-primary">${res.data.estado}</span>`,
                    `<div class="text-center">
                        <button type="button" class="btn btn-sm btn-soft-danger btn-eliminar">
                            <i class="bx bx-trash fs-16"></i>
                        </button>
                    </div>`
                ]).draw(false);

                inputGuia.value = '';
                inputGuia.focus();
                calcularTotales();
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
        }
    }

    // 5. Eventos
    btnAgregar.addEventListener('click', () => agregarGuia(inputGuia.value));
    
    inputGuia.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            agregarGuia(inputGuia.value);
        }
    });

    inputDescuento.addEventListener('input', calcularTotales);

    $('#tabla-guias-dinamica tbody').on('click', '.btn-eliminar', function() {
        table.row($(this).parents('tr')).remove().draw();
        calcularTotales();
    });

    // 6. Lógica QR
    document.getElementById('btn-activar-qr').addEventListener('click', function() {
        document.getElementById('reader-container').classList.remove('d-none');
        html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 15, qrbox: 250 },
            (text) => {
                agregarGuia(text);
                // Si quieres que se cierre solo tras leer uno, descomenta abajo:
                // btnCerrarCamara.click();
            }
        ).catch(err => console.error(err));
    });

    document.getElementById('btn-cerrar-camara').addEventListener('click', () => {
        if(html5QrCode) {
            html5QrCode.stop().then(() => {
                document.getElementById('reader-container').classList.add('d-none');
            });
        }
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ... tu código anterior ...

        // Detectar mensaje de éxito de Laravel y mostrar SweetAlert
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Operación Exitosa!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3e60d5',
                timer: 3000 // Se cierra solo tras 3 segundos si no le dan clic
            });
        @endif
    });
</script>

@endsection

