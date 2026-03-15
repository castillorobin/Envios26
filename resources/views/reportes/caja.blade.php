@extends('layouts.app')

@section('content')



<div class="container-xxl">
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Reporte de Caja</h4>
                               
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
                                                            <th class="border-0 py-2" style="width: 75%;">
                                                                Descripción
                                                            </th>
                                                            
                                                            <th class="text-end border-0 py-2" style="width: 25%;">
                                                                Total
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <!-- end thead -->
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                Ingreso por recepción
                                                            </td>
                                                            
                                                            <td class="text-end">
                                                                $721.77
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                               Pagos de remuneración
                                                            </td>
                                                            
                                                            <td class="text-end">
                                                                $679.95
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Entrega de paqueteria
                                                            </td>
                                                            
                                                            <td class="text-end">
                                                                $99.49
                                                            </td>
                                                        </tr>
                                                        <tr class="border-bottom">
                                                            <td>
                                                                Ingresos
                                                            </td>
                                                            
                                                            <td class="text-end">
                                                                700.38
                                                            </td>
                                                        </tr>
                                                        <tr class="border-bottom">
                                                            <td>
                                                                Gastos
                                                            </td>
                                                            
                                                            <td class="text-end">
                                                                700.38
                                                            </td>
                                                        </tr>
                                                        <tr class="border-bottom">
                                                            <td>
                                                                Transferencias recepcionadas
                                                            </td>
                                                            
                                                            <td class="text-end">
                                                                700.38
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
                                            <div class="clearfix pt-xl-3 pt-0">
                                                <div class="float-start" style="width: 220px; height: 100px; border: 1px solid #9e9d9d; padding: 10px;">
                                                    Saldo del receptor
                                                </div>
                                                <div class="float-start" style="width: 220px; height: 100px; border: 1px solid #9e9d9d; padding: 10px;">
                                                    Descuadre
                                                </div>
                                                <div class="float-start" style="width: 220px; height: 100px; border: 1px solid #9e9d9d; padding: 10px;">
                                                    Recibido por
                                                </div>

                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="float-end">
                                                <p>
                                                    <span class="fw-medium">Sub-total :</span>
                                                    <span class="float-end">$2266.59</span>
                                                </p>
                                                <p>
                                                    <span class="fw-medium">Descuento:</span>
                                                    <span class="float-end">
                                                        &nbsp;&nbsp;&nbsp;
                                                        $226.659</span>
                                                </p>
                                                <h3>$2039.931 USD</h3>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="mt-5 mb-1">
                                        <div class="text-end d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-primary">Print</a>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary">Submit</a>
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