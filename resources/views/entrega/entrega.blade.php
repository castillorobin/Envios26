@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Melo Express</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card w-75 mx-auto"> 
                        
                        <div class="card-body  p-3">

                            <h3 class="card-title">Entrega de paquetería</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <form action="">
                                        <div class="form-group d-flex flex-column align-items-center">
                                            
                                            <input type="text" class="form-control w-50" id="guia" placeholder="Ingresar guia">
                                            <br>
                                            <button type="submit" class="btn btn-primary w-25 mt-2">Buscar</button>
                                            <button type="button" class="btn btn-info w-25 mt-2">QR</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

