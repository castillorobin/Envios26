@extends('layouts.app')

@section('content')
<div class="container-xxl">

            <div class="card">
    
                    <div class="card-header">
                                    <h5 class="card-title anchor" id="basic-wizard">
                                        Crear Usuario
                                    </h5>
                                </div>
                    <div class="card-body">
                                <form>
    <div id="horizontalwizard">
        <ul class="nav nav-pills nav-justified icon-wizard form-wizard-header bg-light p-1" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#basictab1" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2 active" aria-selected="true" role="tab">
                    <iconify-icon icon="iconamoon:profile-circle-duotone" class="fs-26"></iconify-icon>
                    Usuario
                </a><!-- end nav-link -->
            </li><!-- end nav-item -->
            <li class="nav-item" role="presentation">
                <a href="#basictab2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2" aria-selected="false" role="tab" tabindex="-1">
                    <iconify-icon icon="iconamoon:profile-duotone" class="fs-26"></iconify-icon>
                    Perfil
                </a><!-- end nav-link -->
            </li><!-- end nav-item -->
            <li class="nav-item" role="presentation">
                <a href="#basictab3" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2" aria-selected="false" tabindex="-1" role="tab">
                    <iconify-icon icon="iconamoon:link-fill" class="fs-26"></iconify-icon>
                    Datos personales
                </a><!-- end nav-link -->
            </li><!-- end nav-item -->
            <li class="nav-item" role="presentation">
                <a href="#basictab4" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2" aria-selected="false" tabindex="-1" role="tab">
                    <iconify-icon icon="iconamoon:check-circle-1-duotone" class="fs-26"></iconify-icon>
                    Finalizar
                </a><!-- end nav-link -->
            </li><!-- end nav-item -->
        </ul>

        <div class="tab-content mb-0">
            <div class="tab-pane active show" id="basictab1" role="tabpanel">
                <h4 class="fs-16 fw-semibold mb-1">Información del usuario</h4>
                <br>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicUser" class="form-label">Nombre del usuario</label>
                            <input id="basicUser" type="text" class="form-control" placeholder="Ingrese el nombre del usuario">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicEmail" class="form-label">Email</label>
                            <input id="basicEmail" type="email" class="form-control" placeholder="Ingrese el email">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicPassworda" class="form-label">Contraseña</label>
                            <input id="basicPassworda" type="text" class="form-control" placeholder="Ingrese la contraseña">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicConfirmPassword" class="form-label">Confirmar contraseña</label>
                            <input id="basicConfirmPassword" type="text" class="form-control" placeholder="Confirme la contraseña">
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div><!-- end tab-pane -->

            <div class="tab-pane" id="basictab2" role="tabpanel">
                <h4 class="fs-16 fw-semibold mb-1">Información del perfil</h4>
                
<br>
                <div class="row">
                    <div class="col-12">
                       

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basicFname">Nombre del empleado</label>
                                    <input type="text" id="basicFname" class="form-control" placeholder="Nombre">
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basicLname">Apellido del empleado</label>
                                    <input type="text" id="basicLname" class="form-control" placeholder="Apellido">
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basicMnumber">Número de teléfono</label>
                                    <input type="number" id="basicMnumber" class="form-control" placeholder="Número de teléfono">
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basicCountry">Whatsapp</label>
                                    <input type="text" id="basicCountry" class="form-control" placeholder="Whatsapp">
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div><!-- end tab-pane -->

            <div class="tab-pane" id="basictab3" role="tabpanel">
                <h4 class="fs-16 fw-semibold mb-1">Datos del Empleado</h4>
                <br>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicGitLink" class="form-label">DUI</label>
                            <input id="basicGitLink" type="text" class="form-control" placeholder="DUI">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicGoogleLink" class="form-label">Rol</label>
                            <input id="basicGoogleLink" type="text" class="form-control" placeholder="Rol">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicInstagramLink" class="form-label">Dirección</label>
                            <input id="basicInstagramLink" type="text" class="form-control" placeholder="Dirección">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicSkypeLink" class="form-label">Fecha de Incorporacion</label>
                            <input id="basicSkypeLink" type="date" class="form-control" placeholder="Fecha de Incorporacion">
                        </div>
                    </div> <!-- end col -->
                </div><!-- end row -->
            </div><!-- end tab-pane -->

            <div class="tab-pane" id="basictab4" role="tabpanel">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="avatar-md mx-auto mb-3">
                                <div class="avatar-title bg-primary bg-opacity-10 text-primary rounded-circle"><iconify-icon icon="iconamoon:like-duotone" class="fs-36"></iconify-icon></div>
                            </div>
                            <h3 class="mt-0">Finalizado !</h3>

                            <p class="w-75 mb-2 mx-auto">Los datos se han llenado correctamente.</p>

                            <div class="mb-3">
                                <div class="form-check d-inline-block">
                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                    <label class="form-check-label" for="customCheck1">Acepto los Términos y Condiciones</label>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div><!-- end tab-pane -->

            
        </div> <!-- tab-content -->
    </div> <!-- end #horizontal wizard-->
</form>
                    </div>


        </div>
</div>

<script>new Wizard('#horizontalwizard');</script>
@endsection
