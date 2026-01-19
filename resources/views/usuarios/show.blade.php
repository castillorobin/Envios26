@extends('layouts.app')

@section('content')



    <div class="container-xxl">
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        
                    </div>
                    <!-- ========== Page Title End ========== -->


                    <div class="row">
                        <div class="col">
                            <div class="card" id="horizontalwizard">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs border-0" role="tablist">
                                        <li class="nav-item" data-target-form="#generalDetailForm" role="presentation">
                                            <a href="#generalDetail" data-bs-toggle="tab" data-toggle="tab" class="nav-link active pb-3" aria-selected="true" role="tab">
                                                <i class="bx bxs-contact me-1"></i>
                                                <span class="d-none d-sm-inline">Datos del usuario</span>
                                            </a>
                                        </li>
                                        <!-- end nav item -->
                                        
                                    </ul>
                                    <!-- nav pills -->
                                </div>
                                <div class="card-body">
                                    <div class="tab-content pt-0">
                                        <div class="tab-pane show active" id="generalDetail" role="tabpanel">
                                            
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nombre">Nombre del usuario</label>
                                                            <input type="text" class="form-control" id="nombre" value="{{ $usuario->name }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Email</label>
                                                            <input type="text" class="form-control" id="email" value="{{ $usuario->email }}"  readonly>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nombre">Nombre del empleado</label>
                                                            <input type="text" class="form-control" id="nombre" value="{{ $usuario->nombre }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Apellido del empleado</label>
                                                            <input type="text" class="form-control" id="email" value="{{ $usuario->last_name }}"  readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nombre">Teléfono</label>
                                                            <input type="text" class="form-control" id="nombre" value="{{ $usuario->phone }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Whatsapp</label>
                                                            <input type="text" class="form-control" id="email" value="{{ $usuario->whatsapp }}"  readonly>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nombre">DUI</label>
                                                            <input type="text" class="form-control" id="nombre" value="{{ $usuario->dui }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Rol</label>
                                                            <input type="text" class="form-control" id="email" value="{{ $usuario->getRoleNames()->first() ?? 'Sin Rol' }}"  readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nombre">Dirección de residencia</label>
                                                            <input type="text" class="form-control" id="nombre" value="{{ $usuario->address }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Fecha de incorporación</label>
                                                            <input type="text" class="form-control" id="email" value="{{ \Carbon\Carbon::parse($usuario->joined_at)->format('d/m/Y') }}"  readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                   <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Contraseña</label>
                                                            
                                                                <input type="password" class="form-control form-control-flush fw-bolder" value="estoesunpassword" id="passInput" readonly>
                                                                
                                                            </div>
                                                    </div>

                                                       
                                                       
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label><br>
                                                            
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="radio" type="radio" id="offlineStatus" value="Offline" checked="" readonly>
                                                                <label class="form-check-label" for="offlineStatus">Alta</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="radio" type="radio" id="onlineStatus" value="Online" readonly>
                                                                <label class="form-check-label" for="onlineStatus">Baja</label>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>



                                                    
                                                </div>
                                               
                                                
                                               
                                            
                                        </div>
                                        <!-- end contact detail tab pane -->
                                       
                                        <div class="d-flex flex-wrap gap-2 wizard justify-content-between mt-3">
                                            <div class="ms-auto d-flex gap-2">
                                                <a href="{{ route('usuarios.inicio') }}" class="btn btn-secondary">Cerrar</a>
                                                
                                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary">Editar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab content-->
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

