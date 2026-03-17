@extends('layouts.app')

@section('content')



<div class="container-xxl">
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Reporte de Unidad</h4>
                               
                            </div>
                        </div>
                    </div>
                    <!-- ========== Page Title End ========== -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Logo & title -->
                                    <div class="clearfix">
                                        <div class="float-sm-end">
                                            <div class="auth-logo">
                                                <img class="logo-dark me-1" src="{{ asset('img/logomelonegro.png') }}" alt="logo-dark" width="150">                                            </div>
                                          
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            
                                            <h6 class="fs-16">Usuario: {{ Auth::user()->name }}</h6>
                                            <h6 class="fs-16">Fecha: {{ date('d-m-Y') }}</h6>
                                            <br>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive table-borderless text-nowrap mt-3 table-centered">
                                                <table class="table mb-0">
                                                    <thead class="bg-light bg-opacity-50">
                                                        <tr>
                                                            <th class="border-0 py-2" style="width: 60%;">
                                                                Descripción
                                                            </th>
                                                            <th class="text-end border-0 py-2" style="width: 20%;">
                                                                Cantidad
                                                            </th>
                                                            
                                                            <th class="text-end border-0 py-2" style="width: 20%;">
                                                                Total
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <!-- end thead -->
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                               Paquetes en ruta
                                                            </td>
                                                            <td class="text-end">
                                                                {{ $cantidadEntregadas }}
                                                            </td>
                                                            
                                                            <td class="text-end">
                                                                $ {{ $totalEntregadas }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                               No entregados
                                                            </td>
                                                            
                                                            <td class="text-end">
                                                                {{ $cantidadNoEntregadas }}
                                                            </td>
                                                            <td class="text-end">
                                                                $ {{ $totalNoEntregadas }}
                                                            </td>
                                                        </tr>
                                                        
                                                        
                                                    </tbody>
                                                    <!-- end tbody -->
                                                </table>


                                                <!-- end table -->
                                            </div>
                                            <!-- end table responsive -->
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row mt-3">
                                        <div class="col-sm-7">
                                           
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="float-end">
                                                <p>
                                                    <span class="fw-medium">Sub-total :</span>
                                                    <span class="float-end">$ {{ $totalEntregadas + $totalNoEntregadas }}</span>
                                                </p>
                                               
                                                <h3>$ {{ $totalEntregadas + $totalNoEntregadas }}</h3>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="mt-5 mb-1">
                                        <div class="text-end d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-primary">Imprimir</a>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary">Cerrar</a>
                                        </div>
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







@endsection