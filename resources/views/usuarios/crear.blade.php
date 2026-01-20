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
                                <form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
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
                            <label for="name" class="form-label">Nombre del usuario</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Ingrese el nombre del usuario" required>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Ingrese el email" required>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" name="password" type="text" class="form-control" placeholder="Ingrese la contraseña" required>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input id="password_confirmation" name="password_confirmation" type="text" class="form-control" placeholder="Confirme la contraseña" required>
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
                                    <label class="form-label" for="first_name_emp">Nombre del empleado</label>
                                    <input type="text" id="first_name_emp" name="nombre" class="form-control" placeholder="Nombre" required>
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="last_name">Apellido del empleado</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Apellido" required>
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="phone">Número de teléfono</label>
                                    <input type="number" id="phone" name="phone" class="form-control" placeholder="Número de teléfono" required>
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="whatsapp">Whatsapp</label>
                                    <input type="text" id="whatsapp" name="whatsapp" class="form-control" placeholder="Whatsapp" required>
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
                            <label for="dui" class="form-label">DUI</label>
                            <input id="dui" name="dui" type="text" class="form-control" placeholder="DUI" required>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicGoogleLink" class="form-label">Rol</label>

                            <select name="rol" class="form-control" required>
         @foreach($roles as $role)
            <option value="{{ $role }}">{{ $role }}</option>
        @endforeach
    </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <input id="address" name="address" type="text" class="form-control" placeholder="Dirección" required>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="joined_at" class="form-label">Fecha de Incorporacion</label>
                            <input id="joined_at" name="joined_at" type="date" class="form-control" placeholder="Fecha de Incorporacion" required>
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
                            <a href="{{ route('usuarios.inicio') }}" class="btn btn-secondary">Cerrar</a>
                           
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div><!-- end tab-pane -->


            <div class="d-flex flex-wrap align-items-center wizard justify-content-center gap-3 mt-3" style="width: 100%;">
                <div class="d-flex gap-2">
                    <div class="previous">
                        <a href="javascript:void(0);" class="btn btn-primary" id="btn-anterior">
                            <i class="bx bx-left-arrow-alt me-2"></i>Anterior
                        </a>
                    </div>
                    <div class="next">
                        <a href="javascript:void(0);" class="btn btn-primary" id="btn-siguiente">
                            Siguiente<i class="bx bx-right-arrow-alt ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            
        </div> <!-- tab-content -->
    </div> <!-- end #horizontal wizard-->
</form>
                    </div>


        </div>
</div>

<script>new Wizard('#horizontalwizard');</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnInicio = document.getElementById('btn-inicio');
    const btnFinalizar = document.getElementById('btn-finalizar');
    const btnSiguiente = document.getElementById('btn-siguiente');
    const btnAnterior = document.getElementById('btn-anterior');

    // Función para validar campos del panel activo
    function validarPasoActual() {
    const activePane = document.querySelector('.tab-pane.active');
    const inputs = activePane.querySelectorAll('input[required], select[required], textarea[required]');
    let valido = true;
    let primerError = null;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            valido = false;
            input.classList.add('is-invalid');
            if (!primerError) primerError = input; // Guardamos el primero para hacer foco
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        }
    });

    if (!valido) {
        // Alerta con SweetAlert2
        Swal.fire({
            text: "¡Atención! Hay campos obligatorios vacíos en esta sección.",
            icon: "warning",
            buttonsStyling: false,
            confirmButtonText: "Entendido",
            customClass: {
                confirmButton: "btn btn-primary" // Clase de Metronic
            }
        }).then(() => {
            // Opcional: Llevar el cursor al primer campo con error
            if (primerError) primerError.focus();
        });
    }

    return valido;
}

    function cambiarTab(targetId) {
        const triggerEl = document.querySelector(`.nav-link[href="${targetId}"]`);
        if (triggerEl) {
            const tab = new bootstrap.Tab(triggerEl);
            tab.show();
        }
    }

    // Evento Siguiente (CON VALIDACIÓN)
    btnSiguiente.addEventListener('click', function() {
        if (validarPasoActual()) {
            const activeTab = document.querySelector('.nav-link.active');
            const nextTab = activeTab.closest('.nav-item').nextElementSibling?.querySelector('.nav-link');
            if (nextTab) {
                cambiarTab(nextTab.getAttribute('href'));
            }
        }
    });

    // Evento Anterior (SIN VALIDACIÓN, para permitir corregir)
    btnAnterior.addEventListener('click', function() {
        const activeTab = document.querySelector('.nav-link.active');
        const prevTab = activeTab.closest('.nav-item').previousElementSibling?.querySelector('.nav-link');
        if (prevTab) {
            cambiarTab(prevTab.getAttribute('href'));
        }
    });

    // Eventos Inicio y Finalizar
    btnInicio.addEventListener('click', () => cambiarTab('#basictab1'));
    btnFinalizar.addEventListener('click', () => {
        // Validamos todos los pasos previos si se intenta saltar al final
        if (validarPasoActual()) cambiarTab('#basictab4');
    });

    // Control de estado de botones (disabled)
    const tabLinks = document.querySelectorAll('.nav-link[data-bs-toggle="tab"]');
    tabLinks.forEach(link => {
        link.addEventListener('shown.bs.tab', function (event) {
            const isFirst = event.target.getAttribute('href') === '#basictab1';
            const isLast = event.target.getAttribute('href') === '#basictab4';
            btnAnterior.classList.toggle('disabled', isFirst);
            btnSiguiente.classList.toggle('disabled', isLast);
        });
    });
});
</script>
@endsection
