@extends('layouts.app')

@section('content')


<div class="container-xxl">



                    <div class="row justify-content-center">
                        <div class="col-9">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold"></h4>
                                
                            </div>


                        </div>
                    </div>




    <div class="row justify-content-center">
                        
                       
                                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title mb-3">Pago de ticket: # {{ $ticket->codigo }}</h5>
                            <div class="d-flex flex-row fs-18 align-items-center mb-3">
                                <h5 class="mb-0">Datos</h5>
                            </div>
                            <ul class="list-unstyled left-timeline">
                                <li class="left-timeline-list">
                                    <div class="card d-inline-block">
                                        <div class="card-body">
                                            <h5 class="mt-0 fs-16">
                                               Comercio
                                            </h5>
                                            <p class="text-muted mb-0">
                                                
                                                {{ $ticket->datosComercio ? $ticket->datosComercio->nombre : 'Comercio no encontrado' }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="left-timeline-list">
                                    <div class="card d-inline-block">
                                        <div class="card-body">
                                            <h5 class="mt-0 fs-16">
                                               Estado del ticket
                                            </h5>
                                            <p class="text-muted mb-0">
                                                
                                                {{ $ticket->status }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="left-timeline-list">
                                    <div class="card d-inline-block">
                                        <div class="card-body">
                                            <h5 class="mt-0 fs-16">
                                               Fecha de verificación
                                            </h5>
                                            <p class="text-muted mb-0">
                                                
                                                {{ $ticket->updated_at ? $ticket->updated_at->format('d/m/Y H:i') : 'Sin fecha de verificación' }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="left-timeline-list">
                                    <div class="card d-inline-block">
                                        <div class="card-body">
                                            <h5 class="mt-0 fs-16">
                                               Usuario que verificó
                                            </h5>
                                            <p class="text-muted mb-0">
                                                
                                                {{ $ticket->usuario }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="left-timeline-list">
                                    <div class="card d-inline-block">
                                        <div class="card-body">
                                            <h5 class="mt-0 fs-16">
                                               Total a pagar
                                            </h5>
                                            <p class="text-muted mb-0">
                                                {{ '$ ' . number_format($subtotal, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                               
                            </ul>
                            <p></p>
                            @if($ticket->status === 'Revisado')
                                <button type="button" class="btn btn-primary" style="margin-top: 20px;" 
                                        data-bs-toggle="modal" data-bs-target="#modalConfirmarPago">
                                    <i class="bx bx-money me-1"></i> Pagar Ticket
                                </button>
                            @endif
                        </div>
                        <!-- end col -->
                    </div>
     </div>
                    


                        




</div>












<div class="modal fade" id="modalConfirmarPago" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title text-white"><i class="bx bx-check-shield me-1"></i> Confirmar Registro de Pago</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('reparto.guardar_registro') }}" method="POST">
                @csrf
                <input type="hidden" name="ids_ordenes" value="{{ json_encode($idsOrdenes) }}">
                <input type="hidden" name="recepcion_id" value="{{ $ticket->id }}">
                <input type="text" name="comercio" value="{{ $ticket->comercio }}" hidden>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Usuario</label>
                            <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha y Hora</label>
                            <input type="text" name="fecha_pago" class="form-control bg-light" value="{{ now()->format('d/m/Y H:i') }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subtotal (Órdenes Revisadas)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="subtotal" id="modal_subtotal" class="form-control fw-bold" value="{{ $subtotal }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-danger">Descuento</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="descuento" id="modal_descuento" class="form-control" value="0.00">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Nota de descuento</label>
                            <textarea name="nota_descuento" class="form-control" rows="2" placeholder="Motivo del descuento"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-success fw-bold">Total a Remunerar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-success text-white border-success">$</span>
                                <input type="number" step="0.01" name="total" id="modal_total_final" class="form-control form-control-lg border-success fw-bold text-success" value="{{ $subtotal }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado de Pago</label>
                            <input type="text" name="estado_pago" class="form-control bg-light fw-bold text-primary" value="Pagado" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success px-4">Registrar Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>





<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputDescuento = document.getElementById('modal_descuento');
    const inputSubtotal = document.getElementById('modal_subtotal');
    const inputTotalFinal = document.getElementById('modal_total_final');

    function calcularTotal() {
        const subtotal = parseFloat(inputSubtotal.value) || 0;
        const descuento = parseFloat(inputDescuento.value) || 0;
        const total = subtotal - descuento;
        
        // Evitar que el total sea negativo
        inputTotalFinal.value = total.toFixed(2);
    }

    inputDescuento.addEventListener('input', calcularTotal);
});
</script>


@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: '¡Atención!',
                text: "{{ session('error') }}",
                confirmButtonText: 'Aceptar',
                customClass: { confirmButton: 'btn btn-danger' }
            });
        });
    </script>
@endif

@endsection