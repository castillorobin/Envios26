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
                            <h5 class="card-title mb-3">Pago de ticket: # {{ $ticket->id }}</h5>
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
                                               Total a pagar
                                            </h5>
                                            <p class="text-muted mb-0">
                                                {{ $ticket->total }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                               
                            </ul>
                            <p></p>
                            <button class="btn btn-primary" onclick="window.location.href='/reparto/pagoticket?caja={{ $ticket->id }}'" style="margin-top: 20px;">Pagar Ticket</button>
                        </div>
                        <!-- end col -->
                    </div>
     </div>
                    


                        




</div>





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