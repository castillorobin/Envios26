@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Comercio</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">
                            <h3 class="text-center">Datos del Comercio</h3>
                        </div>
                        <form action="/comercios/" method="post">
                        @csrf
                        @method('POST')
                            <div class="row m-2">
                                <div class="col-8">
                                <div class="from-group">
                                <label for="name">Comercio</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre del comercio">
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="direccion">Direccion de origen</label>
                                <input type="text" class="form-control" name="direccion" placeholder="Direccion del comercio">
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="name">Telefono</label>
                                <input type="text" class="form-control" name="telefono" placeholder="Telefono del comercio">
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="name">Whatsapp</label>
                                <input type="text" class="form-control" name="whatsapp" placeholder="Whatsapp del comercio">
                                </div>
                                </div>
                            </div>

                            <div class="row m-2">
                                <div class="col-8">
                                <div class="from-group">
                                <label for="name">Email </label>
                                <input type="text" class="form-control" name="email" placeholder="Email del comercio">
                                </div>
                                </div>
                            </div>
                           <br>
                            <button class="btn btn-success" type="submit">Guardar</button>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

