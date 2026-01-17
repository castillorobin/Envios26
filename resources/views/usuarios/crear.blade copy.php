@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">
                            <h3 class="text-center">Datos del Usuario</h3>
                        </div>
                        <form action="/usuarios" method="post">
                            @csrf
                            <div class="row m-2">
                                <div class="col-8">
                                <div class="from-group">
                                <label for="name">Nombre</label>
                                <select class="form-control" name="name" onchange="valor()" id="name">
                                @foreach($repartidores as $repartidor)
                                    <option value="{{$repartidor->nombre}}">{{ $repartidor->nombre}}</option>
                                    
                                        @endforeach
                                </select>

                                @foreach($repartidores as $repartidor)
                                <input hidden id="ema{{$repartidor->nombre}}" value="{{ $repartidor->correo }} ">
                                    
                                        @endforeach
                                


                                        

                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" name="email" id="email" >
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password">
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="confirm-password">Confirmar Password</label>
                                <input type="text" class="form-control" name="confirm-password">
                                </div>
                                </div>
                            </div>

                            <div class="row m-2">
                                <div class="col-8">
                                <div class="from-group">
                                <label for="roles">Roles</label>
                                <select class="form-control" name="roles" id="">
                                @foreach($roles as $role)
                                    <option value="{{ $role}}">{{ $role}}</option>
                                        @endforeach
                                </select>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
function valor() {
   
    nombre =  document.getElementById("name").value;

    nom=document.getElementById("ema" + nombre).value;

    document.getElementById("email").value = nom;
   
}

</script>
@endsection

