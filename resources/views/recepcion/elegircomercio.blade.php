@extends('layouts.app')

@section('content')


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

                                            <div class="d-flex gap-2">
                                                
                                                <Select name="comercio_id" class="form-select" style="max-width: 300px;" aria-label="Default select example">
                                                    <option value="">Selecciona comercio</option>
                                                    @foreach ($comercios as $comercio)
                                                        <option value="{{ $comercio->id }}">{{ $comercio->nombre }}</option>
                                                    @endforeach
                                                </Select>
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