@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">
                            <h3 class="text-center">Datos del Usuario</h3>
                        </div>
                        <form action="/usuarios/{{$user->id}}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="row m-2">
                                <div class="col-8">
                                <div class="from-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name}}">
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="name">E-mail</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email}}">
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="name">Password</label>
                                <input type="text" class="form-control" name="password">
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-6">
                                <div class="from-group">
                                <label for="name">Confirmar Password</label>
                                <input type="text" class="form-control" name="confirm-password">
                                </div>
                                </div>
                            </div>

                            <div class="row m-2">
                                <div class="col-8">
                                <div class="from-group">
                                <label for="name">Roles</label>
                                <select class="form-control" name="roles[]" id="">
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
@endsection

