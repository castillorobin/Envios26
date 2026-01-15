@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Rol</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">
                        <form action="/roles/{{$role->id}}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="row m-2">
                                <div class="col-8">
                                <div class="from-group">
                                <label for="name">Nombre del Rol</label>
                                <input type="text" class="form-control" name="name" value="{{ $role->name}}">
                                </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-8">
                                <div class="from-group">
                                <label for="name">Permisos para el rol</label>
                                @foreach($permission as $value)
                                <br>
                                    <label>
                                        <input type="checkbox" name="permission[]" id="" value="{{ $value->id}}"> {{ $value->name}}
                                    </label> 
                                    
                                @endforeach

                                </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Guardar</button>
                        </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

