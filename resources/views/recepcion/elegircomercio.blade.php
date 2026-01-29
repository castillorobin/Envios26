@extends('layouts.app')

@section('content')
<style>
    /* Forzar el ancho del contenedor de Choices */
    .choices {
        width: 100% !important;
        margin-bottom: 0 !important; /* Quitar margen inferior que traen por defecto */
    }

    /* Ajustar la altura interna para que coincida con un botón estándar (aprox 38px) */
    .choices__inner {
        min-height: 38px !important;
        padding: 4px 10px !important;
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.375rem !important;
    }

    /* Centrar el texto del buscador */
    .choices__list--single {
        padding: 0 !important;
        line-height: 28px;
    }
</style>

<div class="container-xxl">



<div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Recepción de paquetes</h4>
                                
                            </div>
                        </div>
                    </div>




    <div class="row">
                        
                        <!-- end col -->
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="/recepcion/crearrecepcion" method="GET">

                                            <div class="d-flex gap-2 align-items-start"> <div style="width: 400px;"> 
                                               <select name="comercio_id" 
                                                    class="form-select" 
                                                    data-choices 
                                                    id="choices-single-default"
                                                    required> <option value="" placeholder>Selecciona comercio</option> 
                                                
                                                @foreach ($comercios as $comercio)
                                                    <option value="{{ $comercio->id }}">{{ $comercio->nombre }}</option>
                                                @endforeach
                                            </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                        </div>
                                             </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-centered mt-3">
                                       
                                        <!-- end table-->
                                    </div>
                                    <!-- end table responsive -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->




                        




                    </div>
</div>


@endsection