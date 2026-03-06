@extends('layouts.app')

@section('content')


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


                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-xl-7">
                            <ul class="progressbar ps-0 my-4 pb-5">
                                <li class="active">Order Placed</li>
                                <li>Packed</li>
                                <li>Shipped</li>
                                <li>Delivered</li>
                            </ul>
                        </div>
                        <!-- end col -->
                    </div>
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
                                                <tr>
                                                    <td>Estado</td>
                                                    <td>{{ $orden->estado }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Fecha de entrega</td>
                                                    <td>{{ $orden->fecha_entrega }}</td>
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
                                  
                                    <h5 class="card-title mb-3">
                                        Fotos del paquete
                                    </h5>
                                    <p class="mb-1">
                                       <img src="https://techzaa.in/reback/admin/assets/images/products/product-1(3).png" alt="product-1(3)" class="img-fluid mx-auto d-block rounded" style="max-width: 200px;">
                                    </p>
                                    
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-lg-4">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    
                                    <h5 class="card-title mb-3">
                                        Fotos de cambio
                                    </h5>
                                    <div class="text-center">
                                       
                                        <p class="mb-1">
                                            <img src="https://techzaa.in/reback/admin/assets/images/products/product-1(3).png" alt="product-1(3)" class="img-fluid mx-auto d-block rounded" style="max-width: 200px;">
                                        </p>
                                       
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
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