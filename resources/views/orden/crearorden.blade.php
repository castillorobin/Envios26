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
                    <form action="{{ route('ordenes.guardar') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                
                                    <label class="form-label">Guía</label>
                                    <input type="text" name="guia" class="form-control" 
       value="{{ $guiaact }}" readonly>
                                
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Comercio</label>
                                <input type="text" name="comercio" class="form-control" 
       value="{{ $comercio->nombre }}" readonly>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Dirección de origen</label>
                                <input type="text" name="direccion" class="form-control" 
       value="{{ $comercio->direccion }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Destinatario</label>
                                <input type="text" name="destinatario" class="form-control" placeholder="Ingrese el nombre del destinatario" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Tipo de paquete</label>
                                <select name="tipo" id="tipo" class="form-control" required>
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
                                <input type="text" name="destino" id="input_destino" class="form-control" placeholder="Ingrese la dirección exacta" >
                            </div>

                            <div class="col-lg-12 mb-3 d-none" id="contenedor_puntos">
                                <label class="form-label" id="label_punto">Seleccionar Ubicación</label>
                                <select name="destino" id="select_puntos" class="form-control">
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    @foreach($puntos as $punto)
                                        <option value="{{ $punto->nombre }}" data-tipo="{{ $punto->tipo }}">
                                            {{ $punto->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Telefono</label>
                                <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Whatsapp</label>
                                <input type="text" name="whatsapp" class="form-control" placeholder="Ingrese el Whatsapp">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Fecha de entrega</label>
                               <!-- <input type="text" name="fecha_entrega" class="form-control" placeholder="Ingrese la fecha de entrega">-->
                                <input type="text" id="humanfd-datepicker" name="fecha_entrega" class="form-control" placeholder="{{ today()->format('F j, Y') }}" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Cobro del envío</label>
                                <select name="cobro_envio" id="cobro_envio" class="form-control">
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="Cobrado">Cobrado</option>
                                    <option value="Por cobrar">Por cobrar</option>
                                </select>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Estado del pago</label>
                                <select name="estado_pago" id="estado_pago" class="form-control">
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="Por pagar">Por pagar</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Precio del paquete</label>
                                <input type="text" name="precio_paquete" class="form-control" placeholder="Ingrese el precio del paquete">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Precio del envío</label>
                                <input type="text" name="precio_envio" class="form-control" placeholder="Ingrese el precio del envío">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Total a remunerar</label>
                                <input type="text" name="total" class="form-control" placeholder="0.00" readonly>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Nota</label>
                                <input type="text" name="nota" class="form-control" placeholder="Ingrese la nota">
                            </div>
                        </div>


                                            

                        



                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('ordenes.inicio') }}" class="btn btn-secondary"> <i class="bx bx-x me-1"></i> Cancelar</a>
                            <button type="submit" name="accion" value="guardar" class="btn btn-primary"><i class="bx bx-save me-1"></i>Guardar</button>
                            <button type="submit" name="accion" value="imprimir" class="btn btn-success" onclick="this.form.target='_blank'; setTimeout(() => { window.location.href='{{ route('ordenes.buscar') }}'; }, 1000);">
                                <i class="bx bx-printer me-1"></i> Guardar e Imprimir
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Escanear Código QR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="reader" style="width: 100%;"></div>
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
            //inputDestino.required = true;
           // selectPuntos.required = false;
            selectPuntos.value = ""; 
        } 
        else if (valor === 'Punto fijo' || valor === 'Casillero') {
            // Mostrar Puntos, Ocultar Dirección
            contenedorDireccion.classList.add('d-none');
            contenedorPuntos.classList.remove('d-none');
           // inputDestino.required = false;
            inputDestino.value = "";
         //   selectPuntos.required = true;

            // Determinar qué tipo de punto filtrar
            // Si el paquete es 'Punto fijo' busca tipo 'Punto'
            // Si el paquete es 'Casillero' busca tipo 'Agencia'
            const tipoABuscar = (valor === 'Punto fijo') ? 'Punto fijo' : 'Agencia';
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

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputGuia = document.getElementById('input_guia_id');
    const inputComercio = document.getElementById('comercio');
    const inputDireccionOrigen = document.querySelector('input[name="direccion"]');
    const btnQr = document.getElementById('btn-scan-qr');
    const qrModalElement = document.getElementById('qrModal');
    const qrModal = new bootstrap.Modal(qrModalElement);
    let html5QrCode;

    // --- FUNCIÓN PARA BUSCAR LA GUÍA ---
    async function buscarDatosGuia(codigo) {
        const guiaLimpia = codigo.trim();
        if (!guiaLimpia) return;
        
        try {
            const response = await fetch(`/api/buscar-guia/${guiaLimpia}`);
            const data = await response.json();

            if (data.success) {
                inputComercio.value = data.comercio;
                inputDireccionOrigen.value = data.direccion;
                inputComercio.style.backgroundColor = "#e9ecef";
                
                Swal.fire({
                    icon: 'success',
                    title: 'Guía encontrada',
                    text: `Comercio: ${data.comercio}`,
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No encontrado',
                    text: 'La guía no existe en el sistema.'
                });
            }
        } catch (error) {
            console.error("Error en la búsqueda:", error);
        }
    }

    // --- PREVENIR ENVÍO POR ENTER ---
    inputGuia.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Detiene el envío del formulario
            buscarDatosGuia(this.value);
            return false;
        }
    });

    // --- EVENTO AL PERDER EL FOCO ---
    inputGuia.addEventListener('blur', function() {
        buscarDatosGuia(this.value);
    });

    // --- LÓGICA DEL SCANNER QR ---
    btnQr.addEventListener('click', function() {
        qrModal.show();
        html5QrCode = new Html5Qrcode("reader");
        
        const qrConfig = { fps: 10, qrbox: { width: 250, height: 250 } };

        html5QrCode.start(
            { facingMode: "environment" }, 
            qrConfig,
            (decodedText) => {
                inputGuia.value = decodedText;
                buscarDatosGuia(decodedText);
                cerrarScanner();
                qrModal.hide();
            }
        ).catch(err => {
            console.error("Error cámara:", err);
            Swal.fire('Error', 'No se pudo acceder a la cámara', 'error');
        });
    });

    function cerrarScanner() {
        if (html5QrCode && html5QrCode.isScanning) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
            }).catch(err => console.error("Error al detener:", err));
        }
    }

    // Detener cámara al cerrar el modal
    qrModalElement.addEventListener('hidden.bs.modal', cerrarScanner);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Referencias
    const selectTipo = document.getElementById('tipo');
    const selectCobroEnvio = document.getElementById('cobro_envio');
    const inputPrecioPaquete = document.querySelector('input[name="precio_paquete"]');
    const inputPrecioEnvio = document.querySelector('input[name="precio_envio"]');
    const inputTotalRemunerar = document.querySelector('input[name="total"]');

    // 1. Automatización: Tipo de Paquete -> Cobro del Envío
    selectTipo.addEventListener('change', function() {
        if (this.value === 'Personalizado') {
            selectCobroEnvio.value = 'Por cobrar';
        } else {
            selectCobroEnvio.value = 'Cobrado';
        }
        // Ejecutar cálculo inmediatamente al cambiar el tipo
        calcularRemuneracion();
    });

    // 2. Función de Cálculo según la regla de negocio
    function calcularRemuneracion() {
        const modoCobro = selectCobroEnvio.value;
        const precioPaquete = parseFloat(inputPrecioPaquete.value) || 0;
        const precioEnvio = parseFloat(inputPrecioEnvio.value) || 0;
        let totalCalculado = 0;

        if (modoCobro === 'Por cobrar') {
            // Regla: Precio Paquete + Precio Envío
            totalCalculado = precioPaquete - precioEnvio;
        } else if (modoCobro === 'Cobrado') {
            // Regla: Solo Precio Paquete
            totalCalculado = precioPaquete;
        }

        // Asignar al input total con 2 decimales
        inputTotalRemunerar.value = totalCalculado.toFixed(2);
    }

    // 3. Listeners para actualización en tiempo real
    inputPrecioPaquete.addEventListener('input', calcularRemuneracion);
    inputPrecioEnvio.addEventListener('input', calcularRemuneracion);
    selectCobroEnvio.addEventListener('change', calcularRemuneracion);
});
</script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
<script>
    document.getElementById('humanfd-datepicker').flatpickr({
        locale: "es", // <--- Esto activa el idioma español
        altInput: true,
        altFormat: "F j, Y", // Se verá como: "Febrero 3, 2026"
        dateFormat: "Y-m-d", // Formato interno para la Base de Datos (Recomendado Y-m-d)
        minDate: "today",    // Opcional: Evita seleccionar fechas pasadas
        defaultDate: "today",
    });
</script>

@endsection