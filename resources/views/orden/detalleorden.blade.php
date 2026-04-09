@extends('layouts.app')

@section('content')

<style>
    .img-container-cuadrado {
        width: 100px;
        height: 100px;
        overflow: hidden;
        display: inline-block;
        margin: 5px;
    }

    .img-zoom.cursor-pointer {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover; /* Esto hace que la imagen llene el cuadro sin deformarse */
        object-position: center;
        border-radius: 8px; /* Opcional: bordes redondeados para que se vea más moderno */
        transition: transform 0.2s;
    }

    .img-zoom.cursor-pointer:hover {
        transform: scale(1.05); /* Efecto visual al pasar el mouse */
    }
</style>

<div class="container-xxl">
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Detalles de la Orden</h4>
                              
                            </div>
                        </div>
                    </div>
                    <!-- ========== Page Title End ========== -->


                    
                    <!-- end row -->

                    <div class="row">

                        <div class="col-xl-7">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                        Datos del paquete GUIA: {{ $orden->guia }} 
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-centered table-dashed mb-0">
                                            
                                            <!-- end thead -->
                                            <tbody>
                                                <tr>
                                                    <td>Destinatario</td>
                                                    <td>{{ $orden->destinatario }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Destino</td>
                                                    <td>{{ $orden->destino }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Teléfono</td>
                                                    <td>{{ $orden->telefono }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Whatsapp</td>
                                                    <td>{{ $orden->whatsapp }}</td>
                                                </tr>
                                               
                                            </tbody>
                                            <!-- end tbody -->
                                        </table>
                                        <!-- end table -->
                                    </div>
                                    <!-- end table responsive -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-xl-5">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                        Detalles del comercio: {{ $orden->comercioRel->nombre }}
                                    </h5>
                                    <div class="table-responsive text-nowrap table-centered">
                                        <table class="table mb-0">
                                           
                                            <!-- end thead -->
                                            <tbody>
                                                <tr>
                                                    <td>Telefono</td>
                                                    <td>{{ $comercio->telefono }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Whatsapp</td>
                                                    <td>{{ $comercio->whatsapp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Correo</td>
                                                    <td>{{ $comercio->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Direccion</td>
                                                    <td>{{ $comercio->direccion }}</td>
                                                </tr>
                                                
                                               
                                            </tbody>
                                            <!-- end tbody -->
                                        </table>
                                        <!-- end table -->
                                    </div>
                                    <!-- end table responsive -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    
                                    <h5 class="card-title mb-3">
                                         Datos de pago
                                    </h5>
                                    
                                    <table class="table mb-0">
                                           
                                            <!-- end thead -->
                                            <tbody>
                                                <tr>
                                                    <td>Precio</td>
                                                    <td>{{ $orden->precio }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Envio</td>
                                                    <td>{{ $orden->envio }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td>{{ $orden->total }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Estado del cobro</td>
                                                    <td>{{ $orden->cobro }}</td>
                                                </tr>
                                                
                                               
                                            </tbody>
                                            <!-- end tbody -->
                                        </table>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-lg-4">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    
                                    
                                    
                                    <table class="table mb-0">
                                           
                                            <!-- end thead -->
                                            <tbody>
                                                <tr>
                                                    <td>Fecha de entrega</td>
                                                    <td>{{ $orden->fecha_entrega }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tipo de paquete</td>
                                                    <td>{{ $orden->tipo }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Estado del pago</td>
                                                    <td>{{ $orden->pago }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nota</td>
                                                    <td>{{ $orden->nota }}</td>
                                                </tr>
                                                
                                               
                                            </tbody>
                                            <!-- end tbody -->
                                        </table>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-lg-4">
                            <div class="card card-height-100">
                                <div class="card-body">
                               
                                    
                                    <table class="table mb-0">
                                           
                                            <!-- end thead -->
                                            <tbody>
                                                <tr>
                                                    <td>Agencia</td>
                                                    <td>{{ $orden->agencia }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Rack</td>
                                                    <td>{{ $orden->rack }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nivel</td>
                                                    <td>{{ $orden->nivel }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ubicación</td>
                                                    <td>{{ $orden->ubicacion }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Caja</td>
                                                    <td>{{ $orden->caja }}</td>
                                                </tr>
                                                
                                               
                                            </tbody>
                                            <!-- end tbody -->
                                        </table>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-lg-6">
                            <div class="card card-height-100">
                                <div class="card-body">
                                  
                                    <h5 class="card-title mb-3">
                                        Fotos del paquete
                                    </h5>
                                    <p class="mb-1 d-flex justify-content-around">
                                      <div class="row text-center">
                                            {{-- Foto 1 --}}
                                            @if($orden->foto1)
                                                <div class="col-auto mb-3">
                                                    <div class="img-container-cuadrado shadow-sm border rounded">
                                                        <img src="{{ asset('imgs/' . $orden->foto1) }}" class="img-zoom cursor-pointer" alt="Foto 1">
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Foto 2 --}}
                                            @if($orden->foto2)
                                                <div class="col-auto mb-3">
                                                    <div class="img-container-cuadrado shadow-sm border rounded">
                                                        <img src="{{ asset('imgs/' . $orden->foto2) }}" class="img-zoom cursor-pointer" alt="Foto 2">
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Foto 3 --}}
                                            @if($orden->foto3)
                                                <div class="col-auto mb-3">
                                                    <div class="img-container-cuadrado shadow-sm border rounded">
                                                        <img src="{{ asset('imgs/' . $orden->foto3) }}" class="img-zoom cursor-pointer" alt="Foto 3">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </p>
                                </div>

                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>

                         <div class="col-lg-6">
                            <div class="card card-height-100">
                                <div class="card-body"> 
                                  
                                    <h5 class="card-title mb-3">
                                        Fotos de cambio
                                    </h5>
                                    <p class="mb-1 d-flex justify-content-around">
                                        <div class="row text-center">
                                            {{-- Foto 1 --}}
                                            @if($orden->fotocambio1)
                                                <div class="col-md-4 mb-3">
                                                    <img src="{{ asset('imgs/' . $orden->foto1) }}" alt="Foto 1" class="img-fluid rounded border shadow-sm" style="max-width: 100px;">
                                                </div>
                                            @endif

                                            {{-- Foto 2 --}}
                                            @if($orden->fotocambio2)
                                                <div class="col-md-4 mb-3">
                                                    <img src="{{ asset('imgs/' . $orden->fotocambio2) }}" alt="Foto 2" class="img-fluid rounded border shadow-sm" style="max-width: 100px;">
                                                </div>
                                            @endif

                                            {{-- Foto 3 --}}
                                            @if($orden->fotocambio3)
                                                <div class="col-md-4 mb-3">
                                                    <img src="{{ asset('imgs/' . $orden->fotocambio3) }}" alt="Foto 3" class="img-fluid rounded border shadow-sm" style="max-width: 100px;">
                                                </div>
                                            @endif
                                        </div>
                                    </p>
                                    
                                </div>


                                
                                <!-- end card body -->
                            </div>

                            
                            <!-- end card -->
                        </div>



                        





                        
                        <!-- end col -->
                    </div>

                    <div class="row pt-3">
                        <div class="col-12">
                            <h5 class="card-title mb-3">Historial del paquete</h5>
                            @foreach($hestados as $hestado)
                                <div class="d-flex flex-row fs-18 align-items-center mb-3">
                                    <h5 class="mb-0"> {{ date('d/m/Y H:i', strtotime($hestado->created_at)) }}</h5>
                                </div>
                        
                            <ul class="list-unstyled left-timeline">
                                <li class="left-timeline-list">
                                    <div class="card d-inline-block">
                                        <div class="card-body">
                                            <h5 class="mt-0 fs-16">
                                                {{ $hestado->estado }}
                                            </h5>
                                            
                                            <p class="text-muted mb-0">
                                                {{ $hestado->nota }}
                                            </p>
                                            @if($hestado->estado == 'Fallido')
                                            <p class="text-muted mb-0">
                                              <strong>Motivo del fallo:</strong> {{ $hestado->motivofallo }}
                                            </p>
                                            @endif
                                            @if($hestado->estado == 'Reenvio')
                                            <p class="text-muted mb-0">
                                              <strong>Fecha de reenvio:</strong> {{ $orden->freenvio }} <br> <strong>Punto de reenvio:</strong> {{ $orden->preenvio }}
                                            </p>
                                            @endif

                                            @if($hestado->estado == 'Devolucion')
                                            <p class="text-muted mb-0">
                                              <strong>Fecha de devolución:</strong> {{ $orden->fdevolucion }} <br> <strong>Punto de devolución:</strong> {{ $orden->pdevolucion }}
                                            </p>
                                            @endif

                                            <p class="text-muted mb-0">
                                              <strong>Usuario:</strong> {{ $hestado->usuario }}
                                            </p>

                                            
                                        </div>
                                    </div>
                                </li>
                                
                            </ul>
                            @endforeach
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>




                <div class="modal fade" id="modalFotoGrande" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <img src="" id="imgGrande" class="img-fluid rounded shadow-lg">
            </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionamos todas las fotos que tengan la clase img-zoom
    const fotosZoom = document.querySelectorAll('.img-zoom');
    const modalImg = document.getElementById('imgGrande');
    const modalElement = new bootstrap.Modal(document.getElementById('modalFotoGrande'));

    fotosZoom.forEach(foto => {
        foto.addEventListener('click', function() {
            // Pasamos la ruta de la imagen pequeña al modal grande
            modalImg.src = this.src;
            // Abrimos el modal
            modalElement.show();
        });
    });
});
</script>

@endsection