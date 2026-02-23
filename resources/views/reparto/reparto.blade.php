@extends('layouts.app')

@section('content')






<div class="container-xxl">
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Reparto Unidad # <span class="text-primary">{{ $unidad->nombre ?? 'Sin Unidad' }}</span></h4>
                            
                            </div>
                        </div>
                    </div>
                    <!-- ========== Page Title End ========== -->


                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="text-primary fw-bold">{{ $totales->total }}</h3>
                                            <p class="badge bg-primary-subtle text-primary">
                                                Total de paquetes
                                            </p>
                                            
                                        </div>
                                        <div>
                                            <div class="avatar-lg d-inline-block me-1">
                                                <span class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <iconify-icon icon="iconamoon:box-bold" class="fs-32"><template shadowrootmode="open"><style data-style="data-style">:host{display:inline-block;vertical-align:0}span,svg{display:block}</style><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from IconaMoon by Dariush Habibpour - https://creativecommons.org/licenses/by/4.0/ --><path fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 8h16v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm4-4h8l4 4H4zm0 8h4"/></svg></template></iconify-icon>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="text-success fw-bold">{{ $totales->entregados }}</h3>
                                            <p class="badge bg-success-subtle text-success">
                                                Total de Entregados
                                            </p>
                                            
                                        </div>
                                        <div>
                                            <div class="avatar-lg d-inline-block me-1">
                                                <span class="avatar-title bg-success-subtle text-success rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-bold" class="fs-32"><template shadowrootmode="open"><style data-style="data-style">:host{display:inline-block;vertical-align:0}span,svg{display:block}</style><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from IconaMoon by Dariush Habibpour - https://creativecommons.org/licenses/by/4.0/ --><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7L10 17l-5-5"/></svg></template></iconify-icon>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="text-danger fw-bold">{{ $totales->no_entregados }}</h3>
                                            <p class="badge bg-danger-subtle text-danger">
                                                Total de No Entregados
                                            </p>
                                            
                                        </div>
                                        <div>
                                            <div class="avatar-lg d-inline-block me-1">
                                                <span class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                    <iconify-icon icon="iconamoon:close-bold" class="fs-32"><template shadowrootmode="open"><style data-style="data-style">:host{display:inline-block;vertical-align:0}span,svg{display:block}</style><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from IconaMoon by Dariush Habibpour - https://creativecommons.org/licenses/by/4.0/ --><path fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m7 7l10 10M7 17L17 7"/></svg></template></iconify-icon>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <!-- end row -->

                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="card-title">Paquetes Asignados</h4>
                                    <div class="flex-shrink-0">
                                        <div class="d-flex gap-2">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                            <thead class="bg-light bg-opacity-50 thead-sm">
                                                <tr>
                                                    <th scope="col"># de guia</th>
                                                    <th scope="col">
                                                        Comercio
                                                    </th>
                                                    <th scope="col">Destinatario</th>
                                                    <th scope="col">
                                                        Destina
                                                    </th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Precio</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse($guias as $guia)
                                                <tr>
                                                    <td class="fw-medium">{{ $guia->guia }}</td>
                                                    <td>{{ $guia->comercioRel ? $guia->comercioRel->nombre : 'Sin Comercio' }}</td>
                                                    <td>{{ $guia->destinatario }}</td>
                                                    <td>{{ $guia->destino }}</td>
                                                    <td>
                                                        @switch($guia->estado)
                                                            @case('Entregado')
                                                                <span class="badge bg-success-subtle text-success">Entregado</span>
                                                                @break
                                                            @case('No entregado')
                                                                <span class="badge bg-danger-subtle text-danger">No entregado</span>
                                                                @break
                                                            @default
                                                                <span class="badge bg-primary-subtle text-primary">{{ $guia->estado }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td class="fw-bold">$ {{ number_format($guia->precio, 2) }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted p-4">
                                                        <i class="bx bx-info-circle fs-24"></i><br>
                                                        No hay paquetes asignados a tu unidad en este momento.
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                            <!-- end tbody -->
                                        </table>
                                        <!-- end table -->
                                    </div>
                                    <!-- end table responsive -->
                                </div>
                                <!-- End Card-body -->
                                <div class="card-footer border-top border-light">
                                    <div class="align-items-center justify-content-between row text-center text-sm-start">
                                        <div class="col-sm">
                                           
                                        </div>
                                        <div class="col-sm-auto mt-3 mt-sm-0">
                                            <ul class="pagination pagination-boxed pagination-sm mb-0 justify-content-center">
                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- end col -->

                        
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>









@endsection