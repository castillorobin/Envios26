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
                                                <span class="d-none d-sm-inline">Datos del comercio</span>
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
                                                            <label class="form-label" for="nombre">Nombre del comercio</label>
                                                            <input type="text" class="form-control" id="nombre" value="{{ $comercio->nombre }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="direccion">Direccion de origen</label>
                                                            <input type="text" class="form-control" id="direccion" value="{{ $comercio->direccion }}"  readonly>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="telefono">Telefono</label>
                                                            <input type="text" class="form-control" id="telefono" value="{{ $comercio->telefono }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="whatsapp">Whatsapp</label>
                                                            <input type="text" class="form-control" id="whatsapp" value="{{ $comercio->whatsapp }}"  readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Email</label>
                                                            <input type="text" class="form-control" id="email" value="{{ $comercio->email }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="password">Contraseña</label>
                                                            <input type="password" class="form-control" id="password" value="{{ $comercio->password }}"  readonly>
                                                        </div>
                                                    </div>
                                                </div>


                                               

                                                <div class="row">
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="fecha">Fecha de incorporación</label>
                                                            <input type="text" class="form-control" id="fecha" value="{{ \Carbon\Carbon::parse($comercio->created_at)->format('d/m/Y') }}"  readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label><br>
                                                            
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status" id="altaStatus" value="Alta" 
                                                                    {{ $comercio->status == 'Alta' ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="altaStatus">Alta</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status" id="bajaStatus" value="Baja" 
                                                                    {{ $comercio->status == 'Baja' ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="bajaStatus">Baja</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                               
                                               
                                                
                                               
                                            
                                        </div>
                                        <!-- end contact detail tab pane -->
                                       
                                        <div class="d-flex flex-wrap gap-2 wizard justify-content-between mt-3">
                                            <div class="ms-auto d-flex gap-2">
                                                <a href="{{ route('comercios.inicio') }}" class="btn btn-secondary">Cerrar</a>
                                                
                                                <a href="{{ route('comercios.edit', $comercio->id) }}" class="btn btn-primary">Editar</a>
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
</script>



@endsection

